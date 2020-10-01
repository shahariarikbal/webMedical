@extends('layouts.app-web')

@section('content')
    <div class="container-fluid bg-img-login">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="card reg">
                        <img src="{{ asset('/fontend/assets/images/') }}/avatar.png" class="avatar">
                        <div class="card-body">
                            <form action="{{ route('clients.login') }}" method="post" style="margin-top: 40px;">
                                @csrf
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-block btn-success">Login</button>
                                <a href="{{ route('clients.registration.form') }}" class="pull-left" style="color: dodgerblue; font-weight: normal; margin-top: 25px;">Not register ? Click</a>
                                <a href="{{ route('clients.forgot.password.form') }}" class="pull-right" style="color: dodgerblue; font-weight: normal; margin-top: 25px;">Forgot password</a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block" style="margin-top: 62px;">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block" style="margin-top: 62px;">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
