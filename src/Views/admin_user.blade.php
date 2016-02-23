@extends('vendor.installer.layouts.master')

@section('title', trans('messages.environment.title'))
@section('container')
    @if (session('message'))
        <p class="alert">{{ session('message') }}</p>
    @endif
    <form method="post" action="{{ route('LaravelInstaller::userAdminSave') }}">
        <label for="name" class="label">Name</label>
        <input type="input" id="name" name="name" class="input" placeholder="Your Name" value="{{ old('name') }}">

        <label for="email" class="label">Email</label>
        <input type="input" id="email" name="email" class="input" placeholder="Your Email will be your access" value="{{ old('email') }}">

        <label for="password" class="label">Password</label>
        <input type="password" id="password" name="password" class="input no-margin-b" placeholder="Your secret password">
        <div class="checkbox-footer">
            <input type="checkbox" id="show-password"> <label for="show-password">Show password</label>
        </div>
        {!! csrf_field() !!}

        @if(!isset($environment['errors']))
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="buttons">
                <input type="submit" class="button m-auto" value="{{ trans('messages.next') }}">

            </div>
    </form>
    @endif
@stop
@section('js_section')
    <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
    <script type="application/javascript" src="//cdnjs.cloudflare.com/ajax/libs/hideshowpassword/2.0.10/hideShowPassword.min.js"></script>
    <script type="application/javascript">
        $('#show-password').change(function(){
            $('#password').hideShowPassword($(this).prop('checked'));
        });
    </script>
@stop
