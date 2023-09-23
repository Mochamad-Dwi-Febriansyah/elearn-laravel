@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Parent Student List ({{ $getParent->name }} {{ $getParent->last_name }})</h1>
          </div>
          <div class="col-sm-6" style="text-align: right">
            <a href="{{ url('admin/parent/add') }}" class="btn btn-primary">Add new parent</a> 
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
                <h3 class="card-title">Search Student</h3>
              </div>
              <form method="GET" action=""> 
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-2">
                      <label>Student ID</label>
                      <input type="text" class="form-control" name="id" value="{{ Request::get('id') }}" placeholder="Student ID">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name" value="{{ Request::get('name') }}" placeholder="Name">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Last Name</label>
                      <input type="text" class="form-control" name="last_name" value="{{ Request::get('last_name') }}" placeholder="Last Name">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Email Address</label>
                      <input type="text" class="form-control" name="email" value="{{ Request::get('email') }}" placeholder="Email">
                    </div>   
                    <div class="form-group col-md-3">  
                      <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                      <a href="{{ url('admin/parent/my-student/'. $parent_id) }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                    </div> 
                  </div>
                </div> 
              </form>
            </div>

            @include('_message')

            @if (!empty($getSearchStudent))
                
  
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Student List</h3> 
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow: auto">
                <table class="table table-striped" >
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Profil Pic</th>
                      <th>Name</th>
                      <th>Email</th> 
                      <th>Parent Name</th> 
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody> 
                    @foreach($getSearchStudent as $value)
                    <tr>
                      <td>{{ $value->id }}</td>
                      <td>
                        @if (!empty($value->getProfile())) 
                          <img src="{{ $value->getProfile() }}" style="height: 50px; width: 50px; border-radius: 50px" alt="">
                        @endif
                      </td>
                      <td>{{ $value->name }} {{ $value->last_name }}</td>
                      <td>{{ $value->email }}</td>  
                      <td>{{ $value->parent_name }}</td>  
                      <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                      <td style="min-width: 150px">
                        <a href="{{ url('admin/parent/assign_student_parent/'.$value->id. '/'.$parent_id) }}" class="btn btn-primary btn-sm">Add Student to Parent</a> 
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div style="padding: 10px; float: right">
                  {{-- {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!} --}}
                </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            @endif

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Parent Student List</h3> 
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow: auto">
                <table class="table table-striped" >
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Profil Pic</th>
                        <th>Name</th>
                        <th>Email</th> 
                        <th>Parent Name</th> 
                        <th>Created Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody> 
                      @foreach($getRecord as $value)
                      <tr>
                        <td>{{ $value->id }}</td>
                        <td>
                          @if (!empty($value->getProfile())) 
                            <img src="{{ $value->getProfile() }}" style="height: 50px; width: 50px; border-radius: 50px" alt="">
                          @endif
                        </td>
                        <td>{{ $value->name }} {{ $value->last_name }}</td>
                        <td>{{ $value->email }}</td>  
                        <td>{{ $value->parent_name }}</td>  
                        <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                        <td style="min-width: 150px">
                          <a href="{{ url('admin/parent/assign_student_parent_delete/'.$value->id) }}" class="btn btn-danger btn-sm">Delete</a> 
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                <div style="padding: 10px; float: right">
                  {{-- {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!} --}}
                </div>

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