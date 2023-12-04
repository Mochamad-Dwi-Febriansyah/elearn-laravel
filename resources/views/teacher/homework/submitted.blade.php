@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Submitted Homework</h1>
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
                  <h3 class="card-title">Search Submitted Homework</h3>
                </div>
                <form method="GET" action=""> 
                  <div class="card-body">
                    <div class="row"> 
                        <div class="form-group col-md-2">
                            <label>Student First Name</label>
                            <input type="text" class="form-control" name="first_name" value="{{ Request::get('first_name') }}" placeholder="Student First Name">
                          </div>
                        <div class="form-group col-md-2">
                            <label>Student Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="{{ Request::get('last_name') }}" placeholder="Student Last Name">
                          </div>
                      <div class="form-group col-md-2">
                          <label>From Created Date</label>
                          <input type="date" class="form-control" name="from_created_date" value="{{ Request::get('created_date') }}">
                        </div> 
                        <div class="form-group col-md-2">
                          <label>To Created Date</label>
                          <input type="date" class="form-control" name="to_created_date" value="{{ Request::get('created_date') }}">
                        </div> 
                      <div class="form-group col-md-3">  
                        <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                        <a href="{{ url('teacher/homework/homework/submitted/'.$homework_id) }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                      </div> 
                    </div>
                  </div> 
                </form>
              </div>

            @include('_message')

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Submitted Homework List</h3>
              </div> 
              <div class="card-body p-0" style="overflow-x:auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Student Name</th>  
                      <th>Document</th> 
                      <th>Description</th>
                      <th>Created Date</th> 
                      <th>Nilai</th>
                      <th>Submission Late</th> 
                    </tr>
                  </thead>
                  <tbody> 
                    @forelse ($getRecord as $value) 
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->users_name }} {{ $value->last_name }}</td>
                        <td>
                            @if (!empty($value->getDocument()))
                                <a href="{{ $value->getDocument() }}" class="btn btn-primary" download>Download</a>
                            @endif
                        </td>
                        <td>{!! $value->description !!}</td>
                        <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                        <td>
                          <form  class="EditNilai" name="post" homework_id="{{ $value->id }}">
                            @csrf
                            <div class="row"> 
                              <div class="form-group d-flex">
                                <input type="number" name="nilai" class="form-control" style="width: 75px" max="100" min="0" value="{{ $value->nilai }}">
                                <button type="submit"   class="btn btn-primary btn-sm" style="margin-left: 3px">edit</button>
                              </div>
                            </div>
                          </form>
                        </td>
                        <td style="white-space: nowrap;">
                          @if ($value->submission_late == '-')
                            {{ $value->submission_late }}
                          @else
                            <span class="bg-danger" style="padding: 2px 5px;border-radius: 5px">{{ $value->submission_late }}</span>
                          @endif 
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="100%">Record not found</td>
                        </tr>
                    @endforelse
                  </tbody>
                </table>
                <div style="padding: 10px; float: right">
                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
<script type="text/javascript">
  $('.EditNilai').submit(function(e) {
    e.preventDefault(); 
    var homework_id = $(this).attr('homework_id');
    // console.log(homework_id);
    $.ajax({
      type : "POST",
      url : "{{ url('teacher/homework/homework/submitted/edit_nilai/') }}" + "/"+ homework_id,
      data : $(this).serialize(),
      dataType : "json",
      success : function(data) {
        alert(data.message);
        location.reload();
      }

    });
  });
   
</script>
@endsection