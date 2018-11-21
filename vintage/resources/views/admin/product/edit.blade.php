@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/js/plugins/piexif.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/js/plugins/sortable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/js/plugins/purify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/js/fileinput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/themes/fa/theme.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/js/locales/(lang).js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>

<style type="text/css">
	.main-section{
		margin:0 auto;
		padding: 20px;
		margin-top: 100px;
		background-color: #fff;
		box-shadow: 0px 0px 20px #c1c1c1;
	}

	.fileinput-remove,

	.fileinput-upload{
		display: none;
	}

</style>

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
						{!! csrf_field() !!}
						<div class="form-group">
							<div class="file-loading">
								<input id="file-1" type="file" name="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="2">
							</div>
						</div>

						{{--
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="customFile">
							<label class="custom-file-label" for="customFile">Choose image</label>
						</div>

						<form action="" method="post" enctype="multipart/form-data">
							Select Image Files to Upload:
							<input type="file" name="files[]" multiple >
							<input type="submit" name="submit" value="UPLOAD">
						</form>
						--}}

						{{-- Tag input section --}}

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

@endsection