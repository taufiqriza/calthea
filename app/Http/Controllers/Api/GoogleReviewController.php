<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GoogleReviewController extends Controller
{
    public function index(Request $request)
    {
        $apiKey = config('services.google.places_api_key');
        $placeId = config('services.google.place_id');
        $language = config('services.google.places_language', 'id');

        if (!$apiKey || !$placeId) {
            return response()->json([
                'success' => false,
                'message' => 'Google Places API belum dikonfigurasi.',
            ], 500);
        }

        $cacheKey = 'google_reviews_' . $placeId;

        $fetchPayload = function () use ($apiKey, $placeId, $language) {
            $response = Http::retry(2, 200)
                ->timeout(10)
                ->get('https://maps.googleapis.com/maps/api/place/details/json', [
                    'place_id' => $placeId,
                    'fields' => 'name,rating,user_ratings_total,reviews,url',
                    'language' => $language,
                    'key' => $apiKey,
                ]);

            if (!$response->ok()) {
                throw new \RuntimeException('Failed to fetch Google reviews.');
            }

            $result = $response->json('result', []);
            $reviews = collect($result['reviews'] ?? [])->map(function ($review) {
                return [
                    'author_name' => $review['author_name'] ?? 'Anonymous',
                    'profile_photo_url' => $review['profile_photo_url'] ?? null,
                    'rating' => $review['rating'] ?? 0,
                    'text' => $review['text'] ?? '',
                    'relative_time_description' => $review['relative_time_description'] ?? null,
                    'time' => $review['time'] ?? null,
                    'author_url' => $review['author_url'] ?? null,
                ];
            })->values();

            return [
                'place' => [
                    'name' => $result['name'] ?? 'Calthea Cafe',
                    'rating' => $result['rating'] ?? null,
                    'total_reviews' => $result['user_ratings_total'] ?? null,
                    'url' => $result['url'] ?? null,
                ],
                'reviews' => $reviews,
            ];
        };

        try {
            $payload = Cache::remember($cacheKey, now()->addMinutes(15), $fetchPayload);
        } catch (\Throwable $e) {
            try {
                $payload = $fetchPayload();
            } catch (\Throwable $inner) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memuat ulasan Google.',
                ], 500);
            }
        }

        if (!isset($payload)) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat ulasan Google.',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'data' => $payload,
        ]);
    }
}
