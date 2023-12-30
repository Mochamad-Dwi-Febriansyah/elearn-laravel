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
            <h1>Kirim Tugas</h1>
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
                    <?php date_default_timezone_set('Asia/Jakarta'); ?>
                    
                    @if ($getRecord->submission_limits >= date('Y-m-d'))
                          <?php  $submissionlate = "-"; ?>
                    @else
                          <?php
                          date_default_timezone_set('Asia/Jakarta'); 
                          $tgl1 = new DateTime(date('Y-m-d H:i:s'));
                          $tgl2 = new DateTime($getRecord->submission_limits);
                          $jarak = $tgl2->diff($tgl1);
                          $submissionlate= $jarak->d . "hari ".$jarak->h . "jam ".$jarak->i . "menit ";
                          ?>
                    @endif
                    <input type="hidden" class="form-control" name="submission_late" value="{{ $submissionlate }}">
                  </div> 
                  <div class="form-group">
                    <label>Berkas</label>
                    <input type="file" class="form-control" name="document_file">
                  </div> 
                  <div class="form-group">
                    <label>Deskripsi <span style="color: red">*</span></label>
                    <textarea id="compose-textarea" name="description" class="form-control" style="height: 300px">
                    </textarea>
                  </div>
                </div> 
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Kirim</button>
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

 

          }); 
    </script>

@endsection