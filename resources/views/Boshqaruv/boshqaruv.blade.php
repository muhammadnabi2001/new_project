@extends('Layout.main')

@section('title', 'Boshqaruv')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="row">
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$barchasi}}</h3>

                        <p>Barchasi</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="/boshqaruv" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$twodays}} ta</sup></h3>

                        <p>2 kun qolganlari</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('order',['muddat',2])}}" class="small-box-footer"><i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$tomorrow}} ta</h3>

                        <p>ertaga</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{route('order',['muddat',1])}}" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{$today}} ta</sup></h3>

                        <p> bugungi </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('order',['muddat',0])}}" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$expired}} ta</h3>

                        <p>muddati buzilgan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{route('order',['muddat','expired'])}}" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$approved}} ta</h3>

                        <p>Hal etilgan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{route('order',['status','approwed'])}}" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
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
                    <div>
                        <h4>Boshqaruv page</h4>
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

                        <table class="table"
                            style="width: 100%; border-collapse: collapse; border: 1px solid #ddd; text-align: center;">
                            <thead>
                                <tr>
                                    <th style="padding: 10px; border: 1px solid #ddd; background-color: #f8f9fa;">Hudud
                                    </th>
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
                                        @if(isset($query) && isset($ask))
                                                @if($query=='muddat' && $ask !='expired')

                                                            @php
                                                            $ask=(int)$ask;
                                                            $topshiriqCount = $region->topshiriqlar()->where('status','!=','approwed')
                                                            ->whereDate('topshiriqs.'.$query, now()->addDays($ask))
                                                            ->where('topshiriqs.category_id', $category->id)
                                                            ->count();
                                                            @endphp
                                                @elseif($ask =='expired')
                                                             @php
                                                                $topshiriqCount = $region->topshiriqlar()
                                                                ->where('region_topshiriqs.'.$query,'<',now())
                                                                ->where('status','!=','approwed')
                                                                ->where('topshiriqs.category_id', $category->id)
                                                                ->count();
                                                            @endphp
                                                @elseif($ask =='approwed')
                                                             @php
                                                                $topshiriqCount = $region->topshiriqlar()
                                                                ->where('region_topshiriqs.'.$query,'=',$ask)
                                                                ->where('topshiriqs.category_id', $category->id)
                                                                ->count();
                                                            @endphp
                                                @endif

                                        @else
                                        @php

                                        $topshiriqCount = $region->topshiriqlar->where('category_id',
                                        $category->id)->count();
                                        @endphp
                                        @endif

                                        @if($topshiriqCount > 0 && isset($ask))
                                        @if($ask == 'expired')
                                        <a href="{{route('detail',[$region->id,$category->id,-1])}}">
                                            <span style="display: inline-block; padding: 8px 15px; 
                                                                border-radius: 5px; background-color: #fc0404; 
                                                                color: white; font-weight: bold; font-size: 14px; 
                                                                text-align: center; width: 50px; cursor: pointer;">
                                                {{ $topshiriqCount }}
                                            </span>
                                        </a>
                                        @elseif($ask == 2)
                                        <a href="{{route('detail',[$region->id,$category->id,2])}}">
                                            <span style="display: inline-block; padding: 8px 15px; 
                                                                border-radius: 5px; background-color: #06ed1d; 
                                                                color: white; font-weight: bold; font-size: 14px; 
                                                                text-align: center; width: 50px; cursor: pointer;">
                                                {{ $topshiriqCount }}
                                            </span>
                                        </a>
                                        @elseif($ask == 1)
                                        <a href="{{route('detail',[$region->id,$category->id,1])}}">
                                            <span style="display: inline-block; padding: 8px 15px; 
                                                                border-radius: 5px; background-color: #e5ed06; 
                                                                color: white; font-weight: bold; font-size: 14px; 
                                                                text-align: center; width: 50px; cursor: pointer;">
                                                {{ $topshiriqCount }}
                                            </span>
                                        </a>
                                        @elseif($ask == 0)
                                        <a href="{{route('detail',[$region->id,$category->id,0])}}">
                                            <span style="display: inline-block; padding: 8px 15px; 
                                                                border-radius: 5px; background-color: #0638ed; 
                                                                color: white; font-weight: bold; font-size: 14px; 
                                                                text-align: center; width: 50px; cursor: pointer;">
                                                {{ $topshiriqCount }}
                                            </span>
                                        </a>
                                        @else
                                        <a href="{{route('detail',[$region->id,$category->id,3])}}">
                                            <span style="display: inline-block; padding: 8px 15px; 
                                                                border-radius: 5px; background-color: #06ed5b; 
                                                                color: white; font-weight: bold; font-size: 14px; 
                                                                text-align: center; width: 50px; cursor: pointer;">
                                                {{ $topshiriqCount }}
                                            </span>
                                        </a>
                                        
                                        @endif
                                        @elseif($topshiriqCount > 0)
                                        <a href="{{route('detail',[$region->id,$category->id,5])}}">
                                            <span style="display: inline-block; padding: 8px 15px; 
                                                                border-radius: 5px; background-color: #06d6ed; 
                                                                color: white; font-weight: bold; font-size: 14px; 
                                                                text-align: center; width: 50px; cursor: pointer;">
                                                {{ $topshiriqCount }}
                                            </span>
                                        </a>
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