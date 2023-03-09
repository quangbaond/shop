<?php

namespace App\Services;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class RapidApiService
{
    /**
     * @param array $configClient
     * @param array $request
     * @return array|JsonResponse
     */
    public function RapidApiClient(array $configClient, array $request): array|JsonResponse
    {
        $url = $request['url'];
        $type = $request['type'];
        $dataHeaders = $configClient['headers'];
        $dataQuery = $configClient['query'];
        $response = Http::withHeaders($dataHeaders);
        //set query parameters
        $response = $response->get($configClient['api_url'], $dataQuery);
        if($response->successful()){
            return $response->json();
        } else {
            $error = $response->json();
            if($type == 'tiktok'){
                $error = $response->json()['error'];
                if($error && str_contains($error,'error your link is private or removed')) {
                    return response()->json(['error' => 'có thể video này ở chế độ ẩn hoặc không tồn tại, rất tiếc 😢'], 404);
                }
                return response()->json(['error' => 'có lỗi xảy ra, vui lòng thử lại sau vài phút'], 500);
            } else {
                if($error['status'] === false && str_contains($error['reason'],"Video not found.")){
                    return response()->json(['error' => 'có thể video này ở chế độ ẩn hoặc không tồn tại, rất tiếc 😢'], 404);
                }
                return response()->json(['error' => 'có lỗi xảy ra, vui lòng thử lại sau vài phút'], 500);
            }

        }
    }
}
