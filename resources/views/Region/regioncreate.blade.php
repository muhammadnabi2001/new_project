@extends('Layout.main')

@section('title', 'Reioncreate')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Createregionpage</h1>
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
                        <form action="/regionstore" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Region Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="user-select" class="form-label">Select User</label>
                                <select name="user_id" id="user-select" class="form-control">
                                    <option value="" disabled selected>Select a user</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Create</button>
                        </form>
                        
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection