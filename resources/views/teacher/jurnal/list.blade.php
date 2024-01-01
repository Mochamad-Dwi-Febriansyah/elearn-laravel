@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Jurnal</h1>
          </div>
          <div class="col-sm-6" style="text-align: right">
            <a href="{{ url('teacher/my_jurnal/list') }}" class="btn btn-primary">My Jurnal</a> 
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

            @include('_message')
            
            <div class="card">  
              <div class="card-header">
                <h3 class="card-title">Add Jurnal</h3>
              </div>
              <form method="POST" action=""> 
                @csrf
                <div class="card-body">
                  <div class="row">  
                    <div class="form-group col-md-3">
                      <label>Class</label><br>
                      <select name="class_id" id="getClass" class="form-control">
                        <option value="">Select</option>
                        @foreach ($getClass as $class)
                            <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }} value="{{ $class->class_id }}">{{ $class->class_name }}</option>
                        @endforeach
                      </select>
                    </div>   
                    <div class="form-group col-md-3"> 
                        <label>Subject <span style="color: red">*</span></label><br>
                        <select name="subject_id" id="getSubject"  class="form-control">
                          <option value="">Select Subject</option> 
                        </select> 
                      </div> 
                    <div class="form-group col-md-3">
                      <label>Timetable<span style="color: red">*</span></label><br>
                      <select name="timetable_id" id="getTimetable"  class="form-control">
                        <option value="">Select Timetable</option> 
                      </select> 
                    </div>
                    <div class="form-group col-md-3">
                      <label>Jurnal Date</label><br>
                    <input type="date" name="jurnal_date" id="getJurnalDate" value="{{ Request::get('jurnal_date') }}"  class="form-control">
                    </div>  
                    <div class="form-group col-md-12">
                      <label>Student Name Not Present</label><br>
                      <div style="display: flex; flex-direction: row; flex-wrap: wrap;">
                        <div class="mx-2" id="student_id">
                          <label style="font-weight: normal; margin-right: 8px">
                            <input type="checkbox" value="" name="" id="">
                          </label> 
                        </div> 
                      </div>
                    </div>  
                    <div class="form-group col-md-4">  
                      <label>Kompetensi Dasar/Elemen CP</label><br>
                      <textarea name="kd" id="" cols="40" rows="5"></textarea>
                    </div>
                    <div class="form-group col-md-4">  
                      <label>Indikator</label><br>
                      <textarea name="indikator" id="" cols="40" rows="5"></textarea>
                    </div>
                    <div class="form-group col-md-4">  
                      <label>point</label><br>
                      <input type="number" name="point" id="">
                    </div>
                    <div class="form-group col-md-3">  
                      <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Add</button>
                      <a href="{{ url('teacher/my_jurnal') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                    </div> 
                  </div>
                </div> 
              </form>
            </div>

            
 
 
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
    $(function() {
      $('#getClass').change(function() {
        var class_id = $(this).val();
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
        $.ajax({
          type : "POST",
          url : "{{ url('teacher/ajax_get_student') }}",
          data : {
            '_token' : '{{ csrf_token() }}',
            class_id : class_id
          },
          dataType : "json",
          success : function(data){
            $('#student_id').html(data.success);
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