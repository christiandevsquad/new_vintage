@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-2">
            @component('components.sidebar')
            @endcomponent
        </div>

        <div class="col-10">
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group mr-2" role="toolbar" aria-label="First group">
                    <a href="{{ action('ProductController@create') }}" class="btn btn-primary">Add Product</a>
                </div>

                <div class="btn-group mr-2" role="toolbar" aria-label="Second group">
                    <button type="button" class="btn btn-outline-success">Import Product</button>
                </div>

                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search product" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="button">Search</button>
                    </div>
                </div>
                
                <table class="table table-hover" id="table" style="margin-top:20px;" >
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Product Name</th>
                            <th class="text-center">Sub Name</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($data as $item)
                            <tr class='item{{ $item->id }}'>
                                <td style="text-align:center">{{ $item->id }}</td>
                                <td style="text-align:center">{{ $item->name }}</td>
                                <td style="text-align:center">{{ $item->subName }}</td>
                                <td style="text-align:center">{{ $item->price }}</td>
                                <td style="text-align:center">
                                    <a href="{{ action('ProductController@edit', $item->id) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ action('ProductController@destroy', $item->id) }}" class="btn btn-outline-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#table').DataTable( {
            "pagingType": "full_numbers"
        } );
    } );
</script>

@endsection