@extends('layouts.layout')
@section('content-header')
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>Kas&nbsp;<a href="ruangujung.com">Ruang Ujung</a></li>
    <li><a href="#"><i class="fa fa-arrow-right"></i>&nbsp;<a href="ruangujung.com">Transaksi</a></li>
    <li class="active">Pemasukan</li>
  </ol>
@endsection

@section('content')
    <section class="content">
        <div class="callout callout-info">
            <h4>Perhatian</h4>
            <p>Berikut adalah daftar data pemasukan pada aplikasi kas, anda dapat menambahkan, mengubah dan menghapus data pemasukan yang sudah ada !! </p>
        </div>

        <div class="row">
            <div class="table-responsive">
                <div class="col-md-12">
                    <div class="box box-primary">
                      <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Manajemen Transaksi Pemasukan</h3>
                        <div class="box-tools pull-right">
                            <a onclick="tambahPemasukan()" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Tambah Pemasukan</a>
                        </div>
                      </div>
                      <div class="box-body table-responsive">
                            <form action=" {{ route('admin.pemasukan.post') }} " method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }} {{ method_field('POST') }}
                                <div class="row" id="form" style="display:none;">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Anggota</label>
                                            <select name="user_id" id="user_id" class="form-control">
                                                <option value="" selected disabled>-- pilih anggota --</option>
                                                @foreach ($users as $user)
                                                    <option value=" {{ $user->id }} "> {{ $user->nm_user }} </option>
                                                @endforeach
                                            </select>
                                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tanggal Pemasukan</label>
                                            <input type="date" name="tanggal_pemasukan" class="form-control" id="tanggal_pemasukan" aria-describedby="emailHelp" placeholder="Enter email">
                                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Periode Sekarang</label>
                                            <input type="text" name="periode_id" class="form-control" id="periode_id" value=" {{ $periode->id }} " aria-describedby="emailHelp" readonly>
                                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Jumlah Pemasukan</label>
                                            <input type="text" name="jumlah_pemasukan" class="form-control" id="jumlah_pemasukan" placeholder="jumlah pemasukan">
                                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Sumber Pemasukan</label>
                                            <input type="text" name="sumber_pemasukan" class="form-control" id="sumber_pemasukan" placeholder="sumber pemasukan">
                                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Bukti Fisik</label> &nbsp;
                                            <small id="bukti-error" class="form-text text-danger" style="font-style:italic;">Catatan: Hanya diperbolehkan file ekstensi jpg, jpeg, dan png</small>

                                            <input type="file" name="bukti_pemasukan" class="form-control" id="bukti_pemasukan" onchange="previewFoto()" accept="image/jpg,image/png,image/jpeg">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                    </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-6" style="padding:5px;">
                                                    <label class="control-label">Preview Foto</label><br>
                                                    <img class="foto-baru" id="preview-foto" src="" height="100" width="100">
                                                </div>
                                            </div>
                                        </div>

                                    <div class="col-md-12" style="text-align:center; margin-bottom:10px;">
                                        <a onclick="batalkan()" class="btn btn-danger" id="batalakan"><i class="fa fa-refresh"></i>&nbsp; Batalkan</a>
                                        <button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; Simpan</button>
                                    </div>
                                </div>
                            </form>
                            @if (empty($pemasukans[0]))
                                <div class="alert alert-danger" id="alert-error">
                                    <strong>Perhatian: </strong> belum ada transaksi yang dilakukan !!
                                </div>
                            @endif

                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button> 
                                    <strong>Perhatian :</strong>{{ $message }}
                                </div>
                            @endif


                        <table class="table table-bordered table-hover" id="table-data">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Nama Anggota</th>
                              <th>Tanggal Pemasukan</th>
                              <th>Periode</th>
                              <th>Sumber Pemasukan</th>
                              <th>Jumlah Pemasukan</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                              @php
                                  $no=1;
                              @endphp
                             @foreach ($pemasukans as $pemasukan)
                                 <tr>
                                     <td> {{ $no++ }} </td>
                                     <td> {{ $pemasukan->nm_user }} </td>
                                     <td> {{ $pemasukan->tanggal_pemasukan }} </td>
                                     <td> {{ $pemasukan->periode }} </td>
                                     <td> {{ $pemasukan->sumber_pemasukan }} </td>
                                     <td> {{ $pemasukan->jumlah_pemasukan }} </td>
                                     <td>
                                            <a href=" {{ route('admin.pemasukan.edit',[$pemasukan->id]) }} " class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <a onclick="hapusPemasukan( {{ $pemasukan->id }} )" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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

        function tambahPemasukan(){
            $('#form').show(300);
            $('#alert-error').hide();
        }

        function batalkan(){
            $('#form').hide(300);
            $('#alert-error').show(300);
        }

        $('#jumlah_pemasukan').keyup(function () { 
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });

    function editPemasukan(id){
        alert(id);
    }
        
    function previewFoto() {
        var preview = document.querySelector('#preview-foto');
        var file    = document.querySelector('input[type=file]').files[0];
        var reader  = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
    }
    </script>
@endpush