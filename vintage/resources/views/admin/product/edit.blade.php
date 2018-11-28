@extends('layouts.app')

@section('content')

<style>
.b {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    background-color: #555;
    color: white;
    font-size: 16px;
    padding: 12px 24px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    text-align: center;
}

.thumb {
    width: 100%;
    height: auto;
}

.container {
    position: relative;
    width: 100%;
    max-width: 400px;
}
</style>

<div class="container">   
	<div class="row justify-content-center">
		<div class="col-2">			
			@component('components.sidebar')
			@endcomponent
		</div>

		<div class="col">
			<form action="{{ action('ProductController@update', $id) }}" method="POST" enctype="multipart/form-data">
				<div class="row justify-content-center">        
					<div class="col">
						@csrf
						<input name="_method" type="hidden" value="PATCH">
						<div class="form-group">
							<nav class="navbar-nav navbar-expand-sm justify-content-end">
								<button type="submit" class="btn btn-primary mr-sm-2 btn-sm">UPDATE</button>
								<button href="{{ action('ProductController@index') }}" class="btn btn-warning btn-color mr-sm-2 btn-sm">CANCEL</button>
								<button type="button" class="btn btn-danger btn-sm ml-auto ">DELETE</button>
							</nav>
						</div>

						<div class="form-group">
							<input type="text" class="form-control" name="name" value="{{ $product->name }}">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="subName" value="{{ $product->subName }}">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="price" value="{{ $product->price }}">
						</div>
						<div class="form-group">
							<textarea class="form-control" rows="15" name="description"><?php echo $product->description ?></textarea>
						</div> 
					</div>

					<div class="col">
						<div class="form-group">
							<nav class="navbar-nav navbar-expand-sm justify-content-end">
								<button type="button" class="btn btn-primary btn-sm ml-auto">PREVIEW</button>
							</nav>
						</div>

						{{-- Upload multi-images section --}}

						<div class="form-group">
							@if(count($product->images) > 0)
								@foreach($product->images->slice(0,3) as $image)
									<img src="{{ URL::asset('/upload/'.$image->product_image) }}" class="thumb" width=120>
									{{--<button href="{{URL::to('products/' . $product->id . 'images' . $image->product_image}}" class="btn">Delete</button>
									URL::to('nerds/' . $value->id . '/edit') --}}
									<button href="{{ action('ImageController@index') }}" class="btn" method="GET">Delete</button>
									<input name="_method" type="hidden" value="GET">
								@endforeach
							@else 
								<img src="{{URL::asset('/vintage_image/no.png')}}" alt="" width=120>
							@endif
						</div>


						<div class="form-group">
							@csrf
							<input id="imgs" type="file"  name="images[]" accept="image/*" multiple>
						</div>

						<div class="form-group">
							@component('components.tag_input', ['product' => $product])
							@endcomponent
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection