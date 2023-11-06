@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Submited Homework</h1>
          </div>
        </div>
      </div> 
    </section>
 
    <section class="content">
      <div class="container-fluid">
        <div class="row">  
          <div class="col-md-12">   
         
            <div class="card">  
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
                        <a href="{{ url('student/my_homework') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                      </div> 
                    </div>
                  </div> 
                </form>
              </div>

            @include('_message')

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Submited Homework List</h3>
              </div> 
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Class</th>
                      <th>Subject</th>
                      <th>Homework Date</th>
                      <th>Submission To</th>
                      <th>Document</th>
                      <th>Description</th> 
                      <th>Created Date</th> 

                      <th>Submited Document</th> 
                      <th>Submited Description</th> 
                      <th>Submited Created Date</th> 
                    </tr>
                  </thead>
                  <tbody> 
                    @forelse ($getRecord as $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->class_name }}</td>
                        <td>{{ $value->subject_name }}</td>
                        <td>{{ date('d-m-Y', strtotime($value->getHomework->homework_date)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($value->getHomework->submission_date)) }}</td>
                        <td>
                            @if (!empty($value->getHomework->getDocument()))
                                <a href="{{ $value->getHomework->getDocument() }}" class="btn btn-primary" download>Download</a>
                            @endif
                        </td>
                        <td>{!! $value->getHomework->description !!}</td> 
                        <td>{{ date('d-m-Y', strtotime($value->getHomework->created_at)) }}</td>

                        <td>
                            @if (!empty($value->getDocument()))
                                <a href="{{ $value->getDocument() }}" class="btn btn-primary" download>Download</a>
                            @endif
                        </td>
                        <td>{!! $value->description !!}</td> 
                        <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                         
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