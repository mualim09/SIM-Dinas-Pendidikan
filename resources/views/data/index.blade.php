@extends('master')
@section('css')
<link href="./vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="./vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
<link href="./css/style.css" rel="stylesheet">
@endsection
@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Patient</h4>
                        <button type="button" class="btn btn-rounded btn-info" data-toggle="modal" data-target="#basicModal">
                            <span class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i></span>Tambah
                        </button>
                    </div>
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example5" class="display table-responsive-lg">
                                <thead>
                                    <tr>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>GU/LS</th>
                                        <th>Nama Program</th>
                                        <th>Kode Rekening Kegiatan                                        </th>
                                        <th>Nama Sub Kegiatan</th>
                                        <th>Nama Pekerjaan</th>
                                        <th>APBD Tahun</th>
                                        <th>Nilai Ajuan Pencairan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $dt)
                                    <tr>
                                        <td>{{$dt->bulan}}</td>
                                        <td>{{$dt->tahun}}</td>
                                        <td>{{$dt->tipe}}</td>
                                        <td>{{$dt->nama_program}}</td>
                                        <td>{{$dt->rekening_kegiatan}}</td>
                                        <td>{{$dt->sub_kegiatan}}</td>
                                        <td>{{$dt->pekerjaan}}</td>
                                        <td>{{$dt->apbd}}</td>
                                        <td>{{$dt->nilai}}</td>
                                        <td>{{ $dt->status }}</td>
                                        <td>
                                            <span class="badge light badge-warning">
                                                <i class="fa fa-circle text-warning mr-1"></i>
                                                In Treatment
                                            </span>
                                        </td>
                                        <td>
                                            <div class="dropdown ml-auto text-right">
                                                <div class="btn-link" data-toggle="dropdown">
                                                    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                                </div>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#">Lanjutkan</a>
                                                    <a class="dropdown-item" href="{{ url('CetakCover/'.$dt->id_data, []) }}">Cetak Cover</a>
                                                    <a class="dropdown-item" href="#">View Details</a>
                                                    <a class="dropdown-item" href=" {{ url('update/'.$dt->id_data, []) }}">Ganti Status</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="basicModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form method="POST" action="{{ url('simpan_data') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Bulan</label>
                            <div class="col-sm-8">
                                <select class="form-control " name="bulan">
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tahun</label>
                            <div class="col-sm-8">
                                <input type="text" name="tahun" class="form-control input-rounded" placeholder="Tahun">
                            </div>
                        </div>
                        <fieldset class="form-group">
                            <div class="row">
                                <label class="col-form-label col-sm-4 pt-0">GU/LS</label>
                                <div class="col-sm-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tipe" value="GU" checked>
                                        <label class="form-check-label">
                                            GU
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tipe" value="LS">
                                        <label class="form-check-label">
                                            LS
                                        </label>
                                    </div>  
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nama Program</label>
                            <div class="col-sm-8">
                                <input type="text" name="nama_program" class="form-control input-rounded" placeholder="Nama Program">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Kode Rekening Kegiatan</label>
                            <div class="col-sm-8">
                                <input type="text" name="rekening_kegiatan" class="form-control input-rounded" placeholder="Kode Rekening Kegiatan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nama Sub Kegiatan</label>
                            <div class="col-sm-8"> 
                                <input type="text" name="sub_kegiatan" class="form-control input-rounded" placeholder="Nama Sub Kegiatan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nama Pekerjaan</label>
                            <div class="col-sm-8">
                                <input type="text" name="pekerjaan" class="form-control input-rounded" placeholder="Nama Pekerjaan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">APBD Tahun</label>
                            <div class="col-sm-8">
                                <input type="text" name="apbd" class="form-control input-rounded" placeholder="Tahun APBD">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nilai Ajuan Pencairan</label>
                            <div class="col-sm-8">
                                <input type="text" name="nilai" class="form-control input-rounded" placeholder="Nilai Ajuan Pencairan">
                            </div>
                        </div>
                        <input type="hidden" name="status" class="form-control input-rounded" value="0">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="./js/plugins-init/datatables.init.js"></script>
@endsection