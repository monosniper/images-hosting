<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use ZipArchive;

class UploadController extends Controller
{
    public function tempUpload(Request $request): \Illuminate\Http\JsonResponse
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '.' . $file->getClientOriginalExtension();

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        foreach ($request->input('file', []) as $file) {
            $image = Image::create(['name' => $file]);
            $image->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('file');
        }

        return redirect()->route('home')->with(['success' => true]);
    }

    public function download(Image $image): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $zip = new ZipArchive;
        $file = $image->getFirstMedia('file');
        $fileName = $file->name . '.zip';

        if ($zip->open(storage_path('downloads/' . $fileName), ZipArchive::CREATE) === TRUE)
        {
            $zip->addFile($file->getPath(), $file->file_name);

            $zip->close();
        }

        return response()->download(public_path($fileName));
    }
}
