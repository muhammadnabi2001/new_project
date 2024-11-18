@extends('Layout.main')

@section('title', 'Topshiriqlar')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Barchasi - {{$all}} ta</h3>

                        <p>Hammasini ko'rish</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="/ijro" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>2 kun - {{$twodays}} ta</sup></h3>

                        <p>Hammasini ko'rish</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('usertopshiriq',2)}}" class="small-box-footer"><i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>Ertaga - {{$tomorrow}} ta </h3>

                        <p>Hammasini ko'rish</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{route('usertopshiriq',1)}}" class="small-box-footer"><i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>Bugun - {{$today}} ta</h3>

                        <p>Hammasini ko'rish</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{route('usertopshiriq',0)}}" class="small-box-footer"><i
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


            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Topshiriqlar Ijrochisi</h1>
                </div>
            </div>

        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped" style="border:5px;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Hudud</th>
                                    <th>Ijrochisi</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Fayl</th>
                                    <th>Yuborilgan vaqti</th>
                                    <th>muddati</th>
                                    <th>category</th>
                                    <th>statusi</th>
                                    <th>Javob</th>
                                </tr>
                            </thead>
                            <tbody id="userTableBody">
                                @foreach($topshiriqlar as $topshiriq)
                                <tr>
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $topshiriq->id }}</td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">

                                        {{Auth::user()->region->name}}
                                    </td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $topshiriq->ijrochi }}</td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $topshiriq->title }}</td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $topshiriq->description }}</td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">
                                        @if($topshiriq->file)

                                        <a href="{{ asset('files/' . $topshiriq->file) }}"
                                            style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #007bff; border-radius: 4px; color: #007bff;"
                                            target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path d="M12 5v14M19 12l-7 7-7-7" />
                                            </svg>
                                            <span style="font-size: 12px; margin-top: 5px;">Yuklash</span>
                                        </a>
                                        @else
                                        <div
                                            style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid red; border-radius: 4px; color: red; cursor: not-allowed;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="10" stroke="red" fill="none" />
                                                <text x="12" y="16" text-anchor="middle"
                                                    style="font-size: 16px; fill: red;">?</text>
                                            </svg>
                                            <span style="font-size: 12px; margin-top: 5px;">Mavjud emas</span>
                                        </div>
                                        @endif
                                    </td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $topshiriq->created_at }}</td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $topshiriq->muddat }}</td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $topshiriq->category->name }}
                                    </td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">
                                        @foreach($topshiriq->regions as $r)
                                        @if($r->pivot->status == 'topshirildi' && Auth::user()->region->name ==
                                        $r->name)
                                        <a href="{{route('accept',[$topshiriq->id,$r->id])}}"
                                            style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #ff0000; border-radius: 4px; color: #ff0000;"
                                            target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span style="font-size: 12px; margin-top: 5px;">Qabul qilish</span>
                                        </a>
                                        @endif
                                        @if($r->pivot->status == 'ochilgan')
                                        <a href="#"
                                            style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #007bff; border-radius: 4px; color: #007bff; pointer-events: none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0" />
                                                <path
                                                    d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708" />
                                            </svg>
                                            <span style="font-size: 12px; margin-top: 5px;">Ochildi</span>
                                        </a>
                                        @endif
                                        @endforeach
                                    </td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">
                                        <a href="" class="btn btn-info" style="border-radius: 12%">Bajarish</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$topshiriqlar->links()}}
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection