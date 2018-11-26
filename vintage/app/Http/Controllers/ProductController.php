<?php

namespace App\Http\Controllers;

use App\Model\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class ProductController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = Product::paginate(10);

        return view('admin.product.index', ['user' => $user], compact('data'));
    }

    public function create()
    {
        return view('admin.product.add');
    }

    public function store(Request $request)
    {
        $product = new Product;

        $product->name = $request->name;
        $product->subName = $request->subName;
        $product->price = $request->price;
        $product->description = $request->description;

        //Images part
        $product->images()->saveMany($request->images()->allRelatedIds());

        //Tag part
        $product->tags()->sync($request->tags, false);

        $product->save();

        return redirect('products')->with('success', 'Information has been added');
    }

    public function show(Request $request)
    {       
        return $request->tags;
    }

    public function edit($id)
    {
        $product = Product::find($id);

        return view('admin.product.edit', compact('product', 'id'));
    }

    public function update(Request $request, $id)
    {

        $product = Product::find($id);

        $product->name = $request->name;
        $product->subName = $request->subName;
        $product->price = $request->price;
        $product->description = $request->description;

        //Images part
        $images = $request->file('images');

        if($request->hasFile('images')) {
            $product_image = new ImageController();
            $images_id = $product_image->store($request, $images, $product);
            // $product->images()->saveMany(sync($images_id, false));
            $product->images()->saveMany($images_id);
        }

        //Tag part
        //$product->tags()->sync($request->tags, false);

        $product->save();

        return redirect('products');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect('products')->with('success', 'Information has been deleted');
    }
}
