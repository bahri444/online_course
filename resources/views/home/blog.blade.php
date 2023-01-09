@include('layout.header')
<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>Our Blog</h2>
                        <p>Home<span>/</span>Blog</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->

<!-- member_counter counter start -->
<section class="member_counter mt-3">
    <div class="container">
        @foreach($lembaga as $lmb)
        <div class="row">
            <div class="col-lg-2 col-sm-6">
                <div class="single_member_counter">
                    <h5><i class="fas fa-user"></i>Member</h5>
                    <span class="counter">{{$member}}</span>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6">
                <div class="single_member_counter">
                    <h5><i class="fas fa-user"></i>Mentor</h5>
                    <span class="counter">{{$mentornon}}</span>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6">
                <div class="single_member_counter">
                    <h5><i class="uil uil-home"></i>Kelas Free</h5>
                    <span class="counter">{{$kelas2}}</span>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6">
                <div class="single_member_counter">
                    <h5><i class="uil uil-building"></i>Kelas Premium</h5>
                    <span class="counter">{{$kelas1}}</span>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6">
                <div class="single_member_counter">
                    <h5><i class="uil uil-building"></i>Kelas Bootcamp</h5>
                    <span class="counter">{{$kelas3}}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
<!-- member_counter counter end -->
@include('layout.footer')