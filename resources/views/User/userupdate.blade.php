@extends('Layout.main')

@section('title', 'Ingredients')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Updateuserpage</h1>
                </div>
            </div>
            <div class="row mb-2">

            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-5">
                    <div class="table-responsive">
                        <!-- table-responsive qo'shildi -->
                        <form action="{{route('userupdate',$user->id)}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">User name</label>
                                <input type="text" class="form-control" placeholder="input username"
                                    name="name" value="{{$user->name}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">User email</label>
                                <input type="email" class="form-control" placeholder="input user email"
                                    name="email" value="{{$user->email}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">User Role</label>
                                <input type="tex" class="form-control" placeholder="input user role"
                                    name="role" value="{{$user->role}}">
                            </div>
                            <button type="submit" class="btn btn-success">Update</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection