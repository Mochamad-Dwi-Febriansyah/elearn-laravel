@extends('layouts.app')
@section('content')

<div class="content-wrapper"> 
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Beranda</h1>
        </div> 
      </div> 
    </div> 
  </div>  
  <section class="content">
    <div class="container-fluid"> 
      <div class="row">
        {{-- <div class="col-lg-3 col-6"> 
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
        </div>   --}}
        {{-- <div class="col-lg-3 col-6"> 
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $TotalSubject }}</h3> 
              <p>Total Subject</p>
            </div>
            <div class="icon">
              <i class="nav-icon fas fa-table"></i>
            </div>
            <a href="{{ url('student/my_subject') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>   --}}
        {{-- <div class="col-lg-3 col-6"> 
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $TotalNoticeBoard }}</h3> 
              <p>Total Notice Board</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ url('student/my_notice_board') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>   --}}
        <div class="col-lg-3 col-6"> 
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>{{ $TotalHomeWork }}</h3> 
              <p>Jumlah Tugas</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ url('student/homework/my_homework') }}" class="small-box-footer">Info Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>  
        <div class="col-lg-3 col-6"> 
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $TotalSubmittedHomeWork }}</h3> 
              <p>Jumlah Pengiriman Tugas</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ url('student/homework/my_submitted_homework') }}" class="small-box-footer">Info Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>  
        <div class="col-lg-3 col-6"> 
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $TotalAttendance }}</h3> 
              <p>Jumlah Kehadiran</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ url('student/my_attendance') }}" class="small-box-footer">Info Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>  
        
      </div> 


      <div class="row mb-2">
        <div class="col-12">
          <h2 class="mt-4 text-center">Uji Proyek Akhir</h2>
        </div> 
      </div> 
      <div class="row">
        <div class="col-md-12"> 
          @include('_message')

         
        <div class="card card-primary">  
          @if(!empty($getAlreadyProjekAkhir))
          <div class="card-body" style="overflow-x:auto;">
            <table class="table table-striped table-scroll">
              <tbody>
                <tr>
                  <th>Nama Projek</th>
                  <td>{{ $getAlreadyProjekAkhir->nama_projek }}</td>
                </tr>
                <tr>
                  <th>Anggota Kelompok</th>
                  <td>
                    @foreach ($getAlreadyProjekAkhir->anggota as $value)
                    {{ $value->user_name }} {{ $value->user_last_name }}<br>
                    @endforeach
                  </td>
                </tr>
                <tr>
                  <th>Tanggal Pelaksanaan</th>
                  <td> {{ $getAlreadyProjekAkhir->tanggal_pengerjaan }}</td>
                </tr>
                <tr>
                  <th>Waktu Pelaksanaan</th>
                  <td>{{ $getAlreadyProjekAkhir->waktu_mulai }} - {{ $getAlreadyProjekAkhir->waktu_selesai }}</td>
                </tr>
                <tr>
                  <th>Tempat Pelaksanaan</th>
                  <td> {{ $getAlreadyProjekAkhir->tempat_pengerjaan }}</td>
                </tr>
                <tr>
                  <th>Catatan</th>
                  <td> {{ $getAlreadyProjekAkhir->catatan }}</td>
                </tr>
                <tr>
                  <th>Nilai</th>
                  <td> {{ $getAlreadyProjekAkhir->nilai }}</td>
                </tr>
                <tr>
                  <th>Status</th>
                  @if ($getAlreadyProjekAkhir->status == 0)
                  <td class="bg-warning">Menunggu Verifikasi</td>
                    @elseif($getAlreadyProjekAkhir->status == 1) 
                   <td class="bg-success">Disetujui</td> 
                    @elseif($getAlreadyProjekAkhir->status == 2) 
                    <td class="bg-danger">Ditolak</td>
                    @endif
                </tr>
              </tbody>
            </table>
          </div>
          @else
          <form method="POST" action="{{ url('projek_akhir') }}">
            @csrf
            <div class="card-body">
              {{-- <div class="form-group">
                <label>class</label>
                <input type="text" class="form-control" name="nama_projek"  value="{{ Auth::user()->class_id }}" required placeholder="{{ Auth::user()->class_id }}">
              </div> --}}
              <input type="hidden" class="form-control" name="student_created_projek"  value="{{ Auth::user()->id }}" required placeholder="{{ Auth::user()->id }}">
              <input type="hidden" class="form-control" name="class_id"  value="{{ Auth::user()->class_id }}" required placeholder="{{ Auth::user()->class_id }}">
              <div class="form-group">
                <label>Nama Projek</label>
                <input type="text" class="form-control" name="nama_projek"  value="" required placeholder="Nama Projek">
              </div>
              {{-- <div class="form-group">
                <label>Anggota Kelompok</label>
                <input type="text" class="form-control" name="new_password"  value="" required placeholder="New Password">
              </div>   --}}
              <div class="form-group">
                <label>Pilih 1 temanmu untuk bergabung</label><br>
                <div style="display: flex; flex-direction: row; flex-wrap: wrap;">
                  <div class="mx-2" id="student_id"> 
                  </div> 
                </div>
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">kirim</button>
            </div>
          </form>
          @endif
        </div>

      </div>
   
    </div> 
  </section> 
</div> 
@endsection

@section('script')
<script type="text/javascript">
$(function() {
  // console.log("sdd")
  // $('#getClass').change(function() {
    // $(document).ready(function(){

  $.ajax({
          type : "POST",
          url : "{{ url('student/ajax_get_student') }}",
          data : {
            '_token' : '{{ csrf_token() }}',
            class_id : {{ Auth::user()->class_id }},
            student_id : {{ Auth::user()->id }}
          },
          dataType : "json",
          success : function(data){

            $('#student_id').html(data.success);
          }
        });
      })

      // })

</script>
    
@endsection