

@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href=" {{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Users Lists</li>
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
                <h5 class="card-title">Users List</h5><br><br>

                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"></i> Add New User
                    </a><br><br>
                @endif

                
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th>#SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created At (MM-DD-YYYY)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($users)
                            @foreach($users as $key => $user)
                            <tr>
                                <td> {{ +$key + 1 }} </td>
                                <td> {{ $user->name ?? '' }} </td>
                                <td> {{ $user->email ?? '' }} @if(auth()->id() == $user -> id) (you) @endif </td>
                                <td> {{ $user->created_at->format('m-d-Y') ?? '' }} </td>
                                <td>
                                    @if(auth()->user()->role === 'admin' || auth()->id() === $user->id)
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning mr-1">Edit</a>
                                    @endif

                                    @if(auth()->id() != $user->id && auth()->user()->role === 'admin')
                                        <a href="javascript:;" class="btn btn-sm btn-danger sa-delete" data-form-id="user-delete-{{ $user->id }}"><i class="fa fa-trash"></i> Delete</a>
                                        <form id="user-delete-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    </form>
                                    @endif

                                    <!-- @if (Auth::user()->role === 'admin')
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    @endif -->

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