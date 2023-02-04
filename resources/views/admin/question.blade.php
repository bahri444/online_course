@extends('layout.template')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Question</h3>
                <p class="text-subtitle text-muted">Selamat datang kembali {{Auth::user()->username}}</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
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
        <div class="card">
            <div class="card-body">
                <!-- Button trigger modal -->
                @if(Auth::user()->role=='mentor')
                <div class="mb-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">
                        <i class="fa fa-plus"></i>
                        Add Question
                    </button>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Judul modul</th>
                                <th class="text-center">Modul ke</th>
                                <th class="text-center">Jenis kelas</th>
                                <th class="text-center">Soal 1</th>
                                <th class="text-center">Soal 2</th>
                                <th class="text-center">Status soal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($quis as $val)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$val->judul}}</td>
                                <td>{{$val->modul_ke}}</td>
                                <td>{{$val->jenis_kelas}}</td>
                                <td>{{$val->one}}</td>
                                <td>{{$val->two}}</td>
                                <td>{{$val->status_question}}</td>
                                <td>
                                    <div class="d-flex justify-content-between">
                                        @if(Auth::user()->role=='admin')
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalUpdt{{$val->id_question}}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$val->id_question}}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        @elseif(Auth::user()->role=='mentor')
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalUpdt{{$val->id_question}}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- modal add question -->
@foreach($quis as $que)
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Question</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/question/addQuestion" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h6>Modul Ke</h6>
                            <fieldset class="form-group">
                                <select name="id_modul" id="basicSelect" class="form-select">
                                    <option value="{{$que->id_modul}}" selected>{{$que->judul}}</option>
                                    @foreach($mdl as $mod)
                                    <option value="{{$mod->id_modul}}">{{$mod->judul}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-md-12 mb-3">
                            <h6>1. </h6>
                            <input class="form-control" type="text" name="one" placeholder="soal pertama" aria-label="default input example">
                        </div>
                        <div class="col-md-12 mb-3">
                            <h6>2. </h6>
                            <input class="form-control" type="text" name="two" placeholder="soal kedua" aria-label="default input example">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach


<!-- modal update question -->
@foreach($quis as $qu)
<div class="modal fade" id="modalUpdt{{$qu->id_question}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Question</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/question/updtQuestion" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <input type="text" class="form-control" name="id_question" value="{{$qu->id_question}}">
                        <div class="col-md-12 mb-3">
                            <h6>Modul Ke</h6>
                            <fieldset class="form-group">
                                <select name="id_modul" id="basicSelect" class="form-select">
                                    <option value="{{$qu->id_modul}}" selected>{{$qu->judul}}</option>
                                    @foreach($mdl as $mod)
                                    <option value="{{$mod->id_modul}}">{{$mod->judul}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-md-12 mb-3">
                            <h6>1. </h6>
                            <input class="form-control" type="text" name="one" value="{{$qu->one}}" placeholder="soal pertama" aria-label="default input example">
                        </div>
                        <div class="col-md-12 mb-3">
                            <h6>2. </h6>
                            <input class="form-control" type="text" name="two" value="{{$qu->two}}" placeholder="soal kedua" aria-label="default input example">
                        </div>
                        <div class="col-md-12 mb-3">
                            <h6>Status Quis</h6>
                            <fieldset class="form-group">
                                <select name="status_question" id="basicSelect" class="form-select">
                                    <option value="{{$qu->status_question}}" selected>{{$qu->status_question}}</option>
                                    <option value="nonaktif">Nonaktif</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </fieldset>
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

<!-- modal delete -->
@foreach($quis as $q)
<div class="modal fade" id="modalDelete{{$q->id_question}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" value="{{$q->id_question}}" name="id_modul">
                <p>Yakin ingin menghapus data ini...?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <a href="/question/deleteQuestion/{{$q->id_question}}" class="btn btn-warning">Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection