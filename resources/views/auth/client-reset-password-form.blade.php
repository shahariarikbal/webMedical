@extends('layouts.app-web')

@section('content')
    <div class="container-fluid bg-img-forgot">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    @if($success = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 16px;">
                            <strong>Success!</strong> {{ $success }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card reset-form">
                        <div class="card-body">
                            <form method="POST" action="{{ url('clients/password-update?token='.request('token')) }}">
                                @csrf
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" class="form-control" name="password" required placeholder="Password">
                                    <small style="color: red"> {{ $errors->has('password') ? $errors->first('password') : ' ' }}</small>
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" required placeholder="Password">
                                </div>
                                <button type="submit" class="btn btn-block" style="background-color: deepskyblue">Password Update</button>
                                <a href="{{ route('clients.registration.form') }}" class="pull-left" style="color: dodgerblue; font-weight: normal; margin-top: 10px;">Not register ? Click</a>
                                <a href="{{ route('clients.login.form') }}" class="pull-right" style="color: dodgerblue; font-weight: normal; margin-top: 10px;">Login</a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>
@endsection
