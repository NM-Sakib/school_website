<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
  public function index()
  {
    $gallery = Gallery::latest()->paginate(12);
    return view('frontend.gallery', compact('gallery'));
  }
}
