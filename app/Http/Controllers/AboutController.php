<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function getAbout()
    {
        $about = About::first();
        return response()->json($about, 200);
    }
    public function store(Request $request)
    {
        $about = new About();
        $about->title = $request->title;
        $about->text_one = $request->text_one;
        $about->text_two = $request->text_two;
        $about->save();
        return response()->json($about, 200);
    }
    public function update(Request $request)
    {
        $about = About::first();
        $about->title = $request->title;
        $about->text_one = $request->text_one;
        $about->text_two = $request->text_two;
        $about->save();
        return response()->json($about, 200);
    }
}
