<footer class="w3l-footer-66">
    <!-- footer -->
    <div class="footer-66-info">
        <div class="container">
            <div class="row footer-top">
                <div class="col-lg-4 footer-grid_section_w3layouts pr-lg-5">
                    <h2 class="logo-2 mb-lg-4 mb-3">
                        <a class="navbar-brand" href="index.html"><span>Web</span>Medical</a>
                    </h2>
                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                        commodo consequat.</p>
                    <h4 class="sub-con-fo ad-info my-4">Catch on Social</h4>
                    <ul class="w3layouts_social_list list-unstyled">
                        <li>
                            <a href="#" class="w3pvt_facebook">
                                <span class="fa fa-facebook-f"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="w3pvt_twitter">
                                <span class="fa fa-twitter"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="w3pvt_dribble">
                                <span class="fa fa-dribbble"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="w3pvt_google">
                                <span class="fa fa-google-plus"></span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-8 footer-right">
                    <div class="w3layouts-news-letter">
                        <h3 class="footer-title mb-0">Newsletter</h3>

                        <p class="mb-3">By subscribing to our mailing list you will always get latest news and
                            updates from us.
                        </p>
                        <form action="#" method="post" class="w3layouts-newsletter">
                            <input type="email" name="Email" placeholder="Enter your email..." required="">
                            <button class="btn1"> Subscribe</button>

                        </form>
                    </div>
                    <div class="bottom-w3layouts-sec-nav">
                        <div class="row sub-content-botom mx-0">
                            <div class="col-md-4 footer-grid_section_w3layouts pl-lg-0">
                                <h3 class="footer-title">Information</h3>
                                <ul class="footer list-unstyled">
                                    <li>
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li>
                                        <a href="about.html">About Us</a>
                                    </li>
                                    <li>
                                        <a href="blog.html">Blog</a>
                                    </li>
                                    <li>
                                        <a href="services.html">Services</a>
                                    </li>
                                    <li>
                                        <a href="contact.html">Contact Us</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-4 footer-grid_section_w3layouts">
                                <!-- social icons -->

                                <h3 class="footer-title">Treatments</h3>
                                <ul class="footer list-unstyled">

                                    <li>
                                        <a href="#">Preventative Dentistry</a>
                                    </li>
                                    <li>
                                        <a href="#">Child Dentistry</a>
                                    </li>
                                    <li>
                                        <a href="#">Affordable Dentures</a>
                                    </li>
                                    <li>
                                        <a href="#">Tooth Extraction</a>
                                    </li>

                                </ul>

                                <!-- social icons -->
                            </div>
                            <div class="col-md-4 footer-grid_section_w3layouts ">
                                <h3 class="footer-title">Office Hours</h3>
                                <ul class="wrk-schedule-block">
                                    <li>Monday<span class="schedule-time">09:00 – 17:00</span></li>
                                    <li>Tuesday<span class="schedule-time">09:00 – 17:00</span></li>
                                    <li>Wednesday<span class="schedule-time">09:00 – 17:00</span></li>
                                    <li>Thursday<span class="schedule-time">09:00 – 17:00</span></li>
                                    <li>Friday<span class="schedule-time">Closed</span></li>
                                    <li>Sat day-Sunday<span class="schedule-time">09:00 – 17:00</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cpy-right py-3">
        <p class="text-center">© {{ date('Y') }} webmedical. All rights reserved | Design by
            <a href="#"> webmedical.</a>
        </p>
    </div>
    <!-- move top -->
    <button onclick="topFunction()" id="movetop" title="Go to top">
        <span class="fa fa-level-up"></span>
    </button>
    <script>
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function () {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("movetop").style.display = "block";
            } else {
                document.getElementById("movetop").style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
    <!-- /move top -->
</footer>
