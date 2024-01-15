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
            <h1>Edit Material</h1>
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
                          <option {{ ($getRecord->class_id == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }} </option>
                      @endforeach
                    </select>
                  </div> 
                  <div class="form-group">
                    <label>Subject <span style="color: red">*</span></label>
                    <select name="subject_id" id="getSubject" required class="form-control">
                      @foreach ($getSubject as $subject)
                        <option {{ ($getRecord->subject_id == $subject->subject_id) ? 'selected' : '' }} value="{{ $subject->subject_id }}">{{ $subject->subject_name }} </option>
                      @endforeach
                    </select>
                  </div>  
                  <div class="form-group">
                    <label>Material Title</label>
                    <input type="text" class="form-control" value="{{ $getRecord->material_title }}" name="material_title" placeholder="material">
                  </div> 
                  <div class="form-group">
                    <label>Document</label>
                    <input type="file" class="form-control" name="document_file">
                    @if (!empty($getRecord->getDocument()))
                      <a href="{{ $getRecord->getDocument() }}" class="btn btn-primary" download>Download</a>
                    @endif
                  </div> 
                  <div class="form-group">
                    <label>Description <span style="color: red">*</span></label>
                    <textarea id="compose-textarea" name="description" class="form-control" style="height: 300px">{{ $getRecord->description }}
                    </textarea>
                  </div>
                </div> 
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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