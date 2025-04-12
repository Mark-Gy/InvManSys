@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Products Show</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href=" {{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Product Show</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <div class="row">
            <div class="col-sm-6">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h5 class="card-title">Product Info</h5><br><br>
                            <div class="card-body">
                                <table class="table table-sm table-bordered">
                                    <tr>
                                        <td>Product Name</td>
                                        <td>{{ $product->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Category</td>
                                        <td>{{ $product->category->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Brand</td>
                                        <td>{{ $product->brand->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>SKU</td>
                                        <td>{{ $product->sku ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Cost Price</td>
                                        <td>{{ $product->cost_price ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Retail Price</td>
                                        <td>{{ $product->retail_price ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Expiration Date</td>
                                        <td>{{ $product->expiration_date ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td>{{ $product->description ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>{{ $product->status ? 'Active' : 'Inactive' }}</td>
                                    </tr>
                                    
                                </table>
                            </div>
                            <a href=" {{ route('products.index') }}" class="btn btn-sm btn-dark"><i class="fa fa-arrow-left"></i> Back</a>
                            <!-- /.card-body -->
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h5 class="card-title">Image</h5><br><br>
                            <div class="card-body text-center">
                                <img src="{{ asset('storage/product_images/' .$product->image) ?? '' }}" alt="" style="width: 200px; height: 200px;">
                            </div>
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h5 class="card-title">Product Stock</h5><br><br>
                            <div class="card-body">
                                <table class="table table-sm table-bordered">
                                    @foreach ($product->product_stocks as $p_stock)
                                        <tr>
                                            <!-- Size is not showing up -->
                                            <td>{{ $p_stock->size->name ?? '' }}</td>
                                            <td>{{ $p_stock->location ?? '' }}</td>
                                            <td>{{ $p_stock->quantity ?? 0 }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection