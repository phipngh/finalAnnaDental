<!doctype html>
<html lang="en">

<head>
    <title>AnnaDental</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{asset('UserSide/images/favicon.ico')}}">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('UserSide/fonts/icomoon/style.css')}}">
    <link rel="stylesheet" href="{{asset('UserSide/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('UserSide/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('UserSide/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('UserSide/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('UserSide/css/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{asset('UserSide/css/style.css')}}">
    <link href="{{asset('AdminSide/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('AdminSide/libs/sweetalert2/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('AdminSide/libs/jquery-toast/jquery.toast.min.css')}}">
    <style>
        <style type="text/css">h1 {
            color: green;
        }

        .xyz {
            background-size: auto;
            text-align: center;
            padding-top: 100px;
        }

        .btn-circle.btn-sm {
            width: 30px;
            height: 30px;
            padding: 6px 0px;
            border-radius: 15px;
            font-size: 8px;
            text-align: center;
        }

        .btn-circle.btn-md {
            width: 50px;
            height: 50px;
            padding: 7px 10px;
            border-radius: 25px;
            font-size: 10px;
            text-align: center;
        }

        .btn-circle.btn-xl {
            width: 70px;
            height: 70px;
            padding: 10px 16px;
            border-radius: 35px;
            font-size: 12px;
            text-align: center;
        }
    </style>
    </style>


</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    {{--<div id="overlayer"></div>--}}
    {{--<div class="loader">--}}
    {{-- <div class="spinner-border text-primary" role="status">--}}
    {{-- <span class="sr-only">Loading...</span>--}}
    {{-- </div>--}}
    {{--</div>--}}


    <div class="site-wrap">
        @include('master.user.header')

        @yield('content')


        @include('master.user.footer')



        <button name="create_record" id="create_record" class="btn btn-md btn-circle btn-dark" style="position: fixed; bottom: 20px; left: 20px;z-index: 99999;"><i class="fab fa-wpforms fa-2x"></i></button>

    </div> <!-- .site-wrap -->

    <div id="formModal" name="formModal" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="overflow-y: initial !important;">
            <div class="modal-content">
                <form id="appointment_form" method="POST">
                    @csrf
                    <div class="modal-header text-center bg-primary">
                        <h5 class="modal-title col-12 text-center text-white" id="myExtraLargeModalLabel">Book an appointment...</h5>
                    </div>
                    <div class="modal-body">
                        <span id="form_result_app"></span>
                        <div class="form-group form-row">
                            <div class="col-6">
                                <label>Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Service Name">
                            </div>
                            <div class="col-6">
                                <label>Email</label>
                                <input type="mail" class="form-control" id="email" name="email" placeholder="Enter Service Name">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-6">
                                <label>Phone Number</label>
                                <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Enter Service Name">
                            </div>
                            <div class="col-6">
                                <label>Date Booking</label>
                                <input type="datetime-local" class="form-control" id="date" name="date" placeholder="Enter Service Name">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-12">
                                <label>Note</label>
                                <textarea type="text" class="form-control" id="note" name="note" placeholder="Enter Service Name" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-dark" data-dismiss="modal" id="cancel_button" value="Cancel">
                            <button type="submit" id="action_button" name="action_button" class="btn btn-primary text-white">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="{{asset('UserSide/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('UserSide/js/jquery-ui.js')}}"></script>
    <script src="{{asset('UserSide/js/popper.min.js')}}"></script>
    <script src="{{asset('UserSide/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('UserSide/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('UserSide/js/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('UserSide/js/jquery.easing.1.3.js')}}"></script>
    <script src="{{asset('UserSide/js/aos.js')}}"></script>
    <script src="{{asset('UserSide/js/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('UserSide/js/jquery.sticky.js')}}"></script>
    <script src="{{asset('UserSide/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('UserSide/js/main.js')}}"></script>

    <script src="{{asset('AdminSide/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset('AdminSide/libs/jquery-toast/jquery.toast.min.js')}}"></script>


    <script>
        $(document).ready(function() {
            $('#create_record').click(function() {
                $('#form_result').html('');
                $('#name').val('');
                $('#email').val('');
                $('#phonenumber').val('');
                $('#date').val('');
                $('#note').val('');
                $('#formModal').modal('show');
            });

            $('#appointment_form').on('submit', function(event) {
                event.preventDefault();
                var action_url = "{{ route('user.appointment.store') }}";
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
                                timer: 2000
                            });
                            $('#appointment_form')[0].reset();
                            $('#formModal').modal('hide');
                        }
                        $('#form_result_app').html(html);
                    }
                });
            });

        });


        $(document).ready(function() {
            $.toast({
                text: "In case you wanna make an appointment, click here.",
                icon: 'info',
                showHideTransition: "plain",
                position: {
                    left: 60,
                    bottom: 55
                },
                hideAfter: 7000,
                loaderBg: "#1ea69a",
                stack: 1,
                bgColor: '#3c90f7',
                loaderBg: '#fff',
            });
        });
    </script>
    @yield('script')
</body>

</html>