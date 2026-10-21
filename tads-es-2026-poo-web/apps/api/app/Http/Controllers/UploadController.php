<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;

class UploadController extends Controller
{
    /**
     * @requestMediaType multipart/form-data
     */
    public function upload(UploadRequest $request): array
    {
        $path = $request->file('file')->store('uploads');

        return ['path' => $path];
    }
}
