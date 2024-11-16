@extends('Layout.main')

@section('title', 'Ingredients')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Topshiriqupdatepage</h1>
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
                        <form action="{{route('topshiriqupdate',$topshiriq->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="category" class="form-label">Select User</label>
                                <select name="category_id" id="category" class="form-control">
                                    <option value="{{$topshiriq->category->id}}" selected>{{$topshiriq->category->name}}</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ijrochi</label>
                                <input type="text" class="form-control" name="ijrochi" placeholder="input ijrochi name"
                                    value="{{$topshiriq->ijrochi}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="input title"
                                    value="{{$topshiriq->title}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="3"
                                    placeholder="Input text">{{ $topshiriq->description }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">File</label>
                                <input type="file" class="form-control" name="file">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Muddat</label>
                                <input type="datetime-local" class="form-control" name="muddat"
                                    value="{{$topshiriq->muddat}}">
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