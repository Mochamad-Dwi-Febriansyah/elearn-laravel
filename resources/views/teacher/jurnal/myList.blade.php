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

            <div class="card">  
              <div class="card-header">
                <h3 class="card-title">Search Attendance Report</h3>
              </div>
              <form method="GET" action=""> 
                <div class="card-body">
                  <div class="row">  
                    <div class="form-group col-md-2">
                      <label>Class</label>
                      <select name="class_id" class="form-control">
                        <option value="">Select</option>
                        @foreach ($getClass as $class)
                            <option {{ (Request::get('class_id') == $class->class_id) ? 'selected' : '' }} value="{{ $class->class_id }}">{{ $class->class_name }}</option>
                        @endforeach
                      </select>
                    </div>   
                    <div class="form-group col-md-4">  
                      <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                      <a href="{{ url('teacher/my_jurnal/list') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                    </div> 
                  </div>
                </div> 
              </form>
            </div> 
            
            @include('_message')
            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Jurnal List</h3>
                @if(Request::get('class_id'))
                  <a href="{{ url('teacher/my_jurnal/list/export_pdf?class_id='.Request::get('class_id')) }}" class="btn btn-info" style="float: right">PDF</a>
                @endif
                <form action="{{ url('teacher/my_jurnal/list/export_excel') }}" method="post" style="float: right;">
                  @csrf
                  <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}"> 
                  <button class="btn btn-primary" style=" margin-right: 4px">Export Excel</button>
                </form> 
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
                      <th>Kompetensi Dasar</th>
                      <th>Indikator</th> 
                      <th>Peserta Didik Tidak Hadir</th>
                      <th>Catatan</th>
                      <th>Semester</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody> 
                    @forelse ($getJurnal as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->class_name }}</td>
                            <td>{{ $value->subject_name }}</td> 
                            <td>{{ $value->week_name }}, {{ $value->timetable_start }}-{{ $value->timetable_end }}</td>  
                            <td>{{ $value->jurnal_date }}</td>
                            <td>{{ $value->kd }}</td>
                            <td>{{ $value->indikator }}</td> 
                            <td>
                              @foreach ($value->student as $getJurnal)
                                {{ $getJurnal['student_name'] }}, 
                              @endforeach
                            </td>
                            <td>{{ $value->catatan }}</td>
                            <td>{{ $value->semester }}</td>
                            <td style="min-width: 150px"> 
                                <a href="{{ url('teacher/my_jurnal/list/edit/'.$value->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <a href="{{ url('teacher/my_jurnal/list/delete/'.$value->id) }}" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%">Record not found</td>
                        </tr>
                    @endforelse
                  </tbody>
                </table>
                {{-- <div style="padding: 10px; float: right">
                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div> --}}
              </div> 
            </div> 
          </div> 
        </div>
      </div> 
    </section> 
  </div> 
@endsection