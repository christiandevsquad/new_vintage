@extends('layouts.app')

@section('content')

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
			<div class="row justify-content-center">        
				<div class="col">
					<form action="{{ action('ProductController@update', $id) }}" method="POST" enctype="multipart/form-data"> 
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
					</form>
				</div>

				<div class="col">
					<div class="form-group">
						<nav class="navbar-nav navbar-expand-sm justify-content-end">
						<button type="button" class="btn btn-primary btn-sm ml-auto">PREVIEW</button>
						</nav>
					</div>

					{{-- Upload multi-images section --}}
					{{--
					@component('components.image-view')
					@endcomponent
					--}}

					@foreach($product->images as $image)
						<img src="{{URL::asset('/upload/'.$image->product_image)}}" class="img-thumbnail" width=100>
					@endforeach

					{{-- Tag input section - Needs to treat the called action --}}
					<form action="{{ action('TagController@index', $product) }}" method="GET" enctype="multipart/form-data"> 
						@component('components.tag_input', ['product' => $product])
						@endcomponent
					</form>
				</div>
			</div>
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