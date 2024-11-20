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
                    <a href="/vazifa" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
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

            <form action="{{route('sort')}}" method="GET">
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
                        <table class="table table-striped" style="border:5px;">
                            <thead>
                                <tr>
                                    <th colspan="12"
                                        style="text-align: left; font-size: 18px; font-weight: bold; padding: 10px; color:#114ad0">
                                        Sizga berilgan topshiriqlar
                                    </th>
                                </tr>
                                <tr>
                                    <th>ID</th>
                                    <th>Ijrochisi</th>
                                    <th>Title</th>
                                    <th>Fayl</th>
                                    <th>Yuborilgan vaqti</th>
                                    <th>muddati</th>
                                    <th>category</th>
                                    <th>statusi</th>
                                    <th>view</th>
                                    <th>Javob</th>
                                </tr>
                            </thead>
                            <tbody id="userTableBody">
                                @foreach($topshiriqlar as $topshiriq)
                                <tr>
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $topshiriq->id }}</td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $topshiriq->ijrochi }}</td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $topshiriq->title }}</td>
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
                                        @if($r->pivot->status == 'ochilgan' && Auth::user()->region->name == $r->name)
                                        <!-- Tugma -->
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#bajarishModal{{$topshiriq->id}}"
                                            style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #e6cc08; border-radius: 4px; color: #7d7114;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706l-1 1a.5.5 0 0 1-.706 0l-1-1a.5.5 0 0 1 .707-.707l.646.647.647-.647a.5.5 0 0 1 .706 0zM1 13.5V16h2.5L14.354 5.146l-2.5-2.5L1 13.5zm1.5-.707L12.646 2.647l2.5 2.5L5 15H2.5v-2.207z" />
                                            </svg>
                                            <span style="font-size: 12px; margin-top: 5px;">Bajarish</span>
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="bajarishModal{{$topshiriq->id}}" tabindex="-1"
                                            aria-labelledby="bajarishModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="bajarishModalLabel{{$topshiriq->id}}">Topshiriqni
                                                            bajarish</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('bajarish', $topshiriq->id) }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="exampleTextarea{{$topshiriq->id}}"
                                                                    class="form-label">Topshiriq Title</label>
                                                                <textarea class="form-control"
                                                                    id="exampleTextarea{{$topshiriq->id}}" rows="4"
                                                                    name="title"></textarea>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="fileInput{{$topshiriq->id}}"
                                                                    class="form-label">Fayl kiriting</label>
                                                                <input type="file" class="form-control"
                                                                    id="fileInput{{$topshiriq->id}}" name="file">
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Yopish</button>
                                                                <button type="submit"
                                                                    class="btn btn-success">Tasdiqlash</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @endif
                                        @if($r->pivot->status == 'bajarildi' && Auth::user()->region->name == $r->name)
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#bajarishModal{{$topshiriq->id}}"
                                            style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #e6cc08; border-radius: 4px; color: #2bb50f; background-color: #f8f9fa; text-align: center; pointer-events: none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-hourglass-top" viewBox="0 0 16 16">
                                                <path
                                                    d="M2 14.5a.5.5 0 0 0 .5.5h11a.5.5 0 1 0 0-1h-1v-1a4.5 4.5 0 0 0-2.557-4.06c-.29-.139-.443-.377-.443-.59v-.7c0-.213.154-.451.443-.59A4.5 4.5 0 0 0 12.5 3V2h1a.5.5 0 0 0 0-1h-11a.5.5 0 0 0 0 1h1v1a4.5 4.5 0 0 0 2.557 4.06c.29.139.443.377.443.59v.7c0 .213-.154.451-.443.59A4.5 4.5 0 0 0 3.5 13v1h-1a.5.5 0 0 0-.5.5m2.5-.5v-1a3.5 3.5 0 0 1 1.989-3.158c.533-.256 1.011-.79 1.011-1.491v-.702s.18.101.5.101.5-.1.5-.1v.7c0 .701.478 1.236 1.011 1.492A3.5 3.5 0 0 1 11.5 13v1z" />
                                            </svg>
                                            <span style="font-size: 12px; margin-top: 5px;">Kutilmoqda</span>
                                        </a>
                                        @endif
                                        @if($r->pivot->status == 'approwed' && Auth::user()->region->name == $r->name)
                                        <!-- Rad etilgan tugma -->
                                        <a href="#"
                                            style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #afef00; border-radius: 4px; color: #50ef00; cursor: not-allowed; pointer-events: none;">
                                            <i class="fa fa-check" style="font-size: 20px;"></i>
                                            <span style="font-size: 12px; margin-top: 5px;">Tasdiqlangan</span>
                                        </a>
                                        @endif

                                        @endforeach
                                    </td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">
                                        <a href="{{route('view',$topshiriq->id)}}" class="btn btn-success"
                                            style="border-radius: 12%"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16" fill="currentColor" class="bi bi-eye-fill"
                                                viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                                <path
                                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                            </svg></a>
                                    </td>
                                    <td>
                                        @if ($topshiriq->javob)
                                        @if ($topshiriq->javob->status == 'approwed')
                                        <div
                                            style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #28a745; border-radius: 4px; color: #28a745; background-color: #f8f9fa; text-align: center;">
                                            <i class="fas fa-check-circle" style="font-size: 16px;"></i>
                                            <span style="font-size: 12px; margin-top: 5px;">Accepted</span>
                                        </div>
                                        @elseif ($topshiriq->javob->status == 'rejected')
                                        <div style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #dc3545; border-radius: 4px; color: #dc3545; background-color: #f8f9fa; text-align: center; cursor: pointer;"
                                            data-bs-toggle="modal" data-bs-target="#rejectedModal{{$topshiriq->id}}">
                                            <i class="fas fa-times-circle" style="font-size: 16px;"></i>
                                            <span style="font-size: 12px; margin-top: 5px;">Qaytarilgan</span>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="rejectedModal{{$topshiriq->id}}" tabindex="-1"
                                            aria-labelledby="rejectedModalLabel{{$topshiriq->id}}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="rejectedModalLabel{{$topshiriq->id}}">Javob Izohi</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Javob Izohini chiqarish -->
                                                        @if ($topshiriq->javob->izoh)
                                                        <p>{{ $topshiriq->javob->izoh }}</p>
                                                        @else
                                                        <p>Izoh mavjud emas.</p>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Yopish</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div
                                            style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #ffc107; border-radius: 4px; color: #ffc107; background-color: #f8f9fa; text-align: center;">
                                            <i class="fas fa-exclamation-circle" style="font-size: 16px;"></i>
                                            <span style="font-size: 12px; margin-top: 5px;">Aniqlanmagan</span>
                                        </div>
                                        @endif
                                        @else
                                        <div
                                            style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #6c757d; border-radius: 4px; color: #6c757d; background-color: #f8f9fa; text-align: center;">
                                            <i class="fas fa-question-circle" style="font-size: 16px;"></i>
                                            <span style="font-size: 12px; margin-top: 5px;">Javob yo'q</span>
                                        </div>
                                        @endif
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