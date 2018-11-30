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
        return view('admin.product.new_add');
    }

    public function store(Request $request)
    {
        $product = new Product;

        $product->name = $request->name;
        $product->subName = $request->subName;
        $product->price = $request->price;
        $product->description = $request->description;

        $product->save();

        //Images part
        if ($request->hasFile('images')) {
            $images = $request->file('images');

            $product_image = new ImageController();

            $img_collection = $product_image->store($request, $images, $product);
            $product->images()->saveMany($img_collection);
        }

        //Tag part
        $input_tags = $request->tags;

        if (!empty($input_tags)) {
            $tag_control = new TagController();

            $tags_ids = $tag_control->update($input_tags, $product->id);
            $product->tags()->sync($tags_ids);
        }

        $product->save();

        return redirect('products')->with('success', 'Information has been added');
    }

    public function show(Request $request)
    {       
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
        if ($request->hasFile('images')) {
            $images = $request->file('images');

            $product_image = new ImageController();

            $img_collection = $product_image->store($request, $images, $product);
            $product->images()->saveMany($img_collection);
        }

        //Tag part
        $previous_tags = $product->tags()->pluck('product_tag')->toArray();
        $input_tags = $request->tags;

        // dd($previous_tags, $input_tags);

        if ($previous_tags != $input_tags) {
            $tag_control = new TagController();

            $tags_ids = $tag_control->update($input_tags, $product->id);
            $product->tags()->sync($tags_ids);
        }

        $product->save();

        return redirect('products');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect('products')->with('success', 'Information has been deleted');
    }

    // CSV import part
    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;
        
        $header = null;
        $data = [];

        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }

            fclose($handle);
        }

        return $data; // return an array
    }

    public function importCsv(Request $request)
    {
        if ($request->hasFile('csv')) {
            $csv_collection = $request->file('csv');
        }
        else {
            dd('PROBLEM');
        }

        foreach($csv_collection as $csv_file) {
            $file_name = $csv_file->getClientOriginalName();
            $csv_file->move(public_path('CSV'), $file_name);
            
            $file = public_path('CSV/'.$file_name);

            $customerArr = $this->csvToArray($file);

            for ($i = 0; $i < count($customerArr); $i++) {
                $product = new Product;

                $product->name = $customerArr[$i]['name'];
                $product->subName = $customerArr[$i]['subName'];
                $product->price = $customerArr[$i]['price'];
                $product->description = $customerArr[$i]['description'];
        
                $product->save();    
            }
        }

        return redirect('products');
    }
}
