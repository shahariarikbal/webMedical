<section class="w3l-top-header-content">
    <div class="hny-top-menu">
        <div class="container">
            <div class="row">
                <div class="top-left col-lg-6">
                    <ul class="accounts">
                        <li class="top_li"><span class="fa fa-map-o"></span> <a href="#">Dolor sit, #PTH, 55080,
                                4300 Honey Street</a>
                        </li>
                        <li class="top_li mr-lg-0"><span class="fa fa-envelope-o"></span> <a
                                href="mailto:mail@company.com" class="mail"> info@webmadical.com</a>

                        </li>
                    </ul>
                </div>
                <div class="social-top col-lg-6 mt-lg-0 mt-sm-3">
                    <div class="top-bar-text"><a class="bk-button" href="#">BOOK ONLINE </a> You can
                        register for your organisation</div>
                </div>

            </div>
        </div>
    </div>
</section>
<!--//top-header-content-->
<!--w3l-header-->
<header class="w3l-header-nav">
    <!--/nav-->
    <nav class="navbar navbar-expand-lg navbar-light px-lg-0 py-0 px-3 stroke">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><span>Web</span>Medical</a>
            <!-- if logo is image enable this
                    <a class="navbar-brand" href="#index.html">
                        <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
                    </a> -->
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="fa icon-expand fa-bars"></span>
                <span class="fa icon-close fa-times"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-lg-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('clients.registration.form') }}" style="color: orangered; font-weight: bold">Register</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('clients.login.form') }}" style="color: orangered; font-weight: bold">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>

                <div class="call-support">
                    <p>Call us for any question</p>
                    <h5>+8801309608232</h5>
                </div>
            </div>
        </div>
        <!---Login Modal--->
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Organisation Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Organisation email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Password</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="password" name="password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-toggle="modal" data-target="#exampleModal" data-dismiss="modal">Not Register ? Click</a> ||
                        <a href="#" data-toggle="modal" data-target="#forgotPasswordModal" data-dismiss="modal">Forgot password</a>
                        <button type="button" style="background-color: #0b0b0b; color: white" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success">login</button>
                    </div>
                </div>
            </div>
        </div>
        <!---Forgot password--->
        <div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Organisation email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-toggle="modal" data-target="#loginModal" data-dismiss="modal" style="margin-right: 50px;">Already register ? Click</a>
                        <button type="button" style="background-color: #0b0b0b; color: white" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!--//nav-->
</header>
