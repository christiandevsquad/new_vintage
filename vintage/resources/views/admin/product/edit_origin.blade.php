@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>  

<style>
.btn-color{
color: #ffffff;
}

.centered {
height: 150px;
width: 150px;
overflow: hidden;
}

.vcenter {
display: inline-block;
vertical-align: middle;
float: none;
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
				@csrf
				<input name="_method" type="hidden" value="PATCH">

				<div class="row justify-content-center">        
					<div class="col">
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
							<textarea class="form-control" rows="10" name="description"><?php echo $product->description ?></textarea>
						</div> 
					</div>

					<div class="col">
						<div class="form-group">
							<nav class="navbar-nav navbar-expand-sm justify-content-end">
							<button type="button" class="btn btn-primary btn-sm ml-auto">PREVIEW</button>
							</nav>
						</div>

						@foreach($product->images as $image)
							<img src="{{URL::asset('/upload/'.$image->product_image)}}" class="img-thumbnail" width=100>
						@endforeach

						{{-- Upload multi-images section --}}
						@component('components.image-view')
						@endcomponent
						{{--
						@csrf	
						<div class="form-group">
							<div class="file-loading">
								<input id="file-1" type="file" name="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="1">
							</div>
						</div>

						--}}

						{{-- Tag input section --}}
						<div class="form-group">
							<label>Add Country Tags:</label>
							<input type="text" name="countries" placeholder="Type here.." class="typeahead tm-input form-control tm-input-info"/>
						</div>

						<div class="form-group">
							<input type="text" class="form-control" name="tag" value="<?php 
								$list = "";
								foreach($product->tags as $tag) { 
									$list .= " ".$tag->product_tag;
								} 

								print($list); 
								?>">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

{{--
<script type="text/javascript">
	$("#file-1").fileinput({
		theme: 'fa',
		uploadUrl: "/upload",
		uploadExtraData: function() {
			return {
				_token: $("input[name='_token']").val(),
			};
		},

		allowedFileExtensions: ['jpg', 'png', 'gif'],
		overwriteInitial: false,
		maxFileSize:2000,
		maxFilesNum: 10,

		slugCallback: function (filename) {
			return filename.replace('(', '_').replace(']', '_');
		}
	});
</script>
--}}
@endsection