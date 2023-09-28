@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 1345.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Account</h1>
          </div> 
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            @include('_message') 
            <div class="card card-primary">  
              <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">

                    <div class="form-group col-md-6">
                      <label>First Name <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="name"  value="{{ old('name', $getRecord->name ) }}" required placeholder="First Name">
                      <div style="color:red">{{ $errors->first('name') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Last Name <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="last_name"  value="{{ old('last_name' , $getRecord->last_name) }}" required placeholder="Last Name">
                      <div style="color:red">{{ $errors->first('last_name') }}</div>
                    </div>   
                    <div class="form-group col-md-6">
                      <label>Gender <span style="color: red">*</span></label>
                      <select name="gender" id="" class="form-control" required>
                        <option value="">Select Gender</option>
                        <option {{ (old('gender', $getRecord->gender) == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                        <option {{ (old('gender', $getRecord->gender) == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                        <option {{ (old('gender', $getRecord->gender) == 'Other') ? 'selected' : '' }} value="">Other</option>
                      </select>
                      <div style="color:red">{{ $errors->first('gender') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Date Of Birth<span style="color: red">*</span></label>
                      <input type="date" class="form-control" name="date_of_birth"  value="{{ old('date_of_birth' ,$getRecord->date_of_birth) }}" required placeholder="Date Of Birth">
                      <div style="color:red">{{ $errors->first('date_of_birth') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Caste <span style="color: red"></span></label>
                      <input type="text" class="form-control" name="caste"  value="{{ old('caste',$getRecord->caste) }}" placeholder="Caste">
                      <div style="color:red">{{ $errors->first('caste') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Religion <span style="color: red"></span></label>
                      <input type="text" class="form-control" name="religion"  value="{{ old('religion',$getRecord->religion) }}" placeholder="Religion">
                      <div style="color:red">{{ $errors->first('religion') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Mobile Number <span style="color: red"></span></label>
                      <input type="text" class="form-control" name="mobile_number"  value="{{ old('mobile_number',$getRecord->mobile_number) }}" placeholder="Mobile Number">
                      <div style="color:red">{{ $errors->first('mobile_number') }}</div>
                    </div> 
                    <div class="form-group col-md-6">
                      <label>Profile Pic <span style="color: red"></span></label>
                      <input type="file" class="form-control" name="profile_pic">
                      <div style="color:red">{{ $errors->first('profile_pic') }}</div>
                      @if(!empty($getRecord->getProfile()))
                        <img src="{{ $getRecord->getProfile() }}" style="width:100px" alt="">
                      @endif
                    </div>
                    <div class="form-group col-md-6">
                      <label>Blood Group <span style="color: red"></span></label>
                      <input type="text" class="form-control" name="blood_group" value="{{ old('blood_group',$getRecord->blood_group) }}" placeholder="Blood Group">
                      <div style="color:red">{{ $errors->first('blood_group') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Heigth <span style="color: red"></span></label>
                      <input type="text" class="form-control" name="height" value="{{ old('height',$getRecord->height) }}" placeholder="Heigth">
                      <div style="color:red">{{ $errors->first('height') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Weight <span style="color: red"></span></label>
                      <input type="text" class="form-control" name="weight" value="{{ old('weight',$getRecord->weight) }}" placeholder="Weight">
                      <div style="color:red">{{ $errors->first('weight') }}</div>
                    </div> 

                  </div>

                  <hr />

                  <div class="form-group">
                    <label>Email Address <span style="color: red">*</span></label>
                    <input type="email" class="form-control" name="email" value="{{ old('weight',$getRecord->email) }}" required placeholder="Email">
                    <div style="color:red">{{ $errors->first('email') }}</div>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
  
          </div>
          <!--/.col (left) --> 
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper --> 
@endsection