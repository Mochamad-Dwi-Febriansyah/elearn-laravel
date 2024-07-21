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