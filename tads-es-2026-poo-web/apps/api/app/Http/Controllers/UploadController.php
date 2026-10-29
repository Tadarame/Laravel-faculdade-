<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * @requestMediaType multipart/form-data
     */
    public function upload(UploadRequest $request): array
    {
        $path = $request->file('file')->store('files', 'public');
        $storageUrl = Storage::disk('public')->url($path);
        $url = $request->getSchemeAndHttpHost().parse_url($storageUrl, PHP_URL_PATH);

        return ['path' => $path, 'url' => $url];
    }
}
