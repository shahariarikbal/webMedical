@extends('layouts.app-web')

@section('title')
    Webmedical | Registration
@endsection

@section('content')
    <div class="container-fluid bg-img">
        <div class="col-lg-12" id="app">
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4" style="position: relative;" id="clientRegForm">
                    <!--Client Registration component-->
                    <client-registration></client-registration>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_js')

@endsection
