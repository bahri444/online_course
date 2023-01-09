@extends('layout.template')
@section('content')
<div class="page-heading">
    <h3>Dashboard</h3>
    <p class="text-subtitle text-muted">Selamat datang kembali {{Auth::user()->username}}</p>
</div>
<div class="page-content">
    <section class="row">
        @foreach($member as $me)
        @if(Auth::user()->id_user==$me->id_user && $me->status_member=='aktif')
        <div class="row">
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card shadow-lg">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon purple mb-2">
                                    <i class="iconly-boldShow"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Kelas</h6>
                                <h6 class="font-extrabold mb-0">{{$kelas}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card shadow-lg">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon blue mb-2">
                                    <i class="iconly-boldProfile"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Kelas Anda</h6>
                                <h6 class="font-extrabold mb-0">
                                    @if(Auth::user()->id_user == $me->id_user)
                                    {{$transaksi}}
                                    @endif
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </section>
</div>
@endsection