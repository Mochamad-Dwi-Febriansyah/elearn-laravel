<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attendance</title>
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
        .fs-8{
            font-size: .8rem;
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
                            <h4 style="margin-top: 0">Laporan Penugasan</h4>
                        </div>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
    <div class="sub-heading" style="margin-bottom: 10px">
        <h2 style="text-align: center">Laporan Penugasan</h2>
        <div class="sub-heading-box">
            <table>
                <thead>
                    @if ($getClasses)
                        <tr>
                            <th style="text-align: left" >Kelas</th>
                            <td>:</td>
                            <td>{{ $getClasses->name }}</td>
                        </tr>
                        <tr>
                            <th style="text-align: left" >Mata Pelajaran</th>
                            <td>:</td>
                            <td>{{ $getSubject->name }}</td>
                        </tr>
                        <tr>
                            <th style="text-align: left" >Semester</th>
                            <td>:</td>
                            <td>2</td>
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
                <th class="border padding fs-8">Student Name</th>
               @foreach ($getHomework as $hmwrk)
                   <th class="border padding fs-8">{{ $hmwrk->tugas_title }}</th>
               @endforeach
            </tr>
        </thead>
        <tbody>
            @if (!empty($getStudent))
                @foreach ($getStudent as $value)
                    <tr class="border padding">
                        <td class="border padding fs-8">{{ $value->name }}{{ $value->last_name }}</td>
                        {{-- <td>{{ $value }}</td> --}}
                        @foreach ($value->data_homework as $date) 
                           {{-- <td>{{ $date['tugas_id'] }}</td> --}}
                           <td>{{ $date['nilai'] }}</td>
                        @endforeach
                    </tr>
                   
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>