@extends('Layout.main')

@section('title', 'Topshiriqlar')

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

            <form action="{{route('filtrnatija')}}" method="GET">
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
                                        Jami bajarilgan topshiriqlar
                                    </th>
                                </tr>
                                <tr>
                                    <th>ID</th>
                                    <th>Hudud</th>
                                    <th>Javob Fayl</th>
                                    <th>Yuborilgan vaqti</th>
                                    <th>Topshiriq title</th>
                                    <th>Topshiriq file</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody id="userTableBody">
                                @foreach($javoblar as $javob)
                                <tr>
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $javob->id }}</td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $javob->region->name }}</td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">
                                        @if($javob->file)

                                        <a href="{{ asset('files/' . $javob->file) }}"
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
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $javob->created_at }}</td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $javob->topshiriq->title }}
                                    </td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">
                                        @if($javob->topshiriq->file)

                                        <a href="{{ asset('files/' . $javob->topshiriq->file) }}"
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
                                    <td style="border: 1px solid #ddd; padding: 8px;">
                                        @if($javob->status == 'kutilmoqda')
                                        <!-- Qabul qilish tugmasi -->
                                        <a href="{{route('qabul',$javob->id)}}"
                                            style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #00a65a; border-radius: 4px; color: #00a65a; margin-bottom: 10px;">
                                            <i class="fa fa-check-circle" style="font-size: 20px;"></i>
                                            <span style="font-size: 12px; margin-top: 5px;">Qabul qilish</span>
                                        </a>

                                        <!-- Qaytarish tugmasi -->
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#qaytarishModal"
                                            style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #dd4b39; border-radius: 4px; color: #dd4b39;">
                                            <i class="fa fa-undo" style="font-size: 20px;"></i>
                                            <span style="font-size: 12px; margin-top: 5px;">Qaytarish</span>
                                        </a>

                                        <!-- Qaytarish Modal -->
                                        <div class="modal fade" id="qaytarishModal" tabindex="-1"
                                            aria-labelledby="qaytarishModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="qaytarishModalLabel">Qaytarish uchun
                                                            izoh</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Yopish"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="qaytarishForm" action="{{route('reject',$javob->id)}}"
                                                            method="POST">
                                                            @csrf
                                                            <textarea class="form-control" name="izoh"
                                                                placeholder="Izoh kiriting" required></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Bekor qilish</button>
                                                        <button type="submit" class="btn btn-danger"
                                                            form="qaytarishForm">Qaytarish</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if($javob->status == 'approwed')
                                        <!-- Tasdiqlangan tugma -->
                                        <a href="#"
                                            style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #afef00; border-radius: 4px; color: #50ef00; cursor: not-allowed; pointer-events: none;">
                                            <i class="fa fa-check" style="font-size: 20px;"></i>
                                            <span style="font-size: 12px; margin-top: 5px;">Tasdiqlangan</span>
                                        </a>
                                        @endif
                                        @if($javob->status == 'rejected')
                                        <!-- Rad etilgan tugma -->
                                        <a href="#"
                                            style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #dd4b39; border-radius: 4px; color: #dd4b39; cursor: not-allowed; pointer-events: none;">
                                            <i class="fa fa-times-circle" style="font-size: 20px;"></i>
                                            <span style="font-size: 12px; margin-top: 5px;">Rad etilgan</span>
                                        </a>
                                        @endif

                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$javoblar->links()}}
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection