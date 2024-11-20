@extends('Layout.main')

@section('title', 'Answerpage')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="card p-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Topshiriqdetailpage</h1>
                </div>
            </div>
            </div>
            <div class="row mb-2">

            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped" style="border:5px;">
                        <thead>
                            <tr>
                                <th colspan="12"
                                    style="text-align: center; font-size: 18px; font-weight: bold; padding: 10px; color:#114ad0">
                                    Berilgan topshiriq
                                </th>
                            </tr>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Fayl</th>
                                <th>Yuborilgan vaqti</th>
                                <th>muddati</th>
                                <th>category</th>
                                <th>statusi</th>
                            </tr>
                        </thead>
                        
                        <tbody id="userTableBody">
                            <tr>
                                <td style="border: 1px solid #ddd; padding: 8px;">1</td>
                                <td style="border: 1px solid #ddd; padding: 8px;">{{
                                    $topshiriq->title }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px;">{{
                                    $topshiriq->description }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px;">
                                    @if($topshiriq->file)

                                    <a href="{{ asset('files/' .$topshiriq->file) }}"
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
                                    $topshiriq->created_at }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px;">{{
                                    $topshiriq->muddat }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px;">{{
                                    $topshiriq->category->name }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px;">

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
                                </td>



                               
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            
        </div>
    </section>
</div>
@endsection