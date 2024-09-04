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

    public function store(StorePhotoRequest $request)
    {
        //
        if($request->validated()) {
            $data = $request->all();
            $image = $request->file('image');
            $image_name = time().'_'.'image'.'_'.$image->getClientOriginalName();
            $image->storeAs('images/', $image_name, 'public');
            $data['url'] = 'storage/images/'.$image_name;
            $data['admin_id'] = auth()->guard('admin')->user()->id;
            Photo::create($data);
            return redirect()->route('admin.index')->with([
                'success' => 'Photo uploaded successfully'
            ]);
        }

    }
    public function show(Photo $photo)
    {
        //
          return view('show')->with([
            'photo' => $photo
          ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        //
        return view('admin.photos.edit')->with([
            'photo' => $photo
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        //
        if($request->validated()) {
            $data = $request->all();
            $data['admin_id'] = auth()->guard('admin')->user()->id;
            $photo->update($data);
            return redirect()->route('admin.index')->with([
                'success' => 'Photo updated successfully'
            ]);
        }
    }
}



