@extends('layouts.app')

@section('content')

<div class="container">   
	<div class="row justify-content-center">
		<div class="col-2">			
			@component('components.sidebar')
			@endcomponent
		</div>

		<div class="col">
			<form action="{{ action('ProductController@store') }}" method="POST" enctype="multipart/form-data">
				<div class="row justify-content-center">        
					<div class="col">
						@csrf
						<div class="form-group">
							<nav class="navbar-nav navbar-expand-sm justify-content-end">
								<button type="submit" class="btn btn-primary mr-sm-2 btn-sm">UPDATE</button>
								<button href="{{ action('ProductController@index') }}" class="btn btn-warning btn-color mr-sm-2 btn-sm">CANCEL</button>
								<button type="button" class="btn btn-danger btn-sm ml-auto ">DELETE</button>
							</nav>
						</div>

						<div class="form-group">
							<input type="text" class="form-control" name="name" placeholder="Product name">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="subName" placeholder="Product sub-name">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="price" placeholder="Product price">
						</div>
						<div class="form-group">
							<textarea class="form-control" rows="15" name="description" placeholder="Product description"></textarea>
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
							<img src="{{URL::asset('/vintage_image/no.png')}}" alt="" width=120>
						</div>


						<div class="form-group">
							@csrf
							<input id="imgs" type="file"  name="images[]" accept="image/*" multiple>
						</div>

						{{-- Tag input section - Needs to treat the called action --}}
						<div class="form-group">
							<div class="form-group">
								<input type="text" class="form-control" name="tags[]" data-role="tagsinput" value="">
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection