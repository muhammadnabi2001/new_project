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
                        <h3>Barchasi - {{$barchasi}} ta</h3>

                        <p>Hammasini ko'rish</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="/topshiriqlar" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>2 kun - {{$twodays->count()}} ta</sup></h3>

                        <p>Hammasini ko'rish</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('calculate',2)}}" class="small-box-footer"><i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>Ertaga - {{$tomorrow->count()}} ta </h3>

                        <p>Hammasini ko'rish</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{route('calculate',1)}}" class="small-box-footer"><i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>Bugun - {{$today->count()}} ta</h3>

                        <p>Hammasini ko'rish</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{route('calculate',0)}}" class="small-box-footer"><i
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


            <div class="card p-3">
                <div class="row mb-3">
                    <div class="col-sm-6 d-flex justify-content-start">
                        <a href="/topshiriqcreate" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus-circle"></i> Create
                        </a>
                    </div>
                </div>
            </div>
            <div class="card p-3">
                <div class="row mb-3">
                    <div class="col-sm-6 d-flex justify-content-start">
                        <h1>
                            Topshiriqlar Ro'yxati
                        </h1>
                    </div>
                </div>
            </div>
            <form action="{{route('filtr')}}" method="GET">
                @csrf
                <div class="card p-3">
                    <div class="row">
                        <!-- Boshlanish sanasi -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="date" id="start_date" class="form-control" name="start">
                            </div>
                        </div>
                        <!-- Tugash sanasi -->
                        <div class="col-md-4">
                            <div class="form-group">
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
                        <table class="table table-striped" style="border:5px;">
                            <thead>

                                <tr>
                                    <th>No</th>
                                    <th>Hudud</th>
                                    <th>Ijrochisi</th>
                                    <th>Fayl</th>
                                    <th>Yuborilgan vaqti</th>
                                    <th>muddati</th>
                                    <th>statusi</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            @php
                            // Har bir sahifa uchun raqamni to'g'ri hisoblash
                            $i = ($regiontopshiriqlar->currentPage() - 1) * $regiontopshiriqlar->perPage() + 1;
                            @endphp
                            <tbody id="userTableBody">
                                @foreach($regiontopshiriqlar as $regiontopshiriq)
                                <tr>
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{$i++}}</td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">
                                        {{-- @foreach($regiontopshiriq->topshiriq->regions as $region)
                                        {{$region->name}} <br>
                                        @endforeach --}}
                                        {{$regiontopshiriq->region->name}}
                                    </td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{
                                        $regiontopshiriq->topshiriq->ijrochi }}</td>


                                    <td style="border: 1px solid #ddd; padding: 8px;">
                                        @if($regiontopshiriq->topshiriq->file)

                                        <a href="{{ asset('files/' .$regiontopshiriq->topshiriq->file) }}"
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
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{
                                        $regiontopshiriq->topshiriq->created_at }}</td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{
                                        $regiontopshiriq->topshiriq->muddat }}</td>

                                    <td style="border: 1px solid #ddd; padding: 8px;">


                                        @if($regiontopshiriq->status =='topshirildi')

                                        <a href="#"
                                            style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #ff0000; border-radius: 4px; color: #ff0000; cursor: not-allowed;pointer-events: none;"
                                            target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span style="font-size: 12px; margin-top: 5px;">topshirildi</span>
                                        </a>
                                        @endif
                                        @if($regiontopshiriq->status =='ochilgan')

                                        <a href="#"
                                            style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #007bff; border-radius: 4px; color: #007bff; pointer-events: none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0" />
                                                <path
                                                    d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708" />
                                            </svg>
                                            <span style="font-size: 12px; margin-top: 5px;">

                                                ochilgan
                                            </span>
                                        </a>
                                        @endif
                                        @if($regiontopshiriq->status == 'bajarildi')
                                        <a href="#"
                                            style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #176404d9; border-radius: 4px; color: #09ef20; pointer-events: none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 10.03a.75.75 0 0 0 1.08-.022l3.992-4.99a.75.75 0 1 0-1.151-.976L7.477 8.384 6.11 6.659a.75.75 0 1 0-1.22.874l1.5 2.25c.163.245.446.361.72.247z" />
                                            </svg>
                                            <span style="font-size: 12px; margin-top: 5px;">Bajargan</span>
                                        </a>
                                        @endif
                                        @if($regiontopshiriq->status == 'approwed')
                                        <!-- Rad etilgan tugma -->
                                        <a href="#"
                                            style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #afef00; border-radius: 4px; color: #50ef00; cursor: not-allowed; pointer-events: none;">
                                            <i class="fa fa-check" style="font-size: 20px;"></i>
                                            <span style="font-size: 12px; margin-top: 5px;">Tasdiqlangan</span>
                                        </a>
                                        @endif


                                    </td>

                                    <td style="border: 1px solid #ddd; padding: 8px;">
                                        <a href="{{route('topshiriqedit',$regiontopshiriq->topshiriq->id)}}"
                                            class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                <path
                                                    d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
                                            </svg></a>

                                        <a href="{{route('topshiriqdelete',$regiontopshiriq->id)}}"
                                            class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" fill="currentColor" class="bi bi-trash3-fill"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                            </svg></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $regiontopshiriqlar->appends(['start' => request('start'), 'end' => request('end')])->links()
                        }}
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection