@extends('layout.login')

@section('form')
    <form action="{!! route("register.custom") !!}" method="POST" class="user">
        @csrf
        <div class="form-group">
            <input type="name" name="name" class="form-control form-control-user" id="name"  placeholder="Name">
        </div>
        <div class="form-group">
            <input type="email" name="email" class="form-control form-control-user" id="email"  placeholder="Enter Email Address...">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password">
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox small">
                <input type="checkbox" class="custom-control-input" id="customCheck">
                <label class="custom-control-label" for="customCheck">Remember Me</label>
            </div>
        </div>
        <button  type="submit" class="btn btn-primary btn-user btn-block">
            Login
        </button>
        <hr>
        <a href="#" class="btn btn-google btn-user btn-block">
            <i class="fab fa-google fa-fw"></i> Login with Google
        </a>
        <a href="#" class="btn btn-facebook btn-user btn-block">
            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
        </a>
    </form>
@endsection