@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Class Timetable</h1>
          </div> 
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row"> 
          <!-- /.col -->
          <div class="col-md-12"> 
            <!-- /.card -->

            
            <div class="card">  
              <div class="card-header">
                <h3 class="card-title">Search Class Timetable</h3>
              </div>
              <form method="GET" action=""> 
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-3">
                        <label>Class Name</label>
                        <select name="class_id" id="" class="form-control getClass">
                            <option value="">Selected</option>
                            @foreach($getClass as $class)
                                <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                      </div>  
                    <div class="form-group col-md-3">
                        <label>Subject Name</label>
                        <select name="subject_id" id="" class="form-control getSubject">
                            <option value="">Selected</option>
                            @if(!empty($getSubject))
                                @foreach($getSubject as $subject)
                                    <option {{ (Request::get('subject_id') == $subject->subject_id) ? 'selected' : '' }} value="{{ $subject->subject_id }}">{{ $subject->subject_name }}</option>
                                @endforeach
                            @endif
                        </select>
                      </div>   
                      <div class="form-group col-md-3">  
                        <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                        <a href="{{ url('admin/class_timetable/list') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                      </div> 
                  </div>
                </div> 
              </form>
            </div>
 
            @if(!empty(Request::get('class_id')) && (Request::get('subject_id')))
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">CLass Timetable</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped"> 
                    <thead>
                        <tr>
                            <th>Week</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Room Number</th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach ($week as $value)
                            <tr>
                                <th>{{ $value['week_name'] }}</th>
                                <td>
                                    <input type="time" class="form-control" name="start_time" id="">
                                </td> 
                                <td>
                                    <input type="time" class="form-control" name="end_time" id="">
                                </td> 
                                <td>
                                    <input type="text" class="form-control" style="width: 200px;" name="room_number" id="">
                                </td> 
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
    
                  <div style="text-align: center; padding: 20px">
                      <button class="btn btn-primary">Submit</button>
                    </div>
  
                </div>
                <!-- /.card-body -->
            </div>
              <!-- /.card -->

            @endif

          </div>

          <!-- /.col -->

        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper --> 
@endsection

@section('script')
<script type="text/javascript">
        $('.getClass').change(function() {
            var class_id = $(this).val();
            $.ajax({
                url : "{{ url('admin/class_timetable/get_subject') }}",
                type: "POST",
                data : {
                    "_token" : "{{ csrf_token() }}",
                    class_id: class_id
                },
                dataType : "json",
                success : function(response){ 
                    $('.getSubject').html(response.html);
                }
            });
        });
</script>
@endsection