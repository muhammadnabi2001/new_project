@extends('Layout.main')

@section('title', 'Answerpage')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Topshiriqanswerpage</h1>
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
                                <label class="form-label">Answer Title</label>
                                <input type="text" class="form-control" name="title" placeholder="input title">
                            </div>
                           
                            <div class="mb-3">
                                <label class="form-label">File</label>
                                <input type="file" class="form-control" name="file">
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection