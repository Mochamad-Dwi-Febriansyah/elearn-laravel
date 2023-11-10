@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Collect Fees Report</h1>
          </div>
          
        </div>
      </div>
    </section>
 
    <section class="content">
      <div class="container-fluid">
        <div class="row">  
          <div class="col-md-12">  
        
            <div class="card">  
                <div class="card-header">
                  <h3 class="card-title">Search Collect Fees Report</h3>
                </div>
                <form method="GET" action=""> 
                  <div class="card-body">
                    <div class="row"> 
                      <div class="form-group col-md-2">
                          <label>Student ID</label>
                        <input type="text" name="student_id" placeholder="Student ID" value="{{ Request::get('student_id') }}" class="form-control">
                      </div>  
                      <div class="form-group col-md-2">
                          <label>Student Name</label>
                        <input type="text" name="student_name" placeholder="Student Name" value="{{ Request::get('student_name') }}" class="form-control">
                      </div>  
                      <div class="form-group col-md-2">
                          <label>Student Last Name</label>
                        <input type="text" name="student_last_name" placeholder="Student Last Name" value="{{ Request::get('student_last_name') }}" class="form-control">
                      </div>  
                      <div class="form-group col-md-2">
                        <label>Class</label>
                        <select name="class_id" class="form-control">
                          <option value="">Select</option>
                          @foreach ($getClass as $class)
                              <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                          @endforeach
                        </select>
                      </div>  
                      <div class="form-group col-md-2">
                        <label>Start Created Date</label>
                      <input type="date" name="start_created_date" value="{{ Request::get('start_created_date') }}" class="form-control">
                      </div>  
                      <div class="form-group col-md-2">
                        <label>End Created Date</label>
                      <input type="date" name="end_created_date" value="{{ Request::get('end_created_date') }}" class="form-control">
                      </div>  
                      <div class="form-group col-md-2">
                        <label>Payment Type</label>
                        <select name="payment_type" class="form-control">
                              <option value="">Select</option>
                              <option {{ (Request::get('payment_type') == 1) ? 'selected' : '' }} value="Cash">Cash</option>
                              <option {{ (Request::get('payment_type') == 1) ? 'selected' : '' }} value="Cheque">Cheque</option>
                              <option {{ (Request::get('payment_type') == 1) ? 'selected' : '' }} value="Paypal">Paypal</option>
                              <option {{ (Request::get('payment_type') == 1) ? 'selected' : '' }} value="Stripe">Stripe</option> 
                        </select>
                      </div>  
                      <div class="form-group col-md-2">  
                        <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                        <a href="{{ url('admin/fees_collection/collect_fees_report') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                      </div> 
                    </div>
                  </div> 
                </form>
            </div> 

              @include('_message')


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Collect Fees Report</h3>
                <form action="{{ url('admin/fees_collection/export_collect_fees_report') }}" method="POST" style="float: right">
                  @csrf
                  <input type="hidden" name="student_id" value="{{ Request::get('student_id') }}"> 
                  <input type="hidden" name="student_name" value="{{ Request::get('student_name') }}"> 
                  <input type="hidden" name="student_last_name" value="{{ Request::get('student_last_name') }}"> 
                  <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}"> 
                  <input type="hidden" name="start_created_date" value="{{ Request::get('start_created_date') }}"> 
                  <input type="hidden" name="end_created_date" value="{{ Request::get('end_created_date') }}"> 
                  <input type="hidden" name="payment_type" value="{{ Request::get('payment_type') }}"> 
                  <button type="submit" class="btn btn-primary">Export Excel</button>
                </form>
              </div> 
              <div class="card-body p-0" style="overflow-x:auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Class Name</th>
                        <th>Total Amount</th>
                        <th>Paid Amount</th> 
                        <th>Remaining Amount</th>
                        <th>Payment Type</th>
                        <th>Remark</th>
                        <th>Created By</th>
                        <th>Created Date</th> 
                    </tr>
                  </thead>
                  <tbody>  
                    @forelse ($getRecord as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->student_id }}</td>
                            <td>{{ $value->student_name_first }} {{ $value->student_name_last }}</td>
                            <td>{{ $value->class_name }}</td>
                            <td>${{ number_format($value->total_amount, 2) }}</td>
                            <td>${{ number_format($value->paid_amount, 2) }}</td>
                            <td>${{ number_format($value->remaining_amount, 2) }}</td>
                            <td>{{ $value->payment_type }}</td>
                            <td>{{ $value->remark }}</td>
                            <td>{{ $value->created_name }}</td>
                            <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%">Record Not Found</td>
                        </tr>
                    @endforelse
                  </tbody>
                </table>
                    <div style="padding: 10px; float: right">
                        @if (!empty($getRecord))
                        {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                        @endif
                    </div> 
              </div> 
            </div> 
          </div> 
        </div>
      </div>
    </section> 
  </div> 
   
@endsection

@section('script') 
@endsection