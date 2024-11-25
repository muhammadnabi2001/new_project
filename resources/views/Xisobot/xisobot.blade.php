@extends('Layout.main')

@section('title', 'Boshqaruv')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        
        <div class="container-fluid">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <script>
                setTimeout(function() {
                    var alert = document.getElementById('successAlert');
                    if (alert) {
                        var bootstrapAlert = new bootstrap.Alert(alert);
                        bootstrapAlert.close();
                    }
                }, 3000);
            </script>
            @endif

            <form action="" method="GET">
                @csrf
                <div class="card p-3">
                    <div>
                        <h4>Xisobot page</h4>
                    </div>
                </div>
            </form>


        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card p-3">
                    <div class="row">
                        <form action="{{route('xisobotfiltr')}}" method="POST">
                            @csrf
                            <div class="card p-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="date" id="start_date" class="form-control" name="start">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="date" id="end_date" class="form-control" name="end">
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-end">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info btn-block">
                                                <i class="fas fa-filter"></i> Filtr
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
            
                    </div>
                </div>
                <div class="col-12">
                    <div class="table-responsive">
                        <!-- resources/views/report/index.blade.php -->

                        <table class="table table-bordered table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 50px; text-align: center; white-space: nowrap;">No</th>
                                    <th style="text-align: left; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">Hududlar/Category</th>
                                    <th style="width: 100px; text-align: center; white-space: nowrap;">Jami kelib tushgan</th>
                                    <th style="width: 100px; text-align: center; white-space: nowrap;">Hal etilgan</th>
                                    <th style="width: 100px; text-align: center; white-space: nowrap;">Muddati buzilgan</th>
                                    <th style="width: 100px; text-align: center; white-space: nowrap;">Jarayonda</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 50px; text-align: center;">1</td>
                                    <td style="width: 100px; text-align: center; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Hudud</td>
                                    <td style="width: 100px; text-align: center;">{{ $regiontopshiriqlar->count() }}</td> 
                                    <td style="width: 100px; text-align: center;">{{ $regiontopshiriqlar->where('status', 'approwed')->count() }}</td> 
                                    <td style="width: 100px; text-align: center;">
                                        {{ $regiontopshiriqlar->where('status', '!=', 'approwed')->where('muddat', '<', now())->count() }}
                                    </td>
                                    <td style="width: 100px; text-align: center;">{{ $regiontopshiriqlar->where('status', 'ochilgan')->count() }}</td> 
                                </tr>
                                @foreach($categories as $category)
                                    <tr>
                                        <td style="width: 50px; text-align: center;">{{ $loop->iteration + 1 }}</td> 
                                        <td style="width: 100px; text-align: center; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $category->name }}</td> 
                                        <td style="width: 100px; text-align: center;">{{ $regiontopshiriqlar->where('category_id', $category->id)->count() }}</td> 
                                        <td style="width: 100px; text-align: center;">{{ $regiontopshiriqlar->where('category_id', $category->id)->where('status', 'approwed')->count() }}</td>
                                        <td style="width: 100px; text-align: center;">
                                            {{ $regiontopshiriqlar->where('category_id', $category->id)->where('status', '!=', 'approwed')->where('muddat', '<', now())->count() }}
                                        </td>
                                        <td style="width: 100px; text-align: center;">{{ $regiontopshiriqlar->where('category_id', $category->id)->where('status', 'ochilgan')->count() }}</td> 
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