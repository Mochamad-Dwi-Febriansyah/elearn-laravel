@extends('layouts.app')

@section('style')
    <style type="text/css">
        
    </style>
@endsection

@section('content')
 
<div class="content-wrapper" style="min-height: 1345.6px;"> 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Material</h1>
          </div> 
        </div>
      </div> 
    </section>
 
    <section class="content">
      <div class="container-fluid">
        <div class="row"> 
          <div class="col-md-12"> 
            @include('_message')
            <div class="card card-primary">  
              <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Class <span style="color: red">*</span></label>
                    <select name="class_id" id="getClass" required class="form-control">
                      <option value="0">Select Class</option>
                      @foreach ($getClass as $class)
                          <option value="{{ $class->class_id }}">{{ $class->class_name }} </option>
                      @endforeach
                    </select>
                  </div> 
                  <div class="form-group">
                    <label>Subject <span style="color: red">*</span></label>
                    <select name="subject_id" id="getSubject" required class="form-control">
                      <option value="">Select Subject</option> 
                    </select>
                  </div>  
                 
                  <div class="form-group">
                    <label>Material Title</label>
                    <input type="text" class="form-control" name="material_title" placeholder="material">
                  </div> 
                  <div class="form-group">
                    <label>Document</label>
                    <input type="file" class="form-control" name="document_file">
                  </div> 
                  <div class="form-group">
                    <label>Description <span style="color: red">*</span></label>
                    <textarea id="compose-textarea" name="description" class="form-control" style="height: 300px">
                    </textarea>
                  </div>
                </div> 
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div> 
  
          </div> 
        </div> 
      </div> 
    </section> 
  </div> 
@endsection

@section('script')

<script src="{{ url('dist/js/pages/dashboard.js') }}"></script>
<script src="{{ url('plugins/summernote/summernote-bs4.min.js') }}"></script>

    <script  type="text/javascript"> 
          $(function () { 

            $('#compose-textarea').summernote({
              height : 200, 
            });

            $('#getClass').change(function() {
              var class_id = $(this).val(); 
              $.ajax({
                    type: "POST",
                    url: "{{ url('teacher/ajax_get_subject') }}",
                    data: {
                        "_token" : "{{ csrf_token() }}",
                        class_id: class_id,
                        
                    },
                    dataType: "json",
                    success: function(data){ 
                      $('#getSubject').html(data.success);
                    }
                });
            });

          }); 
    </script>

@endsection