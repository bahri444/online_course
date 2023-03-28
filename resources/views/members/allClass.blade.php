@extends('layout.template')
@section('content')

<!-- modal beli kelas -->
@foreach($joinKelas as $row)
<div class="modal fade" id="beliKelas{{$row->id_kelas}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/addTransaksi" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Nama Lengkap</h6>
                            <fieldset class="form-group">
                                <select name="id_member" id="basicSelect" class="form-select">
                                    @foreach($users as $valId)
                                    @if(Auth::user()->id_user == $valId->id_user)
                                    <option value="{{$valId->id_user}}">{{$valId->nama_lengkap}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Nama kelas</h6>
                            <fieldset class="form-group">
                                <select name="id_kelas" id="basicSelect" class="form-select">
                                    <option value="{{$row->id_kelas}}" selected>{{$row->nama_bidang}}</option>
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h6>Tgl bayar</h6>
                            <input class="form-control" type="date" name="tgl_bayar" placeholder="tanggal bayar" aria-label="default input example">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!--read data all kelas-->
@foreach($users as $mbr)
@if(Auth::user()->id_user == $mbr->id_user && $mbr->status_akun=='aktif')
<div class="row justify-content-center">
    <div class="col-xl-5">
        <div class="section_tittle text-center">
            <h2>{{$title}}</h2>
        </div>
    </div>
</div>
<div class="row match-height mt-2">
    <!-- alert -->
    <div>
        @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
        @endif
        @if($errors->any())
        @foreach($errors->all() as $err)
        <p class="alert alert-danger">{{ $err }}</p>
        @endforeach
        @endif
    </div>
    @foreach($joinKelas as $val)
    <div class="col-md-4 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$val->nama_bidang}}</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6>Jenis kelas</h6>
                                </div>
                                <div class="col-md-8 form-group">
                                    <p>: {{$val->jenis_kelas}}</p>
                                </div>
                                <div class="col-md-4">
                                    <h6>Harga kelas</h6>
                                </div>
                                <div class="col-md-8 form-group">
                                    <p>: {{$val->harga_kelas}}</p>
                                </div>
                                <div class="col-md-4">
                                    <h6>Masa aktif kelas</h6>
                                </div>
                                <div class="col-md-8 form-group">
                                    <p>: {{$val->lama_course}}</p>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#beliKelas{{$val->id_kelas}}">
                                            <i class="fas fa-plus"></i>
                                            Beli
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@endforeach
@endsection