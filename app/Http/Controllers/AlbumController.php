<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Photo;

class AlbumController extends Controller
{
    public function index(){
        $albums = Album::get();
        
        return view('albums.index')->with('albums',$albums);
    }
    //ホーム画面へ　アルバムがあればアルバムが表示される
    
    public function create(){
        return view('albums.create');
    }
    
    // アルバムの作成画面へ
    
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'cover_image' => 'required|image' //バリデーションされているファイルは (jpeg, png, bmp, gif, or svg)にしないといけません。
            ]);
            
        //ここから   
            
        $filenameWithExtension = $request->file('cover_image')->getClientOriginalName();
                                                                //アップロードするファイル名を取得している
        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
                    //ファイルのpath情報を取得している　　オプションでファイル名を指定してファイル名を取得
        $extension = $request->file('cover_image')->getClientOriginalExtension(); //←ファイルの拡張子を取得

        $filenameTostore = $filename . '_' . time() . '.' . $extension; //←保存用にファイル名を付けなおしている
        
        //ここまでは　ファイル名を決める作業
        
        $request-> file('cover_image')->storeAs('public/album_covers', $filenameTostore);
        
        //作成したファイル名を付けてファイルを保存
        
        //新しいアルバムを作成↓
        $album = new Album();
        $album->name = $request->input('name');
        $album->description = $request->input('description');
        $album->cover_image = $filenameTostore;
        
        $album->save();
        
        return redirect('/albums')->with('success', 'Album created successfully!');
    }
   
    
    public function show($id){
        $album = Album::with('photos')->find($id);
        return view('albums.show')->with('album',$album);
    }
    //アルバム一覧を表示
}
