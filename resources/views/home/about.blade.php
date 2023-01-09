@include('layout.header')
<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>About Us</h2>
                        <p>Home<span>/</span>About Us</p>
                        @foreach($lembaga as $l)
                        <div class="overflow-hidden">
                            <img src="/logo/{{$l->logo}}" alt="" width="300" height="300" class="rounded-circle">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->

<!-- feature_part start-->
<section class="feature_part single_feature_padding">
    <div class="container">
        <div class="row">
            @foreach($lembaga as $l)
            <div class="col-sm-12 col-xl-12 align-self-center">
                <div class="single_feature_text ">
                    <h2>{{$l->nama}}</h2>
                    <p>{{$l->tentang}}</p>
                    <a href="#" class="btn_1">Read More<i class="uil uil-arrow-right"></i></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- upcoming_event part start-->
@include('layout.footer')