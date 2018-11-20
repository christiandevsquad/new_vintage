@extends('layouts.app')

@section('content')

<div class="container">
    @foreach($product->images as $image)
    <img src="{{URL::asset('/images/'.$image->product_image)}}" class="img-thumbnail">
    <img src="{{ $image->image }}">
    @endforeach
</div>