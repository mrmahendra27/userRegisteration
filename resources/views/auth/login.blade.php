@extends('layouts.auth-master')
@section('content')
<div class="text-center">
    <h1 class="h4 text-gray-900 mb-4">Login!</h1>
</div>
<form class="user" action="{{ route('login') }}" method="POST" id="loginForm">
    @csrf
    @method('POST')
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="email" class="form-control form-control-user" name="email" id="Email" placeholder="Enter Email"
                value="{{ old('email') }}">
        </div>
        <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="password" class="form-control form-control-user" name="password" id="InputPassword"
                placeholder="Enter Password">
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-user btn-block btnSubmit">
        Login
    </button>
</form>
<hr>
<div class="text-center">
    <a class="small" href="{{ route('registerform') }}">Don't have an account? Register!</a>
</div>
@endsection
@section('extrajs')
<script>
    jQuery('#loginForm').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 8,
                },
            },
            messages: {
                email: {
                    required: "Please Enter Email",
                    email:"Please Enter Valid Email",
                },
                password: {
                    required: "Please Enter Password",
                    minlength: "Password must be of atleast 8 characters",
                },
            },
            submitHandler:function(form){
                $('.btnSubmit').attr('disabled', 'disabled');
                $(".btnSubmit").html('<span class="fa fa-spinner fa-spin"></span> Loading...');
                form.submit();
            }
        });
</script>
@endsection
