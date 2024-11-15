@extends('Layout.main')

@section('title', 'Categories')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Categories</h1>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6 mt-2">
                    <!-- Button trigger modal -->
                    <a href="/categorycreate" class="btn btn-primary">Create</a>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <!-- table-responsive qo'shildi -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody id="userTableBody">
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a href="{{route('categoryedit',$category->id)}}" class="btn btn-success">Update</a>
                                    </td>
                                    <td>
                                        <a href="{{route('categorydelete',$category->id)}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection