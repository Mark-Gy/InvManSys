@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Brands List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href=" {{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Brands Lists</li>
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
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h5 class="card-title m-0">Brands List</h5>
                  <a href="{{ route('brands.create') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Add New Brand
                  </a>
                </div>
                
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th>#SL</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($brands)
                            @foreach($brands as $key => $brand)
                            <tr>
                                <td> {{ +$key + 1 }} </td>
                                <td> {{ $brand->name ?? '' }} </td>
                                <td>
                                  <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-sm btn-info mr-1"><i class="fa fa-edit"></i> Edit</a>
                                  <a href="javascript:;" class="btn btn-sm btn-danger sa-delete" data-form-id="brand-delete-{{ $brand->id }}"><i class="fa fa-trash"></i> Delete</a>
                                  <form id="brand-delete-{{ $brand->id }}" action="{{ route('brands.destroy', $brand->id) }}" method="POST">
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
            </div><!-- /.card -->
          </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection