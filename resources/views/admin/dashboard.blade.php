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
      <h4>Selamat Datang</h4>

      <p>Halo User, anda login sebagai administrator aplikasi kas <a href="ruangujung.com">ruangujung.com</a>, silahkan gunakan menu yang sudah disediakan, dan jangan lupa keluar setelah menggunakan aplikasi !!</p>
    </div>

    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">SALDO AWAL</span>
            <span class="info-box-number">Rp. {{ number_format($saldo_awal->dana_awal) }},- </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Jumlah Pemasukan</span>
            <span class="info-box-number">Rp. {{ number_format($jumlah_pemasukan[0]->jumlah_pemasukan) }},- </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Jumlah Pengeluaran</span>
            <span class="info-box-number">Rp. {{ number_format($jumlah_pengeluaran[0]->jumlah_pengeluaran) }},- </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Saldo Akhir</span>
            <span class="info-box-number">Rp. {{ number_format($saldo_akhir) }} </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->


    <div class="row">
      <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-sign-in"></i>&nbsp;Riwayat Pemasukan</h3>
          </div>
          <div class="box-body table-responsive">
            <table class="table table-bordered table-hover table-data">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Pemilik Kas</th>
                  <th>Nama Anggota</th>
                  <th>Tanggal pemasukan</th>
                  <th>Sumber pemasukan</th>
                  <th>Periode</th>
                  <th>Jumlah Pemasukan</th>
                </tr>
              </thead>
              <tbody>
                  @php
                      $no=1;
                  @endphp
                  @foreach ($pemasukans as $pemasukans)
                      <tr>
                        <td> {{ $no++ }} </td>
                        <td> {{ $pemasukans->nm_kas }} </td>
                        <td> {{ $pemasukans->nm_user }} </td>
                        <td> {{ $pemasukans->tanggal_pemasukan }} </td>
                        <td> {{ $pemasukans->sumber_pemasukan }} </td>
                        <td> {{ $pemasukans->periode }} </td>
                        <td> {{ $pemasukans->jumlah_pemasukan }} </td>
                  @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </div>

      <div class="col-md-6">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-sign-out"></i>&nbsp;Riwayat Pengeluaran</h3>
          </div>
          <div class="box-body table-responsive">
            <table class="table table-bordered table-hover table-data">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal Pengeluaran</th>
                  <th>Keperluan</th>
                  <th>Periode</th>
                  <th>Jumlah Pengeluaran</th>
                </tr>
              </thead>
              <tbody>
                  @php
                      $no=1;
                  @endphp
                  @foreach ($pengeluarans as $pengeluaran)
                      <tr>
                        <td> {{ $no++ }} </td>
                        <td> {{ $pengeluaran->nm_kas }} </td>
                        <td> {{ $pengeluaran->tanggal_pengeluaran }} </td>
                        <td> {{ $pengeluaran->keperluan }} </td>
                        <td> {{ $pengeluaran->periode }} </td>
                        <td> {{ $pengeluaran->jumlah_pengeluaran }} </td>
                  @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
    </div>
    <!-- /.box -->
  </section>
@endsection

@push('scripts')
    <script>
        $('.table-data').DataTable({
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
            responsive: true,
        });
    </script>
@endpush