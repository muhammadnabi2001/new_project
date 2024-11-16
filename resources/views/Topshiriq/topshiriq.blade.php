@extends('Layout.main')

@section('title', 'Topshiriqlar')

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
                    <h1 class="m-0">Topshiriqlar</h1>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6 mt-2">
                    <a href="/topshiriqcreate" class="btn btn-primary">Create</a>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ijrochi</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>muddati</th>
                                    <th>Hudud</th>
                                    <th>category</th>
                                    <th>Fayl</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody id="userTableBody">
                                @foreach($topshiriqlar as $topshiriq)
                                <tr>
                                    <td>{{ $topshiriq->id }}</td>
                                    <td>{{ $topshiriq->ijrochi }}</td>
                                    <td>{{ $topshiriq->title }}</td>
                                    <td>{{ $topshiriq->description }}</td>
                                    <td>{{ $topshiriq->muddat }}</td>
                                    <td>
                                        @foreach($topshiriq->regions as $region)
                                            {{$region->name}}
                                        @endforeach
                                    </td>
                                    <td>{{ $topshiriq->category->name }}</td>
                                    <td>
                                        <a href="{{ asset('files/' . $topshiriq->file) }}" 
                                           style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #007bff; border-radius: 4px; color: #007bff;" 
                                           target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path d="M12 5v14M19 12l-7 7-7-7" />
                                            </svg>
                                            <span style="font-size: 12px; margin-top: 5px;">Yuklash</span>
                                        </a>
                                    </td>
                                    
                                    
                                    
                                    <td>
                                        <a href="{{route('topshiriqedit',$topshiriq->id)}}" class="btn btn-success">Update</a>
                                    </td>
                                    <td>
                                        <a href="{{route('topshiriqdelete',$topshiriq->id)}}" class="btn btn-danger">Delete</a>
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