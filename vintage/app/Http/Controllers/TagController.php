<?php

namespace App\Http\Controllers;

use App\Model\Tag;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        return $product->tags;
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show($tags)
    {
        dd($tags);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update($input_tags, $product_id)
    {
        $each_tag = explode(',', $input_tags[0]);
        // To sync, I need only the tags IDs
        $id_array = [];
        
        foreach($each_tag as $tag) {
            // print_r($tag);
            $tag_exist = Tag::where('product_tag', $tag)->pluck('id')->toArray();

            if (empty($tag_exist)) {
                $new_tag = new Tag;

                $new_tag->product_tag = $tag;
                $new_tag->product_id = $product_id;
                // $new_tag->products()->sync($product_id, false);
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
