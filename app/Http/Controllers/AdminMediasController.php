<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class AdminMediasController extends Controller
{
    public function index(){
        $photos = Photo::all();
        return view('admin.media.index', compact('photos'));
    }

    public function store(Request $request){
        $file = $request->file('file');
        $name = time() . $file->getClientOriginalName();
        $file->move('images', $name);
        Photo::create(['file' => $name]);

        return redirect('/admin/media');
    }

    public function create(){
        return view('admin.media.upload');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id){
        $photo = Photo::findOrFail($id);
        unlink(public_path() . $photo->file);
        $photo->delete();

        Session::flash('media_deleted', 'The media has been deleted');

        return redirect('/admin/media');
    }


}
