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
        <p>Silahkan Ubah Data Transaksi Pemasukan Yang Sudah Anda Pilih !!</p>
    </div>

    <div class="row">
        <div class="table-responsive">
            <div class="col-md-12">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;FORM EDIT TRANSAKSI PEMASUKAN</h3>
                  </div>
                  <div class="box-body table-responsive">
                    <form action=" {{ route('admin.pemasukan.update',[$pemasukan[0]->id]) }} " method="PATCH" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="row" id="form-edit">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Anggota</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        <option value="" selected disabled>-- pilih anggota --</option>
                                        @foreach ($users as $user)
                                            <option value=" {{ $user->id }}"
                                                @if ($user->id == $pemasukan[0]->user_id)
                                                    selected
                                                @endif    
                                            > {{ $user->nm_user }} </option>
                                        @endforeach
                                    </select>
                                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tanggal Pemasukan</label>
                                    <input type="text" name="tanggal_pemasukan" class="form-control" id="tanggal_pemasukan" value=" {{ $pemasukan[0]->tanggal_pemasukan }} " aria-describedby="emailHelp" placeholder="Enter email">
                                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Periode Sekarang</label>
                                    <input type="text" name="periode_id" class="form-control" id="periode_id" value=" {{ $pemasukan[0]->periode_id }} " aria-describedby="emailHelp" readonly>
                                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jumlah Pemasukan</label>
                                    <input type="text" name="jumlah_pemasukan" class="form-control" id="jumlah_pemasukan" value=" {{ $pemasukan[0]->jumlah_pemasukan }} " placeholder="jumlah pemasukan">
                                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sumber Pemasukan</label>
                                    <input type="text" name="sumber_pemasukan" class="form-control" id="sumber_pemasukan" value=" {{ $pemasukan[0]->sumber_pemasukan }} " placeholder="sumber pemasukan">
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
                                            <img class="foto-baru" id="preview-foto" src=" {{ $pemasukan[0]->bukti_pemasukan }} " height="100" width="100">
                                        </div>
                                    </div>
                                </div>

                            <div class="col-md-12" style="text-align:center; margin-bottom:10px;">
                                <a onclick="batalkan()" class="btn btn-danger" id="batalakan"><i class="fa fa-refresh"></i>&nbsp; Batalkan</a>
                                <button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; Simpan</button>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    <script>
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