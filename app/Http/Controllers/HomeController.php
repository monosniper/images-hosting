<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        if($request->by) {
            $images = Image::orderBy($request->by, $request->order)->get();
        } else {
            $images = Image::all();
        }

        return view('home', ['images' => $images]);
    }
}
