@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Materi</h1>
          </div>
        </div>
      </div> 
    </section>
 
    <section class="content">
        <div class="container-fluid"> 
            <div class="row">
                @foreach ($getRecord as $value)     
                <div class="col-md-4 col-sm-6 col-12">
                    <a href="{{ url('student/my_material/subject='.$value->subject_id) }}">
                        <div class="info-box bg-info">
                            <span class="info-box-icon"><i class="far fa-bookmark"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">{{ $value->subject_name }}</span>
                                    <span class="info-box-number">{{ $value->class_name }}</span> 
                                </div> 
                        </div>  
                    </a>
                </div>
                @endforeach

            </div>
        </div> 
    </section> 
  </div> 
@endsection