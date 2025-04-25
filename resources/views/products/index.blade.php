@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Products List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Product Lists</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="card-title m-0">Products List</h5>
                                <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus"></i> Add New Product
                                </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th width="10%">Image</th>
                                            <th>Name</th>
                                            <th>SKU</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($products->count())
                                            @foreach($products as $key => $product)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/product_images/'.$product->image) }}" 
                                                         alt="{{ $product->name }}" 
                                                         class="img-thumbnail" 
                                                         width="70" 
                                                         height="70">
                                                </td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->sku }}</td>
                                                <td>{{ $product->category->name ?? 'N/A' }}</td>
                                                <td>{{ $product->brand->name ?? 'N/A' }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-primary mr-1"><i class="fa fa-desktop"></i> Show</a>
                                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-info mr-1"><i class="fa fa-edit"></i> Edit</a>
                                                    <a href="javascript:;" class="btn btn-sm btn-danger sa-delete" data-form-id="product-delete-{{ $product->id }}"><i class="fa fa-trash"></i> Delete</a>
                                                        <form id="product-delete-{{ $product->id }}" 
                                                              action="{{ route('products.destroy', $product->id) }}" 
                                                              method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7" class="text-center">No products found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection