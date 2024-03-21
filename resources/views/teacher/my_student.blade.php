@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Student List</h1>
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
                <h3 class="card-title">Search Student Report</h3>
              </div>
              <form method="GET" action=""> 
                <div class="card-body">
                  <div class="row">  
                    <div class="form-group col-md-2">
                      <label>Class</label>
                      <select name="class_id" class="form-control">
                        <option value="">Select</option>
                        @foreach ($getClass as $class)
                            <option {{ (Request::get('class_id') == $class->class_id) ? 'selected' : '' }} value="{{ $class->class_id }}">{{ $class->class_name }}</option>
                        @endforeach
                      </select>
                    </div>   
                    <div class="form-group col-md-4">  
                      <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                      <a href="{{ url('teacher/my_student') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                    </div> 
                  </div>
                </div> 
              </form>
            </div> 


            @include('_message')

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">My Student List</h3> 
                <p style="float: right">{{ $jumlah_siswa }}</p>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow: auto">
                <table class="table table-striped" >
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Profil Pic</th>
                      <th>Student Name</th> 
                      <th>Email</th>
                      <th>Admisson Number</th>
                      <th>Roll Number</th>
                      <th>Class</th>
                      <th>Gender</th>
                      <th>Date of Birth</th>
                      {{-- <th>Caste</th> --}}
                      <th>Religion</th>
                      <th>Mobile Number</th>
                      <th>Admisson Date</th>
                      {{-- <th>Blood Group</th> --}}
                      {{-- <th>Height</th> --}}
                      {{-- <th>Weight</th>  --}}
                      <th>Created Date</th> 
                      <th>Actions</th>
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
                      <td>{{ $value->admission_number }}</td>
                      <td>{{ $value->roll_number }}</td>
                      <td>{{ $value->class_name }}</td>
                      <td>{{ $value->gender }}</td>
                      <td>
                        @if (!empty($value->date_of_birth))
                          {{ date('d-m-Y', strtotime($value->date_of_birth))  }}
                        @endif
                      </td>
                      {{-- <td>{{ $value->caste }}</td> --}}
                      <td>{{ $value->religion }}</td>
                      <td>{{ $value->mobile_number }}</td>
                      <td>
                        @if (!empty($value->admission_date))
                          {{ date('d-m-Y', strtotime($value->admission_date))  }}
                        @endif
                      </td> 
                      {{-- <td>{{ $value->blood_group }}</td> --}}
                      {{-- <td>{{ $value->height }}</td> --}}
                      {{-- <td>{{ $value->weight }}</td> --}}
                      <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                      <td style="min-width: 139px"> 
                        <a href="{{ url('chat?receiver_id='. base64_encode($value->id)) }}" class="btn btn-success btn-sm">Send Message</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              
                <div style="padding: 10px; float: right">
                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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