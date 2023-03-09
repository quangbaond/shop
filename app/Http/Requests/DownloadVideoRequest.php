<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DownloadVideoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'url' => 'required|url',
            'type' => 'required|string|in:tiktok,youtube',
            'quality' => 'required_if:type,tiktok|string|in:mp4,mp3',
            'videoId' => 'required_if:type,youtube|string',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'url.required' => 'url không được để trống',
            'type.required' => 'video không được để trống',
            'url.url' => 'url không đúng định dạng',
            'type.string' => 'video không đúng định dạng',
            'type.in' => 'video không đúng định dạng, phải là tiktok hoặc youtube',
            'quality.required_if' => 'quality không được để trống',
            'quality.string' => 'quality không đúng định dạng',
            'quality.in' => 'quality không đúng định dạng, phải là mp4 hoặc mp3',
            'videoId.required_if' => 'video youtbe không được để trống',
            'videoId.string' => 'video youtbe không đúng định dạng',
        ];
    }
}
