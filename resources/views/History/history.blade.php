@extends('Layout.main')

@section('title', 'Users')

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
                        <h1 class="m-0">Users</h1>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-6 mt-2">
                        <!-- Button trigger modal -->
                        <a href="/usercreate" class="btn btn-primary">Create</a>
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
                                        <th>Model</th>
                                        <th>Action</th>
                                        <th>User</th>
                                        <th>Data</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody id="userTableBody">
                                    @foreach ($histories as $history)
                                        <tr>
                                            <td>{{ $history->id }}</td>
                                            <td>{{ class_basename($history->actionable_type) }}</td>
                                            <td>{{ $history->action }}</td>
                                            <td>{{ optional($history->user)->name ?? 'System' }}</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-dark" data-toggle="modal"
                                                    data-target="#exampleModal">
                                                    Detail
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Modal title
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body" style="max-height: 60vh; overflow-y: auto; padding: 20px;">
                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <th style="width: 30%;">ID</th>
                                                                        <td>{{ $history->id }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Model</th>
                                                                        <td>{{ class_basename($history->actionable_type) }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Action</th>
                                                                        <td>{{ $history->action }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>User</th>
                                                                        <td>{{ optional($history->user)->name ?? 'System' }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Data</th>
                                                                        <td>
                                                                            <pre class="bg-light p-2 rounded">{{ json_encode($history->data, JSON_PRETTY_PRINT) }}</pre>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Time</th>
                                                                        <td>{{ $history->created_at }}</td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $history->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$histories->links()}}
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
