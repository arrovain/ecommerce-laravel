<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;


class PhotoController extends Controller
{

    public function index()
    {
    
        $photos = Photo::latest()->get();
        return view('home')->with([
            'photos' => $photos
        ]); 
    }

 
    public function adminDashboard()
    {
     
        $photos = Photo::latest()->get();
        return view('admin.photos.index')->with([
            'photos' => $photos
        ]); 
    }

 
    public function create()
    {
       
        return view('admin.photos.create');
    }

}
