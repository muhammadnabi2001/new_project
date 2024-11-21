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
                                <!-- Hudud uchun birinchi qator -->
                                <tr>
                                    <td style="width: 50px; text-align: center;">1</td> <!-- Hudud raqami -->
                                    <td style="width: 100px; text-align: left; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Hudud</td>
                                    <td style="width: 100px; text-align: center;">{{$regiontopshiriqlar->count()}}</td> <!-- Jami kelib tushgan -->
                                    <td style="width: 100px; text-align: center;">{{$regiontopshiriqlar->where('status','=','approwed')->count()}}</td> <!-- Hal etilgan -->
                                    <td style="width: 100px; text-align: center;">
                                        {{ $regiontopshiriqlar->where('status', 'topshirildi')
                                            ->filter(function($regiontopshiriq) {
                                                return $regiontopshiriq->topshiriq->where('muddat', '<', now());
                                            })
                                            ->count() }}
                                    </td>
                                    <td style="width: 100px; text-align: center;">{{$regiontopshiriqlar->where('status','=','bajarildi')->count()}}</td> <!-- Hal etilgan -->

                                    
                                </tr>
                                
                                @foreach($categories as $category)
                                    <tr>
                                        <td style="width: 50px; text-align: center;">{{ $loop->iteration + 1 }}</td> <!-- Raqam 1 dan boshlanadi -->
                                        <td style="width: 100px; text-align: left; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $category->name }}</td> <!-- Category nomi -->
                                        <td style="width: 100px; text-align: left; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{$category->topshiriqlar->count()}}</td> <!-- Category nomi -->
                                        <td style="width: 100px; text-align: center;">{{ $category->topshiriqlar->filter(function($topshiriq) use ($category) {
                                            return $topshiriq->regionTopshiriqlar->where('status', 'approwed')->count();
                                        })->count() }} </td>
                                        <td style="width: 100px; text-align: center;">{{ $category->topshiriqlar->where('muddat','<',now())->filter(function($topshiriq) use ($category) {
                                            return $topshiriq->regionTopshiriqlar->where('status', 'topshirildi')->count();
                                        })->count() }} </td>
                                        <td style="width: 100px; text-align: center;">{{ $category->topshiriqlar->filter(function($topshiriq) use ($category) {
                                            return $topshiriq->regionTopshiriqlar->where('status', 'bajarildi')->count();
                                        })->count() }} </td>
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