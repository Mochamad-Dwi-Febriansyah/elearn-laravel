@extends('layouts.app')
@section('content')
 
<div class="content-wrapper" style="min-height: 1345.6px;">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <h1>My Projek Akhir</h1>
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
                          <h3 class="card-title">Search Projek Akhir</h3>
                        </div>
                        <form method="GET" action=""> 
                          <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Class</label><br>
                                    <select name="class_name" id="getClass" class="form-control">
                                      <option value="">Select</option>
                                      @foreach ($getClass as $class)
                                          <option {{ (Request::get('class_name') == $class->id) ? 'selected' : '' }} value="{{ $class->class_name }}">{{ $class->class_name }}</option>
                                      @endforeach
                                    </select>
                                  </div>    
                              <div class="form-group col-md-3">  
                                <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                                <a href="{{ url('teacher/my_projek_akhir') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                              </div> 
                            </div>
                          </div> 
                        </form>
                      </div>
                </div>

                {{-- @foreach ($getRecord as $value)          --}}
                    <div class="col-md-12">
                       
        <div class="card card-primary">   
            <div class="card-body" style="overflow-x:auto;">
              <table class="table table-striped">
                <thead>
                  <tr> 
                    <th>#</th>
                    <th>Nama Projek</th>
                    <th>Anggota Kelompok</th>
                    <th>Tanggal Pelaksanaan</th>
                    <th>Tempat Pelaksanaan</th>
                    <th>Catatan</th>
                    <th>Nilai</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>  
                    
                    @foreach($getRecord as $value)
                    <tr>
                      <td>{{ $value->id }}</td> 
                      <td>{{ $value->nama_projek }}</td> 
                      <td>
                      @foreach ($value->anggota as $item)
                      {{ $item->user_name }} {{ $item->user_last_name }}<br>
                      @endforeach
                      </td> 
                      <td>{{ $value->tanggal_pengerjaan }}</td>
                      <td>{{ $value->tempat_pengerjaan }}</td>
                      <td>{{ $value->catatan }}</td>
                      <td>{{ $value->nilai }}</td>
                      @if ($value->status == 0)
                      <td class="bg-warning">Menunggu Verifikasi</td>
                        @elseif($value->status == 1) 
                       <td class="bg-success">Disetujui</td> 
                        @elseif($value->status == 2) 
                        <td class="bg-danger">Ditolak</td>
                        @endif
                        <td>
                            <a href="{{ url('teacher/my_projek_akhir/edit/'.$value->id) }}" class="btn btn-primary  btn-sm">Edit</a> 
                            <a href="{{ url('teacher/my_projek_akhir/hapus/'.$value->id) }}" class="btn btn-danger btn-sm">Hapus</a> 
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div> 
          </div>
            
                        </div> 
                    </div>  
                {{-- @endforeach --}}
                <div class="col-md-12">
                    
                </div>
            </div> 
        </div> 
      </section>
</div> 
@endsection