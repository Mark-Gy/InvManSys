

@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Return Product History</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href=" {{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Return Product History Lists</li>
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
          <div class="col-lg-12">

            <div class="card card-primary card-outline">
              <div class="card-body">
                <h5 class="card-title">Return Product History</h5><br><br>
                
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th>#SL</th>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Size</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($return_products)
                            @foreach($return_products as $key => $return_product)
                            <tr>
                                <td> {{ +$key + 1 }} </td>
                                <td> {{ $return_product->date ?? '' }} </td>
                                <td> {{ $return_product->product->name ?? 'N/A' }} </td>
                                <td> {{ $return_product->size->name ?? 'N/A' }} </td>
                                <td> {{ $return_product->quantity ?? '' }} </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

              </div>
            </div><!-- /.card -->
          </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection