@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 1345.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Projek Akhir</h1>
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
            <div class="card card-primary">  
              <form method="POST" action="">
                @csrf
                <div class="card-body">
                  <div class="row">

                    <div class="form-group col-md-6">
                      <label>Nama Projek<span style="color: red"></span></label> 
                      <input type="text" class="form-control" name="nama_projek"  value="{{ old('nama_projek', $getRecord->nama_projek) }}" required placeholder="Nama Projek">
                      <div style="color:red">{{ $errors->first('nama_projek') }}</div>
                    </div>  
                    <div class="form-group col-md-6">
                      <label>Tanggal Pelaksanaan<span style="color: red"></span></label> 
                      <input type="date" class="form-control" name="tanggal_pengerjaan"  value="{{ old('tanggal_pengerjaan',$getRecord->tanggal_pengerjaan) }}" required placeholder="Tanggal Pengerjaan">
                      <div style="color:red">{{ $errors->first('tanggal_pengerjaan') }}</div>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Waktu Mulai<span style="color: red"></span></label> 
                      <input type="time" class="form-control" name="waktu_mulai"  value="{{ old('waktu_mulai',$getRecord->waktu_mulai) }}" required >
                      <div style="color:red">{{ $errors->first('waktu_mulai') }}</div>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Waktu Selesai<span style="color: red"></span></label> 
                      <input type="time" class="form-control" name="waktu_selesai"  value="{{ old('waktu_selesai',$getRecord->waktu_selesai) }}" required >
                      <div style="color:red">{{ $errors->first('waktu_selesai') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Tempat Pelaksanaan <span style="color: red"></span></label>
                      <input type="text" class="form-control" name="tempat_pengerjaan"  value="{{ old('tempat_pengerjaan',$getRecord->tempat_pengerjaan) }}" required placeholder="Tempat Pengerjaan">
                      <div style="color:red">{{ $errors->first('tempat_pengerjaan') }}</div>
                    </div>  
                    <div class="form-group col-md-6">
                      <label>Catatan <span style="color: red"></span></label>
                      <input type="text" class="form-control" name="catatan"  value="{{ old('catatan',$getRecord->catatan) }}" placeholder="Catatan">
                      <div style="color:red">{{ $errors->first('catatan') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Nilai <span style="color: red"></span></label>
                      <input type="text" class="form-control" name="nilai"  value="{{ old('nilai',$getRecord->nilai) }}" placeholder="Nilai">
                      <div style="color:red">{{ $errors->first('nilai') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Status <span style="color: red">*</span></label>
                      <select name="status" id="" class="form-control" required> 
                        <option {{ (old('status', $getRecord->status) == 0 ) ? 'selected' : '' }} value="0">Belum Disetujui</option>
                        <option {{ (old('status', $getRecord->status) == 1 ) ? 'selected' : '' }} value="1">Disetujui</option> 
                        <option {{ (old('status', $getRecord->status) == 1 ) ? 'selected' : '' }} value="2">Ditolak</option> 
                      </select>
                      <div style="color:red">{{ $errors->first('status') }}</div>
                    </div>

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