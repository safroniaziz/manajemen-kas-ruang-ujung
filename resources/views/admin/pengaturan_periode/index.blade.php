@extends('layouts.layout')
@section('content-header')
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>Kas&nbsp;<a href="ruangujung.com">Ruang Ujung</a></li>
    <li class="active">Dasboard</li>
  </ol>
@endsection

@section('content')
    <section class="content">
        <div class="callout callout-info">
            <h4>Perhatian</h4>

            <p>Berikut adalah daftar periode pada aplikasi kas milik, anda dapat menambahkan, mengaktifkan ataupun menonaktifkan data periode !! </p>
        </div>

        <div class="row">
            <div class="table-responsive">
                <div class="col-md-12">
                    <div class="box box-primary">
                      <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Pengaturan Periode</h3>
                      </div>
                      <div class="box-body table-responsive">
                        <table class="table table-bordered table-hover" id="table-data">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Periode</th>
                              <th>Status Periode</th>
                              <th>Ubah Status</th>
                            </tr>
                          </thead>
                          <tbody>
                              @php
                                  $no=1;
                              @endphp
                             @foreach ($periodes as $periode)
                                 <tr>
                                     <td> {{ $no++ }} </td>
                                     <td> {{ $periode->periode }} </td>
                                     <td>
                                       @if ($periode->status == '1')
                                           <label class="label label-primary">aktif</label>
                                           @else
                                             <label class="label label-danger">tidak aktif</label>
                                       @endif
                                     </td>
                                     <td>
                                        @if ($periode->status == '1')
                                          <a onclick="nonaktifkanStatus({{ $periode->id }})" class="btn btn-primary"><i class="fa fa-thumbs-up"></i></a>
                                          @else
                                           <a onclick="aktifkanStatus( {{ $periode->id }} )" class="btn btn-primary"><i class="fa fa-thumbs-up"></i></a>
                                        @endif
                                     </td>
                                 </tr>
                             @endforeach
                          </tbody>
                        </table>
                      </div>
                      <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $('#table-data').DataTable({
            "oLanguage": {
              "sSearch": "Cari Data :",
              "sZeroRecords": "Tidak Ada Data Ditampilkan",
              "sProcessing": "<i class='fa fa-spinner fa-1x fa-fw' style='color:black !important;'></i>&nbsp; Memuat. Harap Tunggu.. !!",
              "sEmptyTable": 'Tidak Ada Data Yang Dimuat',
              "sLengthMenu": 'Menampikan: <select>'+
                '<option value="10">10</option>'+
                '<option value="50">50</option>'+
                '<option value="100">100</option>'+
                '<option value="-1">Semua</option>'+
                '</select> Data',
                "sInfoFiltered": " - Filter Dari _MAX_ Data",
                "sInfo": "Mendapatkan _START_ - _END_ Data Ditampilkan Dari _TOTAL_ Data",
                "sInfoEmpty": "Mendapatkan 0 Sampai 0 Dari 0Data ",
                "oPaginate": {
                    "sPrevious": "Sebelumnya", 
                    "sNext": "Selanjutnya", 
                }
            },
        });
    </script>
@endpush