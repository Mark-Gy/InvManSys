@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Sizes List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href=" {{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Size Lists</li>
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
                  <h5 class="card-title m-0">Sizes List</h5>
                  <a href="{{ route('sizes.create') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Add New Size
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
                        @if($sizes)
                            @foreach($sizes as $key => $size)
                            <tr>
                                <td> {{ +$key + 1 }} </td>
                                <td> {{ $size->name ?? '' }} </td>
                                <td>
                                  <a href="{{ route('sizes.edit', $size->id) }}" class="btn btn-sm btn-info mr-1"><i class="fa fa-edit"></i> Edit</a>
                                  <a href="javascript:;" class="btn btn-sm btn-danger sa-delete" data-form-id="size-delete-{{ $size->id }}"><i class="fa fa-trash"></i> Delete</a>
                                  <form id="size-delete-{{ $size->id }}" action="{{ route('sizes.destroy', $size->id) }}" method="POST">
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