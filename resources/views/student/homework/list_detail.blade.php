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
                <span class="card-title pb-2" style="font-size: 1.4rem;"><a href="{{ url('student/homework/my_homework') }}">My homework</a> /  
                  @if ($getRecord->tugas_title == NULL)
                  Tugas 
                 @else
                 {{ $getRecord->tugas_title }}
                 @endif
                </span>
              </div>  
            </div> 
            <?php date_default_timezone_set('Asia/Jakarta'); ?>
            <div class="card">
              <div class="card-header d-flex flex-column">
                <h1 class="card-title py-3" style="font-size: 2.3rem; font-weight: 300">{{ $getRecord->tugas_title }}</h1>
                <span class="card-title pb-2" style="font-size: 1.2rem; border-bottom: 1px solid #dee2e6">
                  <p class="m-0"><b>Dibuka : </b> 
                    @if ( date('d-m-Y', strtotime($getRecord->submission_date)) <= date('d-m-Y') && date('d-m-Y', strtotime($getRecord->submission_limits)) >= date('d-m-Y') )
                    <span class="bg-success" style="padding: 2px 5px; border-radius: 5px">{{ $getRecord->submission_date }}</span>
                    @elseif ( date('d-m-Y', strtotime($getRecord->submission_date)) > date('d-m-Y') && date('d-m-Y', strtotime($getRecord->submission_limits)) >= date('d-m-Y') )
                    <span class="bg-warning" style="padding: 2px 5px; border-radius: 5px">{{ $getRecord->submission_date }}</span>
                    @else
                    <span class="bg-danger" style="padding: 2px 5px; border-radius: 5px">{{ $getRecord->submission_date }}</span>
                    @endif 
                    </p>
                  <p  class="m-0"><b>Ditutup : </b> 
                    @if ( date('d-m-Y', strtotime($getRecord->submission_limits)) >= date('d-m-Y') && date('d-m-Y', strtotime($getRecord->submission_date)) <= date('d-m-Y')) 
                    <span class="bg-success" style="padding: 2px 5px; border-radius: 5px">{{ $getRecord->submission_limits }}</span>
                    @elseif ( date('d-m-Y', strtotime($getRecord->submission_limits)) > date('d-m-Y') && date('d-m-Y', strtotime($getRecord->submission_date)) >= date('d-m-Y') )
                    <span class="bg-warning" style="padding: 2px 5px; border-radius: 5px">{{ $getRecord->submission_limits }}</span>
                    @else
                    <span class="bg-danger" style="padding: 2px 5px; border-radius: 5px">{{ $getRecord->submission_limits }}</span>
                    @endif
                  </p>
                </span>
                <div class="py-3" style="font-size: 1.2rem">
                  <p >
                    {!! $getRecord->description !!}
                  </p>
                </div>
                <div class="py-3" style="font-size: 1.2rem">
                  @if ( date('d-m-Y H:i:s', strtotime($getRecord->submission_date)) > date('d-m-Y H:i:s'))
                  <a class="btn btn-secondary" >Kirim Tugas</a>
                  @else
                  <a href="{{ url('student/homework/my_homework/submit_homework/'.$getRecord->id) }}" class="btn btn-primary">Kirim Tugas</a>
                  @endif  
                </div>

              </div>  
            </div> 

          </div> 
        </div>
      </div> 
    </section> 
  </div> 
@endsection