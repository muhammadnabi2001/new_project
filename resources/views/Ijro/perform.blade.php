@extends('Layout.main')

@section('title', 'Createtopshiriqs')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Createtopshiriqpage</h1>
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
                        <form action="/topshiriqstore" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Ijrochi FIO</label>
                                <input type="text" class="form-control" name="ijrochi" placeholder="input ijrochi name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="input title">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="3"
                                    placeholder="Input text"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Select Category</label>
                                <select name="category_id" id="category" class="form-control">
                                    <option value="" disabled selected>Select categories</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">File</label>
                                <input type="file" class="form-control" name="file">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Muddat</label>
                                <input type="datetime-local" class="form-control" name="muddat">
                            </div>
                            <div class="select2-purple mb-3">
                                <label>Hududlar</label>
                                <select class="select2 form-control" multiple="multiple" data-placeholder="Hududni tanlang" data-dropdown-css-class="select2-purple" style="width: 100%;" name="regions[]">
                                    @foreach($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
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