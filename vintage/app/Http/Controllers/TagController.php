<?php

namespace App\Http\Controllers;

use App\Model\Tag;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    public function index(Product $product)
    {
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($tags)
    {
    }

    public function edit(Tag $tag)
    {
        //
    }

    public function update($input_tags, $product_id)
    {
        $each_tag = explode(',', $input_tags[0]);
        $id_array = [];
        
        foreach($each_tag as $tag) {
            $tag_exist = Tag::where('product_tag', $tag)->pluck('id')->toArray();

            if (empty($tag_exist)) {
                $new_tag = new Tag;

                $new_tag->product_tag = $tag;
                $new_tag->product_id = $product_id;
                $new_tag->save();

                $id_array[] = $new_tag->id;
            }

            else {
                $id_array[] = $tag_exist[0];
            }
        }

        return $id_array;
    }

    public function destroy(Tag $tag)
    {
        //
    }
}
