<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Http\Requests\StoreGalleryRequest;
use App\Models\Images;

class imageController extends Controller
{
    // api: /api/all
    public function index(){
        return Images::all();
    }

    // api: /api/all/{id}
    public function show($id)
    {
        $image = Images::find($id);
        return response()->json($image);
    }

    // api: /api/add-image
    public function store(Request $request)
    {

        $storeImage = new Images();
        $storeImage->title = $request->json('title');
        $storeImage->description = $request->json('description');
        $storeImage->image_path = $request->json('image_path');
        $storeImage->large_image_path = $request->json('large_image_path');
        $storeImage->save();
        
    }

    // api: /api/update/{id}
    public function edit(Request $request,$id)
    {
        try{
            //check id exist whether or not in db
            // $image = Images::where('image_id',$id)->first();
            $image = Images::where('id',$id)->first();      
            //if exist then update title/desc/
            $title =  $request->json('title');
            $description = $request->json('description');

            if( $title != null) {
                $image->title = $title;
            }
            
            if($description != null) {
                $image->description = $description;
            }
           
            $image->updated_at = new \DateTime();
            $image -> save();

            return $image;
        }catch (Exception $e) {
            
        //if not throw error
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function destory($id)
    {
        $image = Images::find($id);
        return $image->delete();
    }
}
