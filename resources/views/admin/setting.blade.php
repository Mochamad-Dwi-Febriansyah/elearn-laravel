@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 1345.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Setting</h1>
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
                  <div class="form-group">
                    <label>Paypal Bussiness Email</label>
                    <input type="email" class="form-control" name="paypal_email" value="{{ $getRecord->paypal_email  }}" required placeholder="Paypal Bussiness Email">
                  </div>  
                  <div class="form-group">
                    <label>Stripe Public Key</label>
                    <input type="text" class="form-control" name="stripe_key" value="{{ $getRecord->stripe_key  }}">
                  </div>  
                  <div class="form-group">
                    <label>Stripe Secret Key</label>
                    <input type="text" class="form-control" name="stripe_secret" value="{{ $getRecord->stripe_secret  }}" >
                  </div>  
                </div>
                <div class="form-group">
                  <label>Logo<span style="color: red"></span></label>
                  <input type="file" class="form-control" name="logo">
                  @if(!empty($getRecord->getLogo()))
                    <img src="{{ $getRecord->getLogo() }}" style="width:100px" alt="">
                  @endif 
                </div> 
                <div class="form-group">
                  <label>Favicon Icon<span style="color: red"></span></label>
                  <input type="file" class="form-control" name="favicon_icon"> 
                  @if(!empty($getRecord->getFavicon()))
                    <img src="{{ $getRecord->getFavicon() }}" style="width:100px" alt="">
                  @endif
                </div>
                <!-- /.card-body -->
                <div class="form-group">
                  <label>School Name</label>
                  <input type="text" class="form-control" name="school_name" value="{{ $getRecord->school_name  }}">
                </div>
                <div class="form-group">
                  <label>Exam Description</label>
                  <textarea name="exam_description" cols="30" rows="10" class="form-control">{{ $getRecord->exam_description }}</textarea>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
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