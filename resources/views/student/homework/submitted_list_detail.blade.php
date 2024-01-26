


@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        {{-- <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tugas</h1>
          </div>
        </div> --}}
      </div> 
    </section>
 
    <section class="content">
      <div class="container-fluid">
        <div class="row">  
          <div class="col-md-12">   
         
            {{-- <div class="card">  
                <div class="card-header">
                  <h3 class="card-title">Search Tugas</h3>
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
                          <label>From Created Date</label>
                          <input type="date" class="form-control" name="from_created_date" value="{{ Request::get('created_date') }}">
                        </div> 
                        <div class="form-group col-md-2">
                          <label>To Created Date</label>
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
              <div class="card-header d-flex flex-column">
                <h1 class="card-title py-3" style="font-size: 2.8rem; font-weight: 300">{{ $getRecord->subject_name }}</h1>
                <span class="card-title pb-2" style="font-size: 1.4rem;"><a href="{{ url('student/homework/my_submitted_homework') }}">My Submitted homework</a> / {{ $getRecord->getHomework->tugas_title }}</span>
              </div>  
            </div> 
            <?php date_default_timezone_set('Asia/Jakarta'); ?>
            <div class="card">
              <div class="card-header d-flex flex-column">
                <h1 class="card-title py-3" style="font-size: 2.3rem; font-weight: 300">Status Pengiriman</h1>
                <span class="card-title pb-2" style="font-size: 1.2rem; border-bottom: 1px solid #dee2e6">
                  <table class="table table-striped">
                    <tbody> 
                      <tr>
                        <td class="text-primary font-weight-bolder">SOAL</td>
                        <td></td>
                      </tr>
                      <tr>
                        <th class="col-3">Tanggal Pengumpulan</th>
                        <td>{{ $getRecord->getHomework->submission_date }}</td>
                      </tr>
                      <tr>
                        <th class="col-3">Batas Pengumpulan</th>
                        <td>{{ $getRecord->getHomework->submission_limits }}</td>
                      </tr>
                      <tr>
                        <th class="col-3">Berkas</th>
                        <td>
                          @if (!empty($getRecord->getHomework->getDocument()))
                          <a href="{{ $getRecord->getHomework->getDocument() }}" class="btn btn-primary" download>Unduh</a>
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <th class="col-3">Deskripsi</th>
                        <td>{!! $getRecord->getHomework->description !!}</td>
                      </tr> 
                      <tr>
                        <td class="text-primary font-weight-bolder">JAWABAN</td>
                        <td></td>
                      </tr>
                      <tr>
                        <th class="col-3">Pengiriman Berkas</th>
                        <td>
                          @if (!empty($getRecord->getDocument()))
                                <a href="{{ $getRecord->getDocument() }}" class="btn btn-primary" download>Unduh</a>
                            @endif
                        </td>
                      </tr>
                      <tr>
                        <th class="col-3">Pengiriman Deskripsi</th>
                        <td>{!! $getRecord->description !!}</td>
                      </tr>
                      <tr>
                        <th class="col-3">Pengiriman Tanggal</th>
                        <td>{{ date('d-m-Y', strtotime($getRecord->created_at)) }}</td>
                      </tr>
                      <tr>
                        <th class="col-3">Nilai</th>
                        <td> 
                          @if ($getRecord->nilai >= 76 && $getRecord->nilai <= 100) 
                            <span  class="bg-success" style="border-radius: 14px; padding: 3px 7px">{{ $getRecord->nilai }}</span>
                          @elseif ($getRecord->nilai < 76 && $getRecord->nilai > 0)
                            <span  class="bg-danger" style="border-radius: 14px; padding: 3px 7px">{{ $getRecord->nilai }}</span>
                            @elseif ($getRecord->nilai == 0)
                            <span class="bg-warning" style="border-radius: 5px; padding: 3px 7px;white-space: nowrap;">Belum dinilai</span>
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <th class="col-3">Pegiriman Telat</th>
                        <td>
                          @if ($getRecord->submission_late == '-')
                          <span class="bg-success" style="padding: 2px 5px;border-radius: 5px">Terimakasih Anda mengirim sesuai waktu</span>
                        @else
                          <span class="bg-danger" style="padding: 2px 5px;border-radius: 5px">{{ $getRecord->submission_late }}</span>
                        @endif 
                        </td>
                      </tr>
                    </tbody>
                  </table>
                   
                </span> 
               

              </div>  
            </div> 

          </div> 
        </div>
      </div> 
    </section> 
  </div> 
@endsection