<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jurnal</title>
    <style>
       .heading{
        margin: 0 5%;
        border-bottom: 2px solid #000;
       }
        .sub-heading{
            margin: 0 5%;
        }
        .table{
            border-collapse: collapse;
        }
        .border{
            border: 1px solid #000;
        }
        .padding{
            padding: 5px 10px;
        }
    </style>
</head>
<body> 
    <div class="heading">
        <table style="width: 100%">
            <thead>
                <tr>
                    <td style="width: 20%">
                        <div class="items">
                            <?php
                            $path = 'dist/img/914f52c40a6d023f24e184d138a2a10c.png';
                            $type = pathinfo($path, PATHINFO_EXTENSION);
                            $data = file_get_contents($path);
                            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                            ?>
                            <img src="<?php echo $base64?>" width="80" height="80"/>
                            {{-- <img src="{!! url('dist/img/914f52c40a6d023f24e184d138a2a10c.png') !!}" alt="" width="100"> --}}
                        </div>
                    </td>
                    <td style="width: 40%">
                        <div class="items">
                            <h2 style="text-align: center">SMK NEGERI 2 DEMAK</h2>
                        </div>
                    </td>
                    <td style="width: 40%;">
                        <div class="items" style="float: right">
                            <h4 style="margin-bottom: 5px">No. </h4>
                            <h4 style="margin-top: 0">JURNAL KEGIATAN MENGAJAR</h4>
                        </div>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
    <div class="sub-heading" style="margin-bottom: 10px">
        <h2 style="text-align: center">JURNAL KEGIATAN MENGAJAR</h2>
        <div class="sub-heading-box">
            <table>
                <thead>
                    @if ($getJurnal[0])
                        <tr>
                            <th style="text-align: left" >Kelas</th>
                            <td>:</td>
                            <td>{{ $getJurnal[0]->class_name }}</td>
                        </tr>
                        <tr>
                            <th style="text-align: left" >Mata Pelajaran</th>
                            <td>:</td>
                            <td>{{ $getJurnal[0]->subject_name }}</td>
                        </tr>
                        <tr>
                            <th style="text-align: left" >Semester</th>
                            <td>:</td>
                            <td>{{ $getJurnal[0]->semester }}</td>
                        </tr>
                    @else
                        <tr>
                            <th style="text-align: left" >Kelas</th>
                            <td>:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th style="text-align: left" >Mata Pelajaran</th>
                            <td>:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th style="text-align: left" >Semester</th>
                            <td>:</td>
                            <td></td>
                        </tr>
                    @endif
                </thead>
            </table>
        </div>
    </div>
    <table class="table" width="100%">
        <thead>
            <tr class="border padding">
                <th class="border padding">Jadwal</th> 
                <th class="border padding">Tanggal</th> 
                <th class="border padding">Kompetensi Dasar</th>
                <th class="border padding">Indikator</th> 
                <th class="border padding">Peserta Didik Tidak Hadir</th>
                <th class="border padding">Catatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($getJurnal as $value)
                <tr class="border padding">
                    <td class="border padding">{{ $value->week_name }}, {{ $value->timetable_start }}-{{ $value->timetable_end }}</td>
                    <td class="border padding">{{ $value->jurnal_date }}</td>
                    <td class="border padding">{{ $value->kd }}</td>
                    <td class="border padding">{{ $value->indikator }}</td> 
                    <td class="border padding">
                        @foreach ($value->student as $getJurnal)
                          {{ $getJurnal['student_name'] }}, 
                        @endforeach
                      </td>
                    <td class="border padding">{{ $value->catatan }}</td>
                </tr>
            @empty
            <tr>
                <td colspan="100%">Record not found</td>
            </tr>
            @endforelse 
        </tbody>
    </table>
</body>
</html>