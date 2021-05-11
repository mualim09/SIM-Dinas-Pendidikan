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
                        <h4 class="card-title">Pengguna</h4>
                        <button type="button" class="btn btn-rounded btn-info" data-toggle="modal" data-target="#basicModal">
                            <span class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i></span>Tambah
                        </button>
                    </div>
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example5" class="display table-responsive-lg">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $dt)
                                    <tr>
                                        <td>{{$dt->name}}</td>
                                        <td>{{$dt->email}}</td>
                                        <td>{{$dt->password}}</td>
                                        <td>
                                            <div>
                                                <button type="button" class="badge light badge-info" data-toggle="modal" data-target="#EditModal_{{ $dt->id }}">
                                                    <i class="fa fa-pencil-square-o mr-1"></i>
                                                    Edit
                                                </button>    
                                            </div>
                                            <a href="{{ url('pengguna/hapus/'.$dt->id, []) }}">
                                                <span class="badge light badge-danger">
                                                    <i class="fa fa-trash-o mr-1"></i>
                                                    Hapus
                                                </span>
                                            </a>
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
                    <form method="POST" action="{{ url('pengguna/simpan_data') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" name="nama" class="form-control input-rounded" placeholder="Nama Lengkap">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text" name="email" class="form-control input-rounded" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-8">
                                <input type="text" name="password" class="form-control input-rounded" placeholder="password">
                            </div>
                        </div>
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
@foreach ($data as $dt)
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="EditModal_{{ $dt->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form method="POST" action="{{ url('pengguna/edit/'.$dt->id) }}">
                        @csrf
                        <input type="hidden" value="{{ $dt->id }}">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" name="nama" class="form-control input-rounded" placeholder="Nama Lengkap" value="{{$dt->name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text" name="email" class="form-control input-rounded" placeholder="Email" value="{{$dt->email}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-8">
                                <input type="text" name="password" class="form-control input-rounded" placeholder="password" value="{{ $dt->password }}">
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
@section('js')
<script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="./js/plugins-init/datatables.init.js"></script>
@endsection