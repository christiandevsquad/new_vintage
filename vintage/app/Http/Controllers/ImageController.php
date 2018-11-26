<?php

namespace App\Http\Controllers;

use App\Model\Image;
use App\Model\Product;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        // return view('admin.image.image-view');
        // return $product->images;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $images, $product)
    {
        foreach($images as $input) {
            $new_image = new Image;

            $image_name = str_random(32);
            // $file_type = request()->file->getClientOriginalExtension();
            $file_type = $input->getClientOriginalExtension();
            $image_name .= '.'.$file_type;

            // request()->file->move(public_path('upload'), $image_name);
            $input->move(public_path('upload'), $image_name);

            $new_image->product_image = $image_name;
            $new_image->save();
        }
        // return response()->json(['uploaded' => '/upload/'.$image_name]);

        return Image::pluck('id')->toArray();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }

}
