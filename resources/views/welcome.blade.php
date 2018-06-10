@extends('layouts.master')
@section('title')
    Welcome!
@endsection
@section('content')
    @include('includes.message-blog')
    <div class="row">
        <div class="col-md-6">
            <form action="{{route('signUp')}}" method="post">
                <div class="form-group {{$errors->has('email') ? 'has-error': ''}}">
                    <h3> Sign up</h3>
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" id="email" value="{{Request::old('email')}}">
                </div>
                <div class="form-group {{$errors->has('first_name') ? 'has-error': ''}}">
                    <label for="first_name"> your first name</label>
                    <input class="form-control" type="text" name="first_name" id="first_name"
                           value="{{Request::old('first_name')}}">
                </div>
                <div class="form-group {{$errors->has('password') ? 'has-error': ''}}">
                    <label for="password">password</label>
                    <input class="form-control" type="password" name="password" id="password"
                           value="{{Request::old('password')}}">
                </div>
                <button type="submit" class="btn btn-primary"> Sing Up</button>
                <input type="hidden" name="_token" value="{{Session::token()}}">
            </form>
        </div>
        <div class="col-md-6">
            <h3>Sign in</h3>
            <form action="{{route('signIn')}}" method="post">
                <div class="form-group {{$errors->has('email') ? 'has-error': ''}}">
                    <label for="email">Email </label>
                    <input class="form-control" type="text" name="email"  value="{{Request::old('email')}}">
                </div>
                <div class="form-group {{$errors->has('password') ? 'has-error': ''}}">
                    <label for="password">password </label>
                    <input class="form-control" type="password" name="password"
                           value="{{Request::old('password')}}">
                </div>
                <button type="submit" class="btn btn-primary">Sign In</button>
                <input type="hidden" name="_token" value="{{Session::token()}}">
            </form>
        </div>
    </div>
@endsection
@section('clear')
    <section id="bottom" style="margin-top: 85px;">
        <div class="container wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms"
             style="visibility: hidden; animation-duration: 1000ms; animation-delay: 600ms; animation-name: none;">

        </div>
    </section>
@endsection
