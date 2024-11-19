@extends('Layout.main')

@section('title', 'Ingredients')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Createuserpage</h1>
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
                        <form action="/userstore" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">UserName</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">UserEmail</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="user-select" class="form-label">Select User</label>
                                <select name="role" id="user-select" class="form-control">
                                    <option value="admin">admin</option>
                                    <option value="user" selected>user</option> 
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">UserPassword</label>
                                <input type="password" class="form-control" name="password">
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