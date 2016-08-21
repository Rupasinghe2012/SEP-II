<?php

namespace App\Http\Controllers;
use App\Gallery;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    

    
    /**
     * @description View all the  Albums
     */
    public function viewGalleryList()
    {
        $galleries= Gallery::where('created_by',Auth::user()->id)->get();
        return view('gallery.galery')
            ->with('galleries',$galleries);
    }

    /**
     * @param \Illuminate\Http\Request|Request $request
     * @description Creating Albums
     */
    public function saveGallery(Request $request)
    {
        //validate the request
        $validator=Validator::make($request->all(),[
            'gallery_name'=>'required|min:3',
            'details'=>'required|min:3'
        ]);
        //take actions when the validation has failed
        if($validator->fails()){
            return redirect('gallery/list')
                ->withErrors($validator)
                ->withInput();
        }
        $gallery=new Gallery;
        //Save a new album
        $gallery->name=$request->input('gallery_name');
        $gallery->details=$request->input('details');
        $gallery->created_by=Auth::user()->id;
        $gallery->published=1;
        $gallery->save();

        return redirect()->back();
    }

    /**
     * @param \Illuminate\Http\Request|Request $request
     * @param  id of the album
     * @description Editing the Album
     */
    public function editGallery(Request $request,$id)
    {

        $gallery = Gallery::find($id);
        //Save a new album
        $gallery->name=$request->name;
        $gallery->details=$request->details;
        $gallery->update();

        return redirect()->back();
    }

    /**
     * @param id
     * @description Viewing the Albums picture
     */
    public function viewGalleryPics($id)
    {
        $gallery=Gallery::find($id);

        return view('gallery.gallery-view')
            ->with('gallery',$gallery);

    }

    /**
     * @param \Illuminate\Http\Request|Request $request
     * @description Uploading the image  to album
     */
    public function doImageUpload(Request $request)
    {
        //get the file from the post request
        $file=$request->file('file');
        //set the file name
        $filename= uniqid() .$file->getClientOriginalName();

        //move the file to correct location
        if(!file_exists('gallery/images')){
            mkdir('gallery/images',0777,true);
        }
        $file->move('gallery/images',$filename);

        if(!file_exists('gallery/images/thumbs')){
            mkdir('gallery/images/thumbs',0777,true);
        }
        $thumb =Image::make('gallery/images/'.$filename)->resize(240,100)->save('gallery/images/thumbs/'.$filename,60);
        //save the image details in to database
        $gallery=Gallery::find($request->input('gallery_id'));
        $image= $gallery->images()->create([
            'gallery_id'=>$request->input('gallery_id'),
            'file_name'=>$filename,
            'file_size'=>$file->getClientSize(),
            'file_mine'=>$file->getClientMimeType(),
            'file_path'=>'gallery/images/' .$filename,
            'created_by'=>Auth::user()->id,
        ]);
        return $image;
    }

    /**
     * @param id of the album
     * @description Deleting the albums and the pictures
     */
    public function deleteGallery($id){
        //load the gallery
        $currentGallery=Gallery::findOrFail($id);
        //check owenership
        if($currentGallery->created_by != Auth::user()->id){
            abort('483','You are not allowed to delete this Album');
        }
        //get the images
        $images= $currentGallery->images();

        //delete the images
        foreach($currentGallery->images as $image){
            unlink(public_path($image->file_path));
            unlink(public_path('gallery/images/thumbs/'.$image->file_name));
        }
        //delete the db record
        $currentGallery->images()->delete();
        $currentGallery->delete();
        return redirect()->back();
    }
}
