@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content mt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $total_users ?? 0 }}</h3>

                            <p>Users</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{ route('users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $total_products ?? 0 }}</h3>

                            <p>Products</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <a href="{{ route('products.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3 class="text-white">{{ $total_stocks_in ?? 0 }}</h3>

                            <p class="text-white">Stocks In</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-box"></i>
                        </div>
                        <a href="{{ route('stockHistory') }}" class="small-box-footer text-white">More info <i class="fas fa-arrow-circle-right text-white"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3 class="text-white">{{ $total_return_products ?? 0 }}</h3>

                            <p>Returned Products</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-truck"></i>
                        </div>
                        <a href="{{ route('returnProductHistory') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>


            <div class="card card-primary card-outline">
                <div class="card-body">
                    <table class="table table-bordered table-sm text-center">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>SKU</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($recent_products)
                            @foreach($recent_products as $key => $product)
                                <tr>
                                    <td> {{ +$key + 1 }} </td>
                                    <td>
                                        <image width="80px" height="80px" src="{{ asset('storage/product_images/'.$product->image) }}"></image>
                                    </td>
                                    <td> {{ $product->name ?? '' }} </td>
                                    <td> {{ $product->sku ?? '' }} </td>
                                    <td> {{ $product->category->name ?? '' }} </td>
                                    <td> {{ $product->brand->name ?? '' }} </td>
                                    <td>
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-primary mr-1"><i class="fa fa-desktop"></i> Show</a>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-info mr-1"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="javascript:;" class="btn btn-sm btn-danger sa-delete" data-form-id="product-delete-{{ $product->id }}"><i class="fa fa-trash"></i> Delete</a>
                                        <form id="product-delete-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>

<!-- Recently Sold Items -->
<div class="card card-primary card-outline mt-4">
            <div class="card-header">
                <h3 class="card-title">Recently Sold Items</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm text-center">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Sold Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($latest_sales)
                        @foreach($latest_sales as $key => $sale)
                            <tr>
                                <td>{{ +$key + 1 }}</td>
                                <td>
                                    <image width="80px" height="80px" src="{{ asset('storage/product_images/'.$sale->product->image) }}"></image>
                                </td>
                                <td>{{ $sale->product->name ?? '' }}</td>
                                <td>{{ $sale->size->name ?? '' }}</td>
                                <td>{{ $sale->quantity }}</td>
                                <td>{{ $sale->sold_at->format('M d, Y') }}</td>
                                <td>
                                    <a href="{{ route('products.show', $sale->product->id) }}" class="btn btn-sm btn-primary mr-1"><i class="fa fa-desktop"></i> View Product</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Top Sold Items -->
        <div class="card card-primary card-outline mt-4">
            <div class="card-header">
                <h3 class="card-title">Top Sold Items</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm text-center">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Total Sold</th>
                        <th>Last Sold</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($top_products)
                        @foreach($top_products as $key => $product)
                            <tr>
                                <td>{{ +$key + 1 }}</td>
                                <td>
                                    <image width="80px" height="80px" src="{{ asset('storage/product_images/'.$product->image) }}"></image>
                                </td>
                                <td>{{ $product->name ?? '' }}</td>
                                <td>{{ $product->sku ?? '' }}</td>
                                <td>{{ $product->category->name ?? '' }}</td>
                                <td><span class="badge badge-success">{{ $product->total_sold }}</span></td>
                                <td>{{ $sale->sold_at->format('M d, Y') }}</td>
                                <td>
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-primary mr-1"><i class="fa fa-desktop"></i> Show</a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-info mr-1"><i class="fa fa-edit"></i> Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        


        </div>
    </div>
@endsection