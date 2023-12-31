@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Subject</h1>
          </div>
          <div class="col-sm-6" style="text-align: right">
            <a href="{{ url('admin/subject/add') }}" class="btn btn-primary">Add new subject</a> 
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
                <h3 class="card-title">My Subject</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow-x:auto;"> 
                <table class="table table-striped">
                  <thead>
                    <tr> 
                      <th>Subject Name</th>
                      <th>Subject Type</th> 
                    </tr>
                  </thead>
                  <tbody> 
                   @foreach($getRecord as $value)
                    <tr>
                        <td>{{ $value->subject_name }}</td>
                        <td>{{ $value->subject_type }}</td>
                    </tr>
                   @endforeach
                  </tbody>
                </table> 

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper --> 
@endsection