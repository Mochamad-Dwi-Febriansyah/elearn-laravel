@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tugas</h1>
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
              <div class="card-header">
                <h3 class="card-title">Daftar Tugas</h3>
              </div> 
              <div class="card-body p-3"  style="overflow-y:auto;">
                <table class="table" > 
                  <tbody> 
                    @forelse ($getRecord as $value)  
                    <tr>
                      <th> 
                          <img src="{{ url('dist/img/icon.svg') }}" alt="" style="margin-right: 0.5rem">
                        <a href="{{ url('student/homework/my_homework/'.$value->id) }}">
                          @if ($value->tugas_title == NULL)
                           Tugas 
                          @else
                          {{ $value->tugas_title }}
                          @endif
                        </a> 
                        <div style="float: right;">
                            <span style="font-size: 0.8em; font-weight: 400; margin-right: 5px">{{ $value->subject_name }}</span>
                            <span style="font-size: 0.8em">dibuat {{ date('d-m-Y', strtotime($value->created_at)) }}</span>
                          </div>
                      </th>
                    </tr>
                    <tr>
                      <td class="pl-5" style="max-width: 300px; font-size: .9em; line-height: normal">{!! $value->description !!}</td>
                    </tr>  
                    <td class="m-4 p-4 border-0"></td>
                @empty 
                    <tr>
                        <td colspan="100%">Tidak ada Record</td>
                    </tr>
                @endforelse
                  </tbody >
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