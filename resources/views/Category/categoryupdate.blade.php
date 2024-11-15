@extends('Layout.main')

@section('title', 'Updatecategory')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Updatecategorypage</h1>
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
                        <form action="{{route('categoryupdate',$category->id)}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">User name</label>
                                <input type="text" class="form-control" placeholder="input username"
                                    name="name" value="{{$category->name}}">
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