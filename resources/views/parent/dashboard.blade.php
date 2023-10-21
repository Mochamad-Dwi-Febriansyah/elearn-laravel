@extends('layouts.app')
@section('content')

<div class="content-wrapper"> 
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div> 
      </div> 
    </div> 
  </div>  
  <section class="content">
    <div class="container-fluid"> 
      <div class="row"> 
        <div class="col-lg-3 col-6"> 
          <div class="small-box bg-info">
            <div class="inner">
              <h3>${{ number_format($totalPaidAmount, 2) }}</h3> 
              <p>Total Paid Amount</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ url('student/fees_collection') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div> 
        <div class="col-lg-3 col-6"> 
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $totalStudent }}</h3> 
              <p>Total Student</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ url('parent/my_student') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>     
        <div class="col-lg-3 col-6"> 
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $TotalNoticeBoard }}</h3> 
              <p>Total Notice Board</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ url('parent/my_notice_board') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>  
        <div class="col-lg-3 col-6"> 
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $TotalAttendance }}</h3> 
              <p>Total Attendance</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ url('parent/my_student') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>  
        <div class="col-lg-3 col-6"> 
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>{{ $TotalHomeWork }}</h3> 
              <p>Total HomeWork</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ url('parent/my_student') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>  
        <div class="col-lg-3 col-6"> 
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>{{ $TotalSubmittedHomeWork }}</h3> 
              <p>Total Submit HomeWork</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ url('parent/my_student') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>  
        
      </div> 
   
    </div> 
  </section> 
</div> 
@endsection