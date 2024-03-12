<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $images = Image::all();

        return ImageResource::collection($images);
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image): ImageResource
    {
        return new ImageResource($image);
    }
}
