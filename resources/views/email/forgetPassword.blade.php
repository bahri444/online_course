@include('layout.headers')
<h1>Forget Password Email</h1>

klik link ini untuk reset password anda:
<a href="{{ url('resetpasswdform') }}/{{$token}}">Reset Password</a>
@include('layout.footer')