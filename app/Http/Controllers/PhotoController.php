<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function create(int $albumId){
        
        return view('photos.create')->with('albumId', $albumId);
    }
    
    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'photo' => 'required|image'
            ]);
            
        $filenameWithExtension = $request->file('photo')->getClientOriginalName();
        
        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
        
        $extension = $request->file('photo')->getClientOriginalExtension();
        
        $filenameTostore = $filename . '_' . time() . '.' . $extension;
        
        $request-> file('photo')->storeAs('/public/albums/' . $request->input('album_id'), $filenameTostore);
        
        $photo = new Photo();
        $photo->title = $request->input('title');
        $photo->description = $request->input('description');
        $photo->photo = $filenameTostore;
        $photo->size = $request->file('photo')->getSize();
        $photo->album_id = $request->input('album_id');
        $photo->save();
        
        return redirect('/albums/' . $request->input('album_id'))->with('success', 'Photo Uploaded successfuliy!');
    }
    
    public function show($id){
        $photo = Photo::find($id);
        return view('photos.show')->with('photo',$photo);
    }
    
    public function destroy($id){
        $photo = Photo::find($id);
        if(Storage::delete('/public/albums/' . $photo->album_id . '/' . $photo->photo)){
            $photo->delete();
            
            return redirect('/')->with('success','Photo deleted successfully!');
        }
    }
    
    
    
    
}
