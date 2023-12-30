@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Materi</h1>
          </div>
        </div>
      </div> 
    </section>
 
    <section class="content">
      <div class="container-fluid">
        <div class="row">  
          <div class="col-md-12">   
 

            @include('_message')

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Materi</h3>
              </div> 
              <div class="card-body p-3"  style="overflow-y:auto;">
                <table class="table" > 
                  <tbody> 
                    @forelse ($getRecord as $value)  
                    <tr>
                      <th> 
                          <img src="{{ url('dist/img/pdf-24.png') }}" alt="" style="margin-right: 0.5rem">
                          @if ($value->material_title == NULL)
                            Materi
                          @else 
                            @if (!empty($value->getDocument()))
                                <a href="{{ $value->getDocument() }}" download>{{ $value->material_title }}</a>
                            @else
                            {{ $value->material_title }}
                            @endif 
                          @endif
                        <div style="float: right;">
                            <span style="font-size: 0.8em; font-weight: 400; margin-right: 5px">{{ $value->subject_name }}</span>
                            <span style="font-size: 0.8em">dibuat {{ date('d-m-Y', strtotime($value->created_at)) }}</span>
                          </div>
                      </th>
                    </tr>  
                    <tr>
                        <td class="pl-5" style="max-width: 300px; font-size: .9em; line-height: normal"> 
                            {!! $value->description !!}
                        </td>
                    </tr>  
                    <td class="m-4 p-4 border-0"></td>
                @empty 
                    <tr>
                        <td colspan="100%">Tidak ada Record</td>
                    </tr>
                @endforelse
                  </tbody >
                </table>
                {{-- <div style="padding: 10px; float: right">
                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div> --}}
              </div> 
            </div> 
          </div> 
        </div>
      </div> 
    </section> 
  </div> 
@endsection