<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>AnnaDental</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
   
    <link rel="shortcut icon" href="{{asset('AdminSide/images/favicon.ico')}}">
    <!-- App css -->
    <link href="{{asset('AdminSide/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('AdminSide/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('AdminSide/css/app.min.css')}}" rel="stylesheet" type="text/css" />

    <style>
        .google-button {
            height: 40px;
            border-width: 0;
            background: white;
            color: #737373;
            border-radius: 5px;
            white-space: nowrap;
            box-shadow: 1px 1px 0px 1px rgba(0, 0, 0, 0.05);
            transition-property: background-color, box-shadow;
            transition-duration: 150ms;
            transition-timing-function: ease-in-out;
            padding: 0;
       
        }

        .google-button:focus,
        .google-button:hover {
            box-shadow: 1px 4px 5px 1px rgba(0, 0, 0, 0.1);
        }

        .google-button:active {
            background-color: #e5e5e5;
            box-shadow: none;
            transition-duration: 10ms;
        }


        .google-button__icon {
            display: inline-block;
            vertical-align: middle;
            margin: 8px 0 8px 8px;
            width: 18px;
            height: 18px;
            box-sizing: border-box;
        }

        .google-button__icon--plus {
            width: 27px;
        }

        .google-button__text {
            display: inline-block;
            vertical-align: middle;
            padding: 0 24px;
            font-size: 14px;
            font-weight: bold;
            font-family: 'Roboto', arial, sans-serif;
        }
    </style>
</head>

<body class="authentication-bg bg-gradient">

    @yield('content')

    <!-- Vendor js -->
    <script src="{{asset('AdminSide/js/vendor.min.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('AdminSide/js/app.min.js')}}"></script>

</body>

</html>