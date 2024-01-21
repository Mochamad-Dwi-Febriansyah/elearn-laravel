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
                      <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                      <a href="{{ url('teacher/attendance/student') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                    </div> 
                  </div>
                </div> 
              </form>
            </div> 

            @if(!empty(Request::get('class_id')) && !empty(Request::get('subject_id')))
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Student list</h3> 
                    <a href="{{ url('teacher/attendance/report/reportbyclass/export_pdf?class_id='.Request::get('class_id')).'&subject_id='.Request::get('subject_id')}}" class="btn btn-info" style="float: right">PDF</a>
                </div>
                <div class="card-body p-0" style="overflow: auto">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                               @foreach ($getAttendanceDate as $date)
                                   <th>{{ $date->attendance_date }}</th>
                               @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($getStudent))
                                @foreach ($getStudent as $value)
                                    <tr>
                                        <td>{{ $value->name }}{{ $value->last_name }}</td>
                                        {{-- <td>{{ $value }}</td> --}}
                                        @foreach ($getAttendanceDate as $date) 
                                            @foreach ($value->attendance as $item) 
                                              @if ($date->attendance_date == $item['attendance_date'])
                                                  {{-- <td>{{ $item['attendance_type'] }}<br> {{ $item['attendance_date'] }} </td> --}}
                                                  <td>
                                                    @if ($item['attendance_type'] == 1)
                                                        Present
                                                    @elseif($item['attendance_type'] == 2)
                                                        Late
                                                    @elseif($item['attendance_type'] == 3)
                                                        Absent
                                                    @elseif($item['attendance_type'] == 4)
                                                        Half Day 
                                                    @endif
                                                  </td>
                                              @endif
                                            @endforeach
                                        @endforeach
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

 {{-- {{ $item['attendance_date'] }} --}} 
                                            {{-- @foreach ($getAttendanceDate as $date) 
                                                @if (($item['attendance_date'] == $date->attendance_date))  
                                                    <td>
                                                        @if ($item['attendance_type'] == 1)
                                                            Present  {{ $item['attendance_date']}}
                                                        @elseif ($item['attendance_type'] == 2)
                                                            Late  {{ $item['attendance_date']}}
                                                        @elseif ($item['attendance_type'] == 3)
                                                            Absent  {{ $item['attendance_date']}}
                                                        @elseif ($item['attendance_type'] == 4)
                                                            Late Day  {{ $item['attendance_date']}}
                                                        @endif
                                                    </td>
                                                @elseif(!empty($item['attendance_date']))
                                                  <td>-</td>
                                                @elseif($item == null)
                                                    <td>d</td>
                                                @endif
                                            @endforeach --}}

@section('script')
    <script type="text/javascript">
     $('.SaveAttendance').change(function(e){
        
        var student_id = $(this).attr('id');
        var subject_id = $('#getSubject').val();
        // console.log(subject_id);
        var timetable_id = $('#getTimetable').val();
        var attendance_type = $(this).val();
        var class_id = $('#getClass').val();
        var attendance_date = $('#getAttendanceDate').val();
        // console.log(data = [
        //   subject_id,
        //   timetable_id,
        //   attendance_type
        // ]);

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