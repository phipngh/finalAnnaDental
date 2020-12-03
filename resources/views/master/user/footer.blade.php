<footer class="site-footer bg-primary">
    <div class="container">
        <div class="row">

            <div class="col-sm-6">
                <h2 class="footer-heading mb-4">Navigation</h2>
                <ul class="list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">&nbsp;&nbsp;Blog</a></li>
                    <li><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;About Us</a></li>
                    <li><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contact</a></li>
                </ul>
            </div>
            <div class="col-sm-6">
                <h2 class="footer-heading mb-4">Social</h2>
                <div class="social mb-5">
                    <a href="#" class=""><span class="icon-facebook"></span></a>
                    <a href="#" class=""><span class="icon-twitter"></span></a>
                    <a href="#" class=""><span class="icon-linkedin"></span></a>
                    <a href="#" class=""><span class="icon-instagram"></span></a>
                </div>


                <h2 class="footer-heading mb-4">Subscribe Newsletter</h2>
                <form method="POST" id="footer-subscribe" class="footer-subscribe">
                    <div class="input-group mb-3">

                        @csrf
                        <input type="email" id="subcrible_email" name="subcrible_email" class="form-control bg-transparent" placeholder="Enter Email">
                        <div class="input-group-append">
                            <button class="btn btn-white text-black" type="submit">Send</button>
                        </div>


                    </div>
                </form>
            </div>
        </div>

    </div>
</footer>