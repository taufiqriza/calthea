<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * List orders (admin).
     */
    public function index(Request $request)
    {
        $query = Order::query()->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->get();

        return response()->json([
            'success' => true,
            'data' => $orders,
        ]);
    }

    /**
     * Store a new order (public).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'table_number' => 'required|string|max:20',
            'items' => 'required|array|min:1',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1|max:50',
            'notes' => 'nullable|string|max:500',
            'payment_method' => 'required|in:qris,cash',
        ]);

        $menuIds = collect($validated['items'])->pluck('menu_id')->unique()->values();
        $menus = Menu::whereIn('id', $menuIds)->get()->keyBy('id');

        $orderItems = [];
        $total = 0;

        foreach ($validated['items'] as $item) {
            $menu = $menus->get($item['menu_id']);
            if (!$menu) {
                continue;
            }
            $price = (float) $menu->price;
            $quantity = (int) $item['quantity'];
            $subtotal = $price * $quantity;
            $total += $subtotal;

            $orderItems[] = [
                'menu_id' => $menu->id,
                'name' => $menu->name,
                'price' => $price,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ];
        }

        if (count($orderItems) === 0) {
            return response()->json([
                'success' => false,
                'message' => 'Menu items not found.',
            ], 422);
        }

        $orderCode = 'ORD-' . now()->format('ymd') . '-' . strtoupper(Str::random(4));

        $order = Order::create([
            'order_code' => $orderCode,
            'customer_name' => $validated['customer_name'],
            'table_number' => $validated['table_number'],
            'items' => $orderItems,
            'total' => $total,
            'notes' => $validated['notes'] ?? null,
            'payment_method' => $validated['payment_method'],
            'status' => 'new',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            'data' => $order,
        ], 201);
    }

    /**
     * Show order detail (admin).
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $order,
        ]);
    }

    /**
     * Update order status (admin).
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,preparing,ready,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => $validated['status'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order updated',
            'data' => $order,
        ]);
    }
}
