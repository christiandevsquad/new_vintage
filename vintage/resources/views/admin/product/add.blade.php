@extends('layouts.app')

@section('content')

<div class="container">   
	<div class="row justify-content-center">
		<div class="col-2">			
			@component('components.sidebar')
			@endcomponent
		</div>

		<div class="col">
			@csrf
			<div class="row justify-content-center">        
				<div class="col">
					<form action="{{ action('ProductController@store') }}" method="POST" enctype="multipart/form-data"> 
						<div class="form-group">
							<nav class="navbar-nav navbar-expand-sm justify-content-end">
								<button type="submit" class="btn btn-primary mr-sm-2 btn-sm">UPDATE</button>
								<a href="{{ action('ProductController@index') }}" class="btn btn-warning btn-color mr-sm-2 btn-sm">CANCEL</a>
								<button type="button" class="btn btn-danger btn-sm ml-auto ">DELETE</button>
							</nav>
						</div>

						<div class="form-group">
							<input type="text" class="form-control" name="name" placeholder="Product name">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="subName" placeholder="Product subname">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="price" placeholder="Price">
						</div>
						<div class="form-group">
							<textarea class="form-control" rows="10" name="description" placeholder="Digit the products description"></textarea>
						</div> 
					</form>
				</div>

				<div class="col">
					<div class="form-group">
						<nav class="navbar-nav navbar-expand-sm justify-content-end">
						<button type="button" class="btn btn-primary btn-sm ml-auto">PREVIEW</button>
						</nav>
					</div>

					@component('components.image-view')
					@endcomponent
					{{-- 			
						<div class="form-group">
							<input type="text" class="form-control" name="tag" placeholder="tag">
						</div>

						<img src="{{ $product->product_image}}" class="img-fluid" alt="Responsive image">

						<form action="" method="post" enctype="multipart/form-data">
							<input type="file" name="files[]" multiple >
							<input type="submit" name="submit" value="Upload">
						</form>

						<div class="file-loading">
							<input id="input-ficons-3" name="input-ficons-3[]" multiple type="file">
						</div>
						<script>
						$("#input-ficons-3").fileinput({
							uploadUrl: "images/upload",
							previewFileIcon: '<i class="fa fa-file"></i>',
							allowedPreviewTypes: ['image', 'text'], // allow only preview of image & text files
							previewFileIconSettings: {
								'docx': '<i class="fa fa-file-word-o text-primary"></i>',
								'xlsx': '<i class="fa fa-file-excel-o text-success"></i>',
								'pptx': '<i class="fa fa-file-powerpoint-o text-danger"></i>',
								'pdf': '<i class="fa fa-file-pdf-o text-danger"></i>',
								'zip': '<i class="fa fa-file-archive-o text-muted"></i>',
							}
						});
						</script>
					--}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection