@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Jurnal</h1>
          </div>
          <div class="col-sm-6" style="text-align: right">
            <a href="{{ url('teacher/my_jurnal') }}" class="btn btn-danger">Back</a> 
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
                  <h3 class="card-title">Search Class</h3>
                </div>
                <form method="GET" action=""> 
                  <div class="card-body">
                    <div class="row">
                      <div class="form-group col-md-2">
                        <label>Class</label>
                        <input type="text" class="form-control" name="class_name" value="{{ Request::get('class_name') }}" placeholder="Class Name">
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
                        <a href="{{ url('admin/homework/homework') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                      </div> 
                    </div>
                  </div> 
                </form>
              </div> --}}

            @include('_message')

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Jurnal List</h3>
              </div> 
              <div class="card-body p-0" style="overflow-x:auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Class</th>
                      <th>Subject</th> 
                      <th>Timetable</th> 
                      <th>Date</th>
                      {{-- <th></th> --}}
                      <th>Kompetensi Dasar</th>
                      <th>Indikator</th>
                      <th>Point</th>
                      <th>Created By</th>
                      <th>Created At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody> 
                    @forelse ($getRecord as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->class_name }}</td>
                            <td>{{ $value->subject_name }}</td> 
                            <td>{{ $value->start_time }}</td>  
                            <td>{{ $value->jurnal_date }}</td>
                            <td>{{ $value->kd }}</td>
                            <td>{{ $value->indikator }}</td>
                            <td>{{ $value->point }}</td>
                            <td>{{ $value->created_by_name }}</td>
                            <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                            <td>
                                <a href="{{ url('admin/material/material/edit/'.$value->id) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ url('admin/material/material/delete/'.$value->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%">Record not found</td>
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