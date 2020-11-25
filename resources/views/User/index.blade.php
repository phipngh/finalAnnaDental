@extends('master.user.master')

@section('content')
<div id="overlay"></div>

<div class="slide-item overlay" style="background-image: url('{{asset('UserSide/images/hero_1.jpg')}}')">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <h1 class="heading mb-5">We Provide High Solutions for Your Smile</h1>

            </div>
        </div>
    </div>
</div>

<div class="container quick-contact">
    <div class="row">
        <div class="col-lg-4">
            <a href="#" class="link-lg d-flex align-items-center disabled">
                <span class="icon-phone"></span>
                <div>
                    <span>Give us a call</span>
                    <strong>(+84) 2838 291 450</strong>
                </div>
            </a>
        </div>
        <div class="col-lg-4">
            <a href="#" class="link-lg d-flex align-items-center disabled">
                <span class="icon-envelope"></span>
                <div>
                    <span>Send us a message</span>
                    <strong>info@annadental.com</strong>
                </div>
            </a>
        </div>
        <div class="col-lg-4">
            <a href="#" class="link-lg d-flex align-items-center disabled">
                <span class="icon-room"></span>
                <div>
                    <span>Visit us</span>
                    <strong>6th Nguyen Hue st, District 1</strong>
                </div>
            </a>
        </div>
    </div>
</div>


<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <p><img src="{{asset('UserSide/images/about.png')}}" alt="Image" class="img-fluid"></p>
            </div>
            <div class="col-lg-5 ml-auto">
                <span class="subheading">About Us</span>
                <h2 class="heading"><strong class="text-primary">We Are Happy To Serve You!</strong></h2>
                <p>We are a caring international team of dentists from Germany, Canada, Australia, USA, Italy, Spain, Vietnam and Japan providing outstanding high quality dentistry for people coming to and living in Vietnam.</p>
                <p><a href="/contactus" class="btn btn-primary float-right">Contact Us</a> 
                </p>
            </div>
        </div>
    </div>
</div>

<div class="site-section bg-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mr-auto">
                <span class="subheading">Our Mission</span>
                <h2 class="heading">We Provide <strong class="text-primary">High Solutions</strong> for Your Smile
                </h2>
                <p>Our dental clinics are here to provide a full range of exceptional quality care for dental services like: professional cleanings, kids’ dental care, professional teeth whitening, root canal treatment, dental implants, All ON 4 dental implant procedure, bone reconstruction, orthodontics, invisible braces (invisalign), ceramic dental veneers, wisdom teeth removal/ wisdom tooth extraction, dental crowns and dental bridge.</p>

            </div>
            <div class="col-lg-6">
                <figure class="video-image">
                    <a href="https://www.youtube.com/watch?v=-hVy_jxeMeA" data-fancybox class="btn-play"><span class="icon-play"></span></a>
                    <img src="{{asset('UserSide/images/img_3.jpg')}}" alt="Image" class="img-fluid">
                </figure>
            </div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-7 mx-auto text-center">
                <span class="subheading">Our Services</span>
                <h2 class="heading"><strong class="text-primary">Health Services</strong> We Provided</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-6 col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-4">
                <a href="#" class="service-v1 text-center disabled">
                    <span class=""><i class="fa-2x fas fa-stethoscope"></i></span>
                    <h3>General Surgery</h3>
                    <p>Dental crowns are caps that are placed over teeth and kept in place with dental adhesive or cement to protect broken teeth.</p>
                </a>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-4">
                <a href="#" class="service-v1 text-center disabled">
                    <span class=""><i class="fa-2x fas fa-crutch"></i></span>
                    <h3>Outpatient Services</h3>
                    <p>Braces help align and straighten your teeth over a period of time and are a safe and reliable way of doing so.!</p>
                </a>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-4">
                <a href="#" class="service-v1 text-center disabled">
                    <span class=""><i class="fa-2x  fas fa-briefcase-medical"></i></span>
                    <h3>Respiratory Therapy</h3>
                    <p>Dentures are prosthetic teeth made to replace missing teeth. Dentures are removable, a quick fix for missing teeth!</p>
                </a>
            </div>


            <div class="col-6 col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-4">
                <a href="#" class="service-v1 text-center disabled">
                    <span class=""><i class="fa-2x fab fa-gratipay"></i></span>
                    <h3>Cardiac Clinic</h3>
                    <p>Cosmetic dentistry improves colour, shape, and alignment of your teeth, such as teeth whitening, teeth straightening, and veneers!</p>
                </a>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-4">
                <a href="#" class="service-v1 text-center disabled">
                    <span class=""><i class="fa-2x fas fa-spa"></i></span>
                    <h3>Laryngological Service</h3>
                    <p>Invisalign is the modern way to straighten your teeth. Invisalign gently shifts your teeth to create the aesthetically perfect smile.!</p>
                </a>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-4">
                <a href="#" class="service-v1 text-center disabled">
                    <span class=""><i class="fa-2x fas fa-tooth"></i></span>
                    <h3>Respiratory Therapy</h3>
                    <p>Fillings are used to treat cavities and repair cracked or teeth. They are used to fill the area on the tooth where it is lacking!</p>
                </a>
            </div>

        </div>
    </div>
</div>


<div class="site-section bg-light title-wrap-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto text-center">
                <span class="subheading">Our Team</span>
                <h2 class="heading"><strong class="text-primary">Our Dedicated</strong> Doctors</h2>
            </div>
        </div>
    </div>
</div>

<div class="site-section overlap-section">
    <div class="container">
        <div class="row">
            <div class="col-6 col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0">
                <a href="#" class="team">
                    <img src="{{asset('UserSide/images/person_1.jpg')}}" alt="Image" class="img-fluid">
                    <div class="team-inner">
                        <h3>Dr. Jade Guzman</h3>
                        <span>Cardiologist</span>
                    </div>
                </a>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0">
                <a href="#" class="team">
                    <img src="{{asset('UserSide/images/person_2.jpg')}}" alt="Image" class="img-fluid">
                    <div class="team-inner">
                        <h3>Dr. Hannah Ford</h3>
                        <span>Dermatologist</span>
                    </div>
                </a>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0">
                <a href="#" class="team">
                    <img src="{{asset('UserSide/images/person_3.jpg')}}" alt="Image" class="img-fluid">
                    <div class="team-inner">
                        <h3>Dr. James Wilson</h3>
                        <span>Surgeon</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="site-section bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-7 mx-auto text-center mb-5">
                <span class="subheading">What Client Says</span>
                <h2 class="heading"><strong class="text-primary">Happy</strong> Patients</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="testimonial text-center">
                    <img src="{{asset('UserSide/images/patient_1.jpg')}}" alt="Image" class="img-fluid">
                    <blockquote>
                        <p class="quote">I got a composite filling in one of my front teeth replaced here, and they did a fantastic job! They were able to get me in quickly, and they made sure that I was comfortable and knew what was going on throughout the entire procedure. The tooth looked beautiful at the end (even better than it did when I originally had it fixed in Denmark), and I couldn’t have been happier with the service!</p>
                        <cite class="author">Elizabeth Anderson, Hostpital Patients</cite>
                    </blockquote>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="testimonial text-center">
                    <img src="{{asset('UserSide/images/person_2.jpg')}}" alt="Image" class="img-fluid">
                    <blockquote>
                        <p class="quote">Dr Andrew, Dr Juan and all the front office staff and dental assistants are very professional and extremely detailed and caring in their work. Everyone speaks excellent English and I am extremely satisfied with my implants. I can highly recommend Westcoast International Dental Clinic as a world class and highly cost effective solution to your dental issues whilst in HCMC.</p>
                        <cite class="author">Elizabeth Anderson, Hostpital Patients</cite>
                    </blockquote>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="testimonial text-center">
                    <img src="{{asset('UserSide/images/person_3.jpg')}}" alt="Image" class="img-fluid">
                    <blockquote>
                        <p class="quote">Had a filling crack and partially fall out while traveling long term so needed a dentist ASAP! This may be ignorant but I was SUPER NERVOUS to go to a dentist in Asia, as I’m from USA and used to western dentistry but wow lemme tell you, this place was on par or better than my US dentist. Easy and top notch from beginning to end, great technology and facility and professionalism!</p>
                        <cite class="author">Elizabeth Anderson, Hostpital Patients</cite>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 
<div class="site-section">
    <div class="container">
        <div class="row mb-5 justify-content-center">
            <div class="col-lg-7 mx-auto text-center mb-5">
                <span class="subheading">Latest Blog</span>
                <h2 class="heading"><strong class="text-primary">News</strong> & Updates</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="blog-entry">
                    <a href="#" class="d-block">
                        <img src="{{asset('UserSide/images/img_1.jpg')}}" alt="Image" class="img-fluid">
                    </a>
                    <div class="post-meta d-flex justify-content-center">
                        <span>
                            <span class="icon-calendar"></span>
                            <span>23 Jul</span>
                        </span>
                        <span>
                            <span class="icon-user"></span>
                            <span>Admin</span>
                        </span>
                        <span>
                            <span class="icon-comment"></span>
                            <span>2 Comments</span>
                        </span>
                    </div>
                    <h2><a href="#">We're Providing the Quality Care</a></h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, laudantium.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="blog-entry">
                    <a href="#" class="d-block">
                        <img src="{{asset('UserSide/images/img_2.jpg')}}" alt="Image" class="img-fluid">
                    </a>
                    <div class="post-meta d-flex justify-content-center">
                        <span>
                            <span class="icon-calendar"></span>
                            <span>23 Jul</span>
                        </span>
                        <span>
                            <span class="icon-user"></span>
                            <span>Admin</span>
                        </span>
                        <span>
                            <span class="icon-comment"></span>
                            <span>2 Comments</span>
                        </span>
                    </div>
                    <h2><a href="#">We're Providing the Quality Care</a></h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, laudantium.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="blog-entry">
                    <a href="#" class="d-block">
                        <img src="{{asset('UserSide/images/img_3.jpg')}}" alt="Image" class="img-fluid">
                    </a>
                    <div class="post-meta d-flex justify-content-center">
                        <span>
                            <span class="icon-calendar"></span>
                            <span>23 Jul</span>
                        </span>
                        <span>
                            <span class="icon-user"></span>
                            <span>Admin</span>
                        </span>
                        <span>
                            <span class="icon-comment"></span>
                            <span>2 Comments</span>
                        </span>
                    </div>
                    <h2><a href="#">We're Providing the Quality Care</a></h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, laudantium.</p>
                </div>
            </div>
        </div>
    </div>
</div> -->

@section('script')
<script>
    $('.disabled').click(function(e) {
        e.preventDefault();
    })
</script>

@endsection


@endsection