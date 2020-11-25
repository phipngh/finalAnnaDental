@extends('master.user.master')

@section('content')


<div id="overlay"></div>

<br>
<div class="site-section pb-0">
    <div class="container">
        <div class="row my-5">
            <div class="col-md-7 pr-md-7 mb-5">
                <h6 class="float-right mb-3">Please feel free to send us a message.</h6>
                <div id="form_result"></div>
                <form id="sample_form" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" cols="30" rows="4" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary py-2 px-3 float-right" value="Send Message">
                    </div>
                </form>
            </div>
            <div class="col-md-5">
                <div class="media block-icon-1 d-block text-center">
                    <div class="icon mb-3"><span class="icon-room text-primary"></span></div>
                    <div class="media-body">
                        <h5 class="h6 mb-2">6th Nguyen Hue st, District 1</h5>
                    </div>
                </div> <!-- .block-icon-1 -->

                <div class="media block-icon-1 d-block text-center">
                    <div class="icon mb-3"><span class="icon-phone text-primary"></span></div>
                    <div class="media-body">
                        <h3 class="h6 mb-2">(+84) 2838 291 450</h3>
                    </div>
                </div> <!-- .block-icon-1 -->

                <div class="media block-icon-1 d-block text-center">
                    <div class="icon mb-3"><span class="icon-envelope text-primary"></span></div>
                    <div class="media-body">
                        <h3 class="h6 mb-2">info@annadental.com</h3>
                    </div>
                </div> <!-- .block-icon-1 -->

            </div>
        </div> <!-- .row -->

    </div>
</div> <!-- .templateux-section -->

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
                        <p class="quote">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo repellendus nihil qui iure animi maxime consequuntur aliquid sed tempore, amet!</p>
                        <cite class="author">Elizabeth Anderson, Hostpital Patients</cite>
                    </blockquote>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="testimonial text-center">
                    <img src="{{asset('UserSide/images/person_2.jpg')}}" alt="Image" class="img-fluid">
                    <blockquote>
                        <p class="quote">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo repellendus nihil qui iure animi maxime consequuntur aliquid sed tempore, amet!</p>
                        <cite class="author">Elizabeth Anderson, Hostpital Patients</cite>
                    </blockquote>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="testimonial text-center">
                    <img src="{{asset('UserSide/images/person_3.jpg')}}" alt="Image" class="img-fluid">
                    <blockquote>
                        <p class="quote">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo repellendus nihil qui iure animi maxime consequuntur aliquid sed tempore, amet!</p>
                        <cite class="author">Elizabeth Anderson, Hostpital Patients</cite>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<script>
    $(document).ready(function() {

        $('#sample_form').on('submit', function(event) {
            event.preventDefault();
            var action_url = "{{ route('user.message.store') }}";
            $.ajax({
                url: action_url,
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function(data) {
                    var html = '';
                    if (data.errors) {
                        html = '<div class="alert alert-danger">';
                        for (var count = 0; count < data.errors.length; count++) {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if (data.success) {
                        Swal.fire({
                            position: "top",
                            type: "success",
                            title: "Your data has been saved",
                            showConfirmButton: !1,
                            timer: 1500
                        });
                        $('#sample_form')[0].reset();
                    }
                    $('#form_result').html(html);
                }
            });
        });

    });
</script>

@endsection