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
                    <div class="card reg-forgot">
                        <div class="card-body">
                            <form method="POST" action="{{ route('clients.password.reset.link') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                </div>
                                <button type="submit" class="btn btn-block" style="background-color: deepskyblue">reset password</button>
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
