<?php

namespace App\Http\Controllers;

use App\Http\Requests\DownloadVideoRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\RapidApiService;


class VideoController extends Controller
{
    protected RapidApiService $rapidApiService;

    /**
     * @param RapidApiService $rapidApiService
     */
    public function __construct(RapidApiService $rapidApiService)
    {
        $this->rapidApiService = $rapidApiService;
    }

    /**
     * @param DownloadVideoRequest $request
     * @return JsonResponse|array
     */
    public function downloadVideo(DownloadVideoRequest $request): JsonResponse|array
    {
        if($request->input('type') === 'tiktok'){
            $configClient = RAPID_API_TIKTOK;
            $configClient['query']['url'] = $request['url'];
        } else {
            $configClient = RAPID_API_YOUTUBE;
            $configClient['query']['id'] = $request['videoId'];
        }
        return $this->rapidApiService->RapidApiClient($configClient, $request->all());

    }
}
