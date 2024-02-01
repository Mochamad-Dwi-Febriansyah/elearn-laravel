@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Student Attendance</h1>
          </div>
     
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">  
          <div class="col-md-12">  
            <div class="card">  
              <div class="card-header">
                <h3 class="card-title">Search Student Attendance</h3>
              </div>
              <form method="GET" action=""> 
                <div class="card-body">
                  <div class="row"> 
                    <div class="form-group col-md-2">
                      <label>Class</label>
                      <select name="class_id" id="getClass" required class="form-control">
                        <option value="">Select</option>
                        @foreach ($getClass as $class) 
                            <option {{ (Request::get('class_id') == $class->class_id) ? 'selected' : '' }} value="{{ $class->class_id }}">{{ $class->class_name }}</option>
                        @endforeach
                      </select>
                    </div>  
                    <div class="form-group col-md-3"> 
                      <label>Subject <span style="color: red">*</span></label><br>
                      <select name="subject_id" id="getSubject"  class="form-control">
                        <option value="{{ Request::get('subject_id') }}">Select Subject</option> 
                      </select> 
                    </div> 
                  <div class="form-group col-md-3">
                    <label>Timetable<span style="color: red">*</span></label><br>
                    <select name="timetable_id" id="getTimetable"  class="form-control">
                      <option value="{{ Request::get('timetable_id') }}">Select Timetable</option> 
                    </select> 
                  </div>
                    <div class="form-group col-md-2">
                      <label>Attendance Date</label>
                    <input type="date" name="attendance_date" id="getAttendanceDate" value="{{ Request::get('attendance_date') }}" required class="form-control">
                    </div>  
                    <div class="form-group col-md-3">  
                      <button class="btn btn-primary"type="submit" style="margin-top: 30px;">Search</button>
                      <a href="{{ url('teacher/attendance/student') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                    </div> 
                  </div>
                </div> 
              </form>
            </div> 

            @if(!empty(Request::get('class_id')) && !empty(Request::get('subject_id')) && !empty(Request::get('timetable_id')) && !empty(Request::get('attendance_date')))

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Student list</h3>
                    {{-- <input type="radio" class="GenerateAttendance">Generate  
                    <input type="radio" class="GenerateAttendance">Generate   --}}
                    <a  class="GenerateAttendance" style="float: right"></a> 
                </div>
                <div class="card-body p-0" style="overflow: auto">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <td>Student Name</td>
                                <th>Attendance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($getStudent) && !empty($getStudent->count()))
                                @foreach ($getStudent as $value)
                                @php
                                    $attendance_type = '';

                                    $getAttendance = $value->getAttendance($value->id, Request::get('class_id'), Request::get('attendance_date'));

                                    if(!empty($getAttendance->attendance_type)){
                                        $attendance_type = $getAttendance->attendance_type; 
                                    }
                                @endphp
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->name }} {{ $value->last_name }}</td>
                                        <td>
                                            <label style="margin-right: 10px;">
                                                <input value="1" type="radio" {{ ($attendance_type == '1') ? 'checked' : '' }} id="{{ $value->id }}"  class="SaveAttendance" name="attendance{{ $value->id }}">H
                                            </label>
                                            <label style="margin-right: 10px;">
                                                <input value="2" type="radio" {{ ($attendance_type == '2') ? 'checked' : '' }} id="{{ $value->id }}" class="SaveAttendance" name="attendance{{ $value->id }}">T
                                            </label>
                                            <label style="margin-right: 10px;">
                                                <input value="3" type="radio" {{ ($attendance_type == '3') ? 'checked' : '' }} id="{{ $value->id }}" class="SaveAttendance" name="attendance{{ $value->id }}">A
                                            </label>
                                            <label style="margin-right: 10px;">
                                                <input value="4" type="radio" {{ ($attendance_type == '4') ? 'checked' : '' }} id="{{ $value->id }}" class="SaveAttendance" name="attendance{{ $value->id }}">S
                                            </label>
                                            <label style="margin-right: 10px;">
                                                <input value="5" type="radio" {{ ($attendance_type == '5') ? 'checked' : '' }} id="{{ $value->id }}" class="SaveAttendance" name="attendance{{ $value->id }}">I
                                            </label>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @endif


          </div> 
        </div>
      </div> 
    </section> 
  </div> 
@endsection

@section('script')
    <script type="text/javascript">
     $('.GenerateAttendance').click(function(e){   
        var subject_id = $('#getSubject').val(); 
        var timetable_id = $('#getTimetable').val(); 
        var class_id = $('#getClass').val();
        var attendance_date = $('#getAttendanceDate').val();

        $.ajax({
            type: "POST",
            url: "{{ url('teacher/attendance/student/generate') }}",
            data: {
                "_token" : "{{ csrf_token() }}",  
                class_id: class_id,
                subject_id: subject_id,
                timetable_id: timetable_id,
                attendance_date: attendance_date,
                 
            },
            dataType: "json",
            success: function(data){
              alert(data.message); 
              setInterval('location.reload()', 1500);
            }
        });
     });
     $('.SaveAttendance').change(function(e){
        
        var student_id = $(this).attr('id');
        var subject_id = $('#getSubject').val();
        // console.log(subject_id);
        var timetable_id = $('#getTimetable').val();
        var attendance_type = $(this).val();
        var class_id = $('#getClass').val();
        var attendance_date = $('#getAttendanceDate').val(); 

        $.ajax({
            type: "POST",
            url: "{{ url('teacher/attendance/student/save') }}",
            data: {
                "_token" : "{{ csrf_token() }}",
                student_id: student_id,
                attendance_type: attendance_type,
                class_id: class_id,
                subject_id: subject_id,
                timetable_id: timetable_id,
                attendance_date: attendance_date,
                 
            },
            dataType: "json",
            success: function(data){
                alert(data.message); 
            }
        });
    }); 
  $(function() { 
        // $('.GenerateAttendance').remove();
        var subject_id = $('#getSubject').val(); 
        var timetable_id = $('#getTimetable').val(); 
        var class_id = $('#getClass').val();
        var attendance_date = $('#getAttendanceDate').val(); 
        $.ajax({
          type : "POST",
          url : "{{ url('teacher/attendance/student/cekAttendance') }}",
          data: {
                "_token" : "{{ csrf_token() }}",  
                class_id: class_id,
                subject_id: subject_id,
                timetable_id: timetable_id,
                attendance_date: attendance_date,
                 
            },
            dataType: "json",
            success: function(data){
              // console.log(data.success);
              $('.GenerateAttendance').append(data.success);
              $('.SaveAttendance').attr('disabled', 'disabled'); 
            }
        }); 
    $('#getClass').change(function() {
      var class_id = $(this).val();
      // console.log(class_id);
      $.ajax({
        type: "POST",
        url: "{{ url('teacher/ajax_get_subject') }}",
        data: {
          '_token' : '{{ csrf_token() }}',
          class_id : class_id
        },
        dataType : "json",
        success : function(data){
          $('#getSubject').html(data.success);
        }  
      }); 
      $('#getSubject').change(function() { 
        var subject_id = $(this).val();
        $.ajax({
          type : "POST",
          url : "{{ url('teacher/ajax_get_timetable') }}",
          data : {
            '_token' : '{{ csrf_token() }}',
            class_id : class_id,
            subject_id : subject_id
          },
          dataType : "json",
          success : function(data){
            $('#getTimetable').html(data.success);
          }
        });
      });
    });
      
  });
  </script> 
@endsection