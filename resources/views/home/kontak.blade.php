@include('layout.header')
<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>Contact us</h2>
                        <p>Home<span>/<span>Contact us</p>
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
                    <h4><i class="uil uil-phone-alt"></i>Kontak</h4>
                    <span class="counter">{{$lmb->kontak}}</span>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6">
                <div class="single_member_counter">
                    <h4><i class="uil uil-envelope"></i>Email</h4>
                    <span class="counter">{{$lmb->email}}</span>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6">
                <div class="single_member_counter">
                    <h4><i class="uil uil-whatsapp-alt"></i>WhatsApp</h4>
                    <span class="counter">{{$lmb->whatsapp}}</span>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6">
                <div class="single_member_counter">
                    <h4><i class="uil uil-facebook"></i>Facebook</h4>
                    <span class="counter">{{$lmb->facebook}}</span>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6">
                <div class="single_member_counter">
                    <h4><i class="uil uil-instagram-alt"></i>Instagram</h4>
                    <span class="counter">{{$lmb->instagram}}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
<!-- member_counter counter end -->
@include('layout.footer')