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
                                    <th>statusi</th>
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
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $javob->topshiriq->title }}</td>
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
                                        @if($javob->status =='kutilmoqda')

                                        <a href="#"
                                            style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #0800ff; border-radius: 4px; color: #1100ff; cursor: not-allowed;pointer-events: none;"
                                            target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span style="font-size: 12px; margin-top: 5px;">Qabul qilish</span>
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