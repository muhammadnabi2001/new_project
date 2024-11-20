@extends('Layout.main')

@section('title', 'Boshqaruv')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="row">
            <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Barchasi - {{$barchasi}} ta</h3>

                        <p>Hammasini ko'rish</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>2 kun -  ta</sup></h3>

                        <p>Hammasini ko'rish</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="" class="small-box-footer"><i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>Ertaga -  ta </h3>

                        <p>Hammasini ko'rish</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="" class="small-box-footer"><i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>2 kun -  ta</sup></h3>

                    <p>Hammasini ko'rish</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="" class="small-box-footer"><i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
            <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Barchasi -  ta</h3>

                        <p>Hammasini ko'rish</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>Bugun -  ta</h3>

                        <p>Hammasini ko'rish</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="" class="small-box-footer"><i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
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
                    <div class="row">
                        <!-- Boshlanish sanasi -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="start_date">Boshlanish sanasi:</label>
                                <input type="date" id="start_date" class="form-control" name="start">
                            </div>
                        </div>
                        <!-- Tugash sanasi -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="end_date">Tugash sanasi:</label>
                                <input type="date" id="end_date" class="form-control" name="end">
                            </div>
                        </div>
                        <!-- Filtr tugmasi -->
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

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <!-- resources/views/report/index.blade.php -->

                        <table class="table" style="width: 100%; border-collapse: collapse; border: 1px solid #ddd; text-align: center;">
                            <thead>
                                <tr>
                                    <th style="padding: 10px; border: 1px solid #ddd; background-color: #f8f9fa;">Hudud</th>
                                    <!-- Kategoriyalar uchun gorizontal tartib -->
                                    @foreach ($categories as $category)
                                        <th style="text-align: center; background-color: #f8f9fa; padding: 10px; border: 1px solid #ddd; 
                                            max-width: 120px; word-wrap: break-word; white-space: normal; word-break: break-word; 
                                            overflow: hidden;">
                                            <span style="display: inline-block; line-height: 1.2; text-align: center;">
                                                {{ $category->name }}
                                            </span>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($regions as $region)
                                    <tr>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $region->name }}</td>
                                        @foreach ($categories as $category)
                                            <td style="padding: 10px; border: 1px solid #ddd; vertical-align: middle;">
                                                @php
                                                    $topshiriqCount = $region->topshiriqlar->where('category_id', $category->id)->count();
                                                @endphp
                                                
                                                @if($topshiriqCount > 0)
                                                    <span style="display: inline-block; padding: 8px 15px; 
                                                                border-radius: 5px; background-color: #06ed5b; 
                                                                color: white; font-weight: bold; font-size: 14px; 
                                                                text-align: center; width: 50px; cursor: pointer;">
                                                        <a href="{{route('detail',[$region->id,$category->id])}}">
                                                            {{ $topshiriqCount }}
                                                        </a>
                                                    </span>
                                                @else
                                                    <span style="display: inline-block; padding: 8px 15px; 
                                                                border-radius: 5px; background-color: #6c757d; 
                                                                color: white; font-weight: bold; font-size: 14px; 
                                                                text-align: center; width: 50px; cursor: not-allowed;">
                                                        0
                                                    </span>
                                                @endif
                                            </td>
                                        @endforeach
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