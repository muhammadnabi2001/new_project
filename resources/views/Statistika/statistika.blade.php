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
                        <h4>Statistika page</h4>
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

                        <table class="table table-bordered table-striped table-hover table-sm" style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <th rowspan="2">Categoryga</th>
                                    <th rowspan="2">Status</th>
                                    @foreach ($regions as $region)
                                        <th style="writing-mode: vertical-rl; text-align: center; transform: rotate(180deg); vertical-align: middle; white-space: nowrap; padding: 10px;">
                                            {{ $region->name }}
                                        </th>
                                    @endforeach
                                    <th rowspan="2" style="writing-mode: vertical-rl; text-align: center; transform: rotate(180deg); vertical-align: middle; white-space: nowrap; padding: 10px;">Jami</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    @foreach (['kelib_tushdi','topshirildi', 'approwed', 'bajarildi', 'muddati_buzilgan'] as $status)
                                        <tr>
                                            @if (($status == 'topshirildi' || $status == 'kelib_tushdi') && $loop->first)
                                                <td rowspan="5" style="vertical-align: middle; text-align: center; border: 1px solid #dee2e6; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100px;">{{ $category->name }}</td>
                                            @endif
                                            <td style="text-align: center; border: 1px solid #dee2e6;">
                                                @if ($status == 'topshirildi') Topshirildi
                                                @elseif ($status == 'approwed') Tasdiqlangan
                                                @elseif ($status == 'bajarildi') Bajarildi
                                                @elseif ($status == 'muddati_buzilgan') Muddati_buzilgan
                                                @elseif ($status == 'kelib_tushdi') Kelib tushdi
                                                @endif
                                            </td>
                                            
                                            @foreach ($regions as $region)
                                                <td style="border: 1px solid #dee2e6; text-align: center;">
                                                    @if($status != 'kelib_tushdi' && $status != 'muddati_buzilgan')
                                                        
                                                    @php
                                                        $regionToTask = $regiontopshiriqlar->where('category_id', $category->id)
                                                        ->where('region_id', $region->id)
                                                        ->where('status',$status)
                                                        ->count();
                                                        @endphp
                                                    @elseif($status == 'muddati_buzilgan')
                                                    @php
                                                    $regionToTask = $regiontopshiriqlar->where('category_id', $category->id)
                                                    ->where('region_id', $region->id)
                                                    ->where('muddat','<',now())
                                                    ->where('status','!=','approwed')
                                                    ->count();
                                                    @endphp
                                                    @else
                                                    @php
                                                        $regionToTask = $regiontopshiriqlar->where('category_id', $category->id)
                                                        ->where('region_id', $region->id)
                                                        ->count();
                                                        @endphp
                                                        @endif
                        
                                                    @if ($regionToTask > 0)
                                                        <ul style="margin: 0; padding: 0; list-style: none;">
                                                           
                                                            <button class="btn 
                                                            @if ($status == 'kelib_tushdi') btn-success
                                                            @elseif ($status == 'approwed') btn-primary
                                                            @elseif ($status == 'muddati_buzilgan') btn-danger
                                                            @elseif ($status == 'bajarildi') btn-success
                                                            @else btn-secondary
                                                            @endif">
                                                            {{ $regionToTask }}
                                                        </button>
                                                        </ul>
                                                    
                                                    @endif
                                                </td>
                                            @endforeach
                                            
                                            <td style="border: 1px solid #dee2e6; text-align: center;">
                                                @if($status != 'kelib_tushdi' && $status != 'muddati_buzilgan')
                                                @php
                                                    $count = $regiontopshiriqlar->where('category_id', $category->id)
                                                        ->where('status', $status)
                                                        ->count();
                                                @endphp
                                                @elseif($status == 'muddati_buzilgan')
                                                @php
                                                $count = $regiontopshiriqlar->where('category_id', $category->id)
                                                    ->where('muddat','<',now())
                                                    ->where('status','!=','approwed')
                                                    ->count();
                                            @endphp
                                                @else

                                                @php
                                                $count = $regiontopshiriqlar->where('category_id', $category->id)
                                                    ->count();
                                            @endphp
                                                @endif

                                                <button class="btn 
                                                @if ($status == 'kelib_tushdi') btn-success
                                                @elseif ($status == 'approwed') btn-primary
                                                @elseif ($status == 'muddati_buzilgan') btn-danger
                                                @elseif ($status == 'bajarildi') btn-success
                                                @else btn-secondary
                                                @endif">
                                                {{ $count }}
                                            </button>
                                            </td>
                                        </tr>
                                    @endforeach
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