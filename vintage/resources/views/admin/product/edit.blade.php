@extends('layouts.app')

@section('content')



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
									<img src="{{URL::asset('/upload/'.$image->product_image)}}" class="img-thumbnail" width=150>
								@endforeach
							@else 
								<img src="{{URL::asset('/vintage_image/no.png')}}" alt="" width=150>
							@endif
						</div>


						<div class="form-group">
							@csrf
							<input id="imgs" type="file"  name="images[]" accept="image/*" multiple>
						</div>

						{{-- Tag input section - Needs to treat the called action --}}
						{{-- <form action="{{ action('TagController@index', $product) }}" method="GET" enctype="multipart/form-data">  --}}
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