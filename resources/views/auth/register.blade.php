@extends('layouts.auth-master')
@section('content')

<div class="text-center">
    <h1 class="h4 text-gray-900 mb-4">Register!</h1>
</div>
<form class="user" action="{{ route('register') }}" method="POST" id="registerForm">
    @csrf
    @method('POST')
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="text" class="form-control form-control-user" name="first_name" id="FirstName"
                placeholder="Enter First Name" value="{{ old('first_name') }}">
        </div>
        <div class="col-sm-6 mb-3 mb-sm-0"">
            <input type="text" class="form-control form-control-user" name="last_name" id="LastName"
                placeholder="Enter Last Name" value="{{ old('last_name') }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0"">
            <input type="email" class="form-control form-control-user" name="email" id="InputEmail"
                placeholder="Enter Email Address" value="{{ old('email') }}">
        </div>
        <div class="col-sm-6 mb-3 mb-sm-0"">
            <input type="number" class="form-control form-control-user" name="mobile" id="MobileNumber"
                placeholder="Enter Mobile Number" value="{{ old('mobile') }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-4 mb-3 mb-sm-0"">
            <input type="text" class="form-control form-control-user" name="state" id="InputState"
                placeholder="Enter State" value="{{ old('state') }}">
        </div>
        <div class="col-sm-4 mb-3 mb-sm-0"">
            <input type="text" class="form-control form-control-user" name="city" id="InputCity"
                placeholder="Enter City" value="{{ old('city') }}">
        </div>
        <div class="col-sm-4 mb-3 mb-sm-0"">
            <input type="number" class="form-control form-control-user" name="pincode" id="InputPincode"
                placeholder="Enter Pincode" value="{{ old('pincode') }}">
        </div>
    </div>
    <div class="form-group">
        <textarea name="address" id="address" class="form-control"
            placeholder="Enter Address">{{ old('address') }}</textarea>
    </div>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="password" class="form-control form-control-user" name="password" id="InputPassword"
                placeholder="Enter Password">
        </div>
        <div class="col-sm-6 mb-3 mb-sm-0"">
            <input type="password" class="form-control form-control-user" name="password_confirmation" id="ConfirmPassword"
                placeholder="Enter Confirm Password">
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-user btn-block btnSubmit">
        Register
    </button>
</form>
<hr>
<div class="text-center">
    <a class="small" href="{{ route('loginform') }}">Already have an account? Login!</a>
</div>
@endsection
@section('extrajs')
<script>
    jQuery('#registerForm').validate({
            rules: {
                first_name: {
                    required: true,
                    minlength: 4,
                    maxlength: 80,
                },
                last_name: {
                    required: true,
                    minlength: 4,
                    maxlength: 80,
                },
                email: {
                    required: true,
                    email: true,
                },
                mobile: {
                    required: true,
                    number: true,
                    minlength: 12,
                    maxlength: 12,
                },
                state: {
                    required: true,
                    minlength: 2,
                    maxlength: 80,
                },
                pincode: {
                    required: true,
                    digits: true,
                    minlength: 6,
                    maxlength: 6,
                },
                city: {
                    required: true,
                    minlength: 2,
                    maxlength: 80,
                },
                address: {
                    required: true,
                    minlength: 20,
                    maxlength: 510,
                },
                password: {
                    required: true,
                    minlength: 8,
                },
                password_confirmation: {
                    required: true,
                    minlength: 8,
                    equalTo : "#InputPassword"
                },
            },
            messages: {
                first_name: {
                    required: "Please Enter First Name",
                    minlength:"Enter at least (4) characters",
                    maxlength: "First name too long more than (80) characters",
                },
                last_name: {
                    required: "Please Enter Last Name",
                    minlength:"Enter at least (4) characters",
                    maxlength: "Last name too long more than (80) characters",
                },
                email: {
                    required: "Please Enter Email",
                    email:"Please Enter Valid Email",
                },
                mobile: {
                    required: "Please Enter Mobile Number",
                    number: "Mobile Number must be a number",
                    minlength: "Number must be of at least 12 digits",
                    maxlength: "Number must be of at most 12 digits"
                },
                state: {
                    required: "Please Enter State",
                    minlength:"Enter at least (2) characters",
                    maxlength: "State name too long more than (80) characters",
                },
                pincode: {
                    required: "Please Enter Pincode",
                    digits: "Pincode must be digits",
                    minlength: "Pincode must be of at least 6 digits",
                    maxlength: "Pincode must be of at most 6 digits"
                },
                city:  {
                    required: "Please Enter City",
                    minlength:"Enter at least (2) characters",
                    maxlength: "City name too long more than (80) characters",
                },
                address:  {
                    required: "Please Enter Address",
                    minlength:"Enter at least (20) characters",
                    maxlength: "Address too long more than (510) characters",
                },
                password: {
                    required: "Please Enter Password",
                    minlength: "Password must be of atleast 8 characters",
                },
                password_confirmation: {
                    required: "Please Enter Confirm Password",
                    minlength: "Confirm Password must be of atleast 8 characters",
                    equalTo : "Password does not match!"
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
