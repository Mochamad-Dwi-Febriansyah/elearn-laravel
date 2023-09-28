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
                      <input type="text" class="form-control" name="name"  value="{{ old('name',$getRecord->name ) }}" required placeholder="First Name">
                      <div style="color:red">{{ $errors->first('name') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Last Name <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="last_name"  value="{{ old('last_name',$getRecord->last_name) }}" required placeholder="Last Name">
                      <div style="color:red">{{ $errors->first('last_name') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Gender <span style="color: red">*</span></label>
                      <select name="gender" id="" class="form-control" required>
                        <option value="">Select Gender</option>
                        <option {{ (old('gender',$getRecord->gender) == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                        <option {{ (old('gender',$getRecord->gender) == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                        <option {{ (old('gender',$getRecord->gender) == 'Other') ? 'selected' : '' }} value="Other">Other</option>
                      </select>
                      <div style="color:red">{{ $errors->first('gender') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Date Of Birth<span style="color: red">*</span></label>
                      <input type="date" class="form-control" name="date_of_birth"  value="{{ old('date_of_birth',$getRecord->date_of_birth) }}" required placeholder="Date Of Birth">
                      <div style="color:red">{{ $errors->first('date_of_birth') }}</div>
                    </div> 
                    <div class="form-group col-md-6">
                      <label>Mobile Number <span style="color: red"></span></label>
                      <input type="text" class="form-control" name="mobile_number"  value="{{ old('mobile_number',$getRecord->mobile_number) }}" placeholder="Mobile Number">
                      <div style="color:red">{{ $errors->first('mobile_number') }}</div>
                    </div> 
                    <div class="form-group col-md-6">
                      <label>Marital Status <span style="color: red"></span></label>
                      <input type="text" class="form-control" name="marital_status"  value="{{ old('marital_status',$getRecord->marital_status) }}" placeholder="Marital Status">
                      <div style="color:red">{{ $errors->first('marital_status') }}</div>
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
                      <label>Current Address <span style="color: red"></span></label> 
                      <textarea id="" name="address"  cols="30" rows="3" placeholder="Current Address" class="form-control">{{ old('address',$getRecord->address) }}</textarea>
                      <div style="color:red">{{ $errors->first('address') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Permanent Address <span style="color: red"></span></label> 
                      <textarea id="" name="permanent_address"   cols="30" rows="3" placeholder="Permanent Address" class="form-control">{{ old('permanent_address',$getRecord->permanent_address) }}</textarea>
                      <div style="color:red">{{ $errors->first('permanent_address') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Qualification<span style="color: red"></span></label> 
                      <textarea id="" name="qualification"   cols="30" rows="3" placeholder="Qualification" class="form-control">{{ old('qualification',$getRecord->qualification) }}</textarea>
                      <div style="color:red">{{ $errors->first('qualification') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Work Experience<span style="color: red"></span></label> 
                      <textarea id="" name="work_experience"   cols="30" rows="3" placeholder="Work Experience" class="form-control">{{ old('work_experience',$getRecord->work_experience) }}</textarea>
                      <div style="color:red">{{ $errors->first('work_experience') }}</div>
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