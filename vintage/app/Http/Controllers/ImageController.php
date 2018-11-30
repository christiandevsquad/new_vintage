<?php

namespace App\Http\Controllers;

use App\Model\Image;
use App\Model\Product;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
        //
    }

    public function store(Request $request, $images, $product)
    {
        foreach($images as $input) {
            $new_image = new Image;

            $image_name = str_random(32);
            $file_type = $input->getClientOriginalExtension();
            $image_name .= '.'.$file_type;

            $input->move(public_path('upload'), $image_name);

            $new_image->product_image = $image_name;
            $new_image->product()->associate($product);
            $new_image->save();
        }

        return Image::whereNull('product_id');
    }

    public function show()
    {
    }

    public function edit(Image $image)
    {
        //
    }

    public function update(Request $request, Image $image)
    {
        //
    }

    public function destroy($p_id, $img_id)
    {
        $image = Image::find($img_id);
        $image->delete();

        return redirect()->route('products.edit', ['product' => $p_id]);
    }

}
