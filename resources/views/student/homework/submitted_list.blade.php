@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pengumpulan Tugas</h1>
          </div>
        </div>
      </div> 
    </section>
 
    <section class="content">
      <div class="container-fluid">
        <div class="row">  
          <div class="col-md-12">   
         
            {{-- <div class="card">  
                <div class="card-header">
                  <h3 class="card-title">Search My Submited Homework</h3>
                </div>
                <form method="GET" action=""> 
                  <div class="card-body">
                    <div class="row">
                      <div class="form-group col-md-2">
                        <label>Class</label>
                        <input type="text" class="form-control" name="class_name" value="{{ Request::get('class') }}" placeholder="Class">
                      </div>
                      <div class="form-group col-md-2">
                        <label>Subject</label>
                        <input type="text" class="form-control" name="subject_name" value="{{ Request::get('subject_name') }}" placeholder="Subject Name">
                      </div> 
                      <div class="form-group col-md-2">
                          <label>From Homework Date</label>
                          <input type="date" class="form-control" name="from_homework_date" value="{{ Request::get('homework_date') }}">
                        </div> 
                        <div class="form-group col-md-2">
                          <label>To Homework Date</label>
                          <input type="date" class="form-control" name="to_homework_date" value="{{ Request::get('homework_date') }}">
                        </div> 
                      <div class="form-group col-md-2">
                          <label>From Submission Date</label>
                          <input type="date" class="form-control" name="from_submission_date" value="{{ Request::get('submission_date') }}">
                        </div> 
                        <div class="form-group col-md-2">
                          <label>To Submission Date</label>
                          <input type="date" class="form-control" name="to_submission_date" value="{{ Request::get('submission_date') }}">
                        </div> 
                      <div class="form-group col-md-2">
                          <label>From Submited Created Date</label>
                          <input type="date" class="form-control" name="from_created_date" value="{{ Request::get('created_date') }}">
                        </div> 
                        <div class="form-group col-md-2">
                          <label>To Submited Created Date</label>
                          <input type="date" class="form-control" name="to_created_date" value="{{ Request::get('created_date') }}">
                        </div> 
                      <div class="form-group col-md-3">  
                        <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                        <a href="{{ url('student/homework/my_homework') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                      </div> 
                    </div>
                  </div> 
                </form>
            </div> --}}

            @include('_message')

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Pengiriman Tugas</h3>
              </div> 
              <div class="card-body p-0" style="overflow-y:auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      {{-- <th>#</th> --}}
                      {{-- <th>Kelas</th> --}}
                      <th>Mata Pelajaran</th>
                      <th>Judul Tugas</th>
                      <th>Tanggal Tugas</th>
                      {{-- <th>Tanggal Pengumpulan</th>
                      <th>Batas Pengumpulan</th> --}}
                      {{-- <th>Berkas</th> --}}
                      <th>Deskripsi</th>
                      {{-- <th>Dibuat tanggal</th> --}}

                      {{-- <th>Pengiriman Berkas</th>  --}}
                      {{-- <th>Pengiriman Deskripsi</th>  --}}
                      <th >Pengiriman Tanggal</th> 
                      <th>Nilai</th>
                      <th>Pegiriman Telat</th>
                      <th>Aksi</th>
  
                    </tr>
                  </thead>
                  <tbody> 
                    @forelse ($getRecord as $value)
                    <tr>
                        {{-- <td style="background-color:rgb(246, 228, 228) ">{{ $value->id }}</td> --}}
                        {{-- <td style="background-color:rgb(246, 228, 228) ">{{ $value->class_name }}</td> --}}
                        <td style="">{{ $value->subject_name }}</td>
                        <td style="">{{ $value->getHomework->tugas_title }}</td>
                        <td style="">{{ date('d-m-Y', strtotime($value->getHomework->homework_date)) }}</td>
                        {{-- <td style="">{{ date('d-m-Y', strtotime($value->getHomework->submission_date)) }}</td>
                        <td style="">{{ date('d-m-Y', strtotime($value->getHomework->submission_limits)) }}</td> --}}
                        {{-- <td style="">
                            @if (!empty($value->getHomework->getDocument()))
                                <a href="{{ $value->getHomework->getDocument() }}" class="btn btn-primary" download>Unduh</a>
                            @endif
                        </td> --}}
                        <td style=" min-width: 250px">{!! $value->getHomework->description !!}</td> 
                        {{-- <td style="">{{ date('d-m-Y', strtotime($value->getHomework->created_at)) }}</td> --}}

                        {{-- <td>
                            @if (!empty($value->getDocument()))
                                <a href="{{ $value->getDocument() }}" class="btn btn-primary" download>Unduh</a>
                            @endif
                        </td> --}}
                        {{-- <td style=" min-width: 250px">>{!! $value->description !!}</td>  --}}
                        <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                        <td>
                          @if ($value->nilai >= 76 && $value->nilai <= 100) 
                            <span  class="bg-success" style="border-radius: 14px; padding: 3px 7px">{{ $value->nilai }}</span>
                          @elseif ($value->nilai < 76 && $value->nilai > 0)
                            <span  class="bg-danger" style="border-radius: 14px; padding: 3px 7px">{{ $value->nilai }}</span>
                            @elseif ($value->nilai == 0)
                            <span class="bg-warning" style="border-radius: 5px; padding: 3px 7px;white-space: nowrap;">Belum</span><br>
                            <span class="bg-warning" style="border-radius: 5px; padding: 3px 7px;white-space: nowrap;">dinilai</span>
                          @endif
                        </td>
                        <td style="white-space: nowrap;">
                          @if ($value->submission_late == '-')
                            <span class="bg-success" style="padding: 2px 5px;border-radius: 5px">Terimakasih</span><br>
                            <span class="bg-success" style="padding: 2px 5px;border-radius: 5px">Anda sesuai waktu</span>
                          @else
                            <span class="bg-danger" style="padding: 2px 5px;border-radius: 5px">{{ $value->submission_late }}</span>
                          @endif 
                        </td>
                        <td>
                          <a href="{{ url('student/homework/my_submitted_homework/edit/'.$value->id) }}" class="btn btn-warning btn-sm">Edit</a>
                          <a href="{{ url('student/homework/my_submitted_homework/'.$value->id) }}" class="btn btn-primary btn-sm">Detail</a>
                        </td>
                         
                    </tr>
                @empty
                    <tr>
                        <td colspan="100%">Tidak ada Record</td>
                    </tr>
                @endforelse
                  </tbody>
                </table>
                <div style="padding: 10px; float: right">
                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
              </div> 
            </div> 
          </div> 
        </div>
      </div> 
    </section> 
  </div> 
@endsection