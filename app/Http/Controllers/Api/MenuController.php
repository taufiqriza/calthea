<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Menu::query();

        // Admin filtering (all data) vs Public filtering (available only)
        if (!$request->user()) {
            $query->available();
        }

        // Filter by category
        if ($request->has('category') && $request->category !== 'all') {
            $query->byCategory($request->category);
        }

        // Filter featured only
        if ($request->boolean('featured')) {
            $query->featured();
        }
        
        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $menuItems = $query->latest()->get();

        // If for frontend grouped display
        if ($request->boolean('grouped')) {
            $grouped = [
                'drinks' => $menuItems->where('category', 'drink')->values(),
                'foods' => $menuItems->where('category', 'food')->values(),
                'snacks' => $menuItems->where('category', 'snack')->values(),
            ];

            return response()->json([
                'success' => true,
                'data' => $grouped,
                'all' => $menuItems,
            ]);
        }
        
        return response()->json([
            'success' => true,
            'data' => $menuItems
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:drink,food,snack',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image_file' => 'nullable|image|max:2048', // 2MB Max
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('menus', 'public');
            $validated['image'] = '/storage/' . $imagePath;
        }

        $menu = Menu::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Menu created successfully',
            'data' => $menu
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Try to find by ID first, then slug
        $menu = Menu::where('id', $id)->orWhere('slug', $id)->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $menu,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'category' => 'sometimes|required|in:drink,food,snack',
            'price' => 'sometimes|required|numeric|min:0',
            'description' => 'nullable|string',
            'image_file' => 'nullable|image|max:2048',
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('image_file')) {
            // Delete old image
            if ($menu->image) {
                $oldPath = str_replace('/storage/', '', $menu->image);
                Storage::disk('public')->delete($oldPath);
            }
            
            $imagePath = $request->file('image_file')->store('menus', 'public');
            $validated['image'] = '/storage/' . $imagePath;
        }

        $menu->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Menu updated successfully',
            'data' => $menu
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        
        if ($menu->image) {
            $oldPath = str_replace('/storage/', '', $menu->image);
            Storage::disk('public')->delete($oldPath);
        }

        $menu->delete();

        return response()->json([
            'success' => true,
            'message' => 'Menu deleted successfully'
        ]);
    }
}
