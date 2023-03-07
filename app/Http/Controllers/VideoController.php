<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class VideoController extends Controller
{
    public function __construct()
    {

    }

    /**
     * @param Request $request
     * @return JsonResponse|array
     */
    public function downloadVideo(Request $request): JsonResponse|array
    {
        $url = $request->input('url');
        $type = $request->input('type');
        $response = Http::withHeaders(
            [
                'X-RapidAPI-Key' => '70a786bf74msh0b40cda63d301e2p1863e5jsn5b1257b12287',
                'X-RapidAPI-Host' => 'tiktok-downloader-download-tiktok-videos-without-watermark.p.rapidapi.com'
            ]
        );
        //set query parameters
        $response = $response->get('https://tiktok-downloader-download-tiktok-videos-without-watermark.p.rapidapi.com/vid/index', [
            'url' => $url,
        ]);
        if($response->successful()){
            return $response->json();
        } else {
            $error = $response->json()['error'];
            if($error && str_contains($error,'error your link is private or removed')){
                return response()->json(['error' => 'video không tồn tại'], 404);
            }else {
                return response()->json(['error' => 'có lỗi xảy ra, vui lòng thử lại sau vài phút'], 500);
            }
        }

    }
}
