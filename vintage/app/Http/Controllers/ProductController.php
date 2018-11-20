<?php

namespace App\Http\Controllers;

use App\Model\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $product->save();

        return redirect('products')->with('success', 'Information has been added');
    }

    public function show($id)
    {       
        /*
        $product = Product::find($id);

        return view('admin.product.edit', compact('product','id'));   
        */
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
