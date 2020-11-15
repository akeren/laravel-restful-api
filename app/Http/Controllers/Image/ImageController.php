<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadImageRequest;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public function upload(UploadImageRequest $request)
    {
        $imageFile = $request->file('image');
        $imageName = Str::random(10);
        $savedImageUrl = \Storage::putFileAs('images', $imageFile, $imageName.'.'.$imageFile->extension());

        return [
            'status' => 'success',
            'code' => 200,
            'message' => 'Image uploaded successfully.',
            'url' => env('APP_URL').'/'.$savedImageUrl,
        ];

    }
}
