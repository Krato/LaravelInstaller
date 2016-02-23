@extends('vendor.installer.layouts.master')

@section('title', trans('messages.environment.title'))
@section('container')
    @if (session('message'))
    <p class="alert">{{ session('message') }}</p>
    @endif
    <form method="post" action="{{ route('LaravelInstaller::environmentSave') }}">
            <label for="database" class="label">Database</label>
            <input type="input" id="database" name="database" class="input" placeholder="homestead" value="{{ $database }}">

            <label for="user" class="label">User</label>
            <input type="input" name="user" class="input" placeholder="homestead" value="{{ $username }}">

            <label for="password" class="label">Password</label>
            <input type="input" name="password" class="input" placeholder="secret" value="{{ $password }}">

            <label for="host" class="label">Server</label>
            <input type="input" name="host" class="input" placeholder="localhost" value="{{ $host }}">
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