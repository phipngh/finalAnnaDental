<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Abstack - Responsive Bootstrap 4 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('AdminSide/images/favicon.ico')}}">

    <!-- App css -->


    <!-- Addition Style -->
    @yield('style')
    <!-- End Addition Style -->
    <link href="{{asset('AdminSide/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('AdminSide/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('AdminSide/css/app.min.css')}}" rel="stylesheet" type="text/css" />
</head>

<body>

    <div id="wrapper">






        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    <!-- start page title -->



                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                            
                                <div class="clearfix">
                                    
                                    <div class="float-left">
                                        <img src="{{asset('AdminSide/images/logo-dark.png')}}" alt="" height="18">
                                    </div>
                                    <div class="float-right">
                                        <h4 class="m-0 d-print-none">Invoice</h4>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-6">
                                        <div class="float-left mt-3">
                                            <p><b>Hello, {{$presc->caserecord->patient->name}}</b></p>
                                            <p class="text-muted">Thanks a lot because you keep purchasing our products. Our company
                                                promises to provide high quality products for you as well as outstanding
                                                customer service for every transaction. </p>
                                        </div>

                                    </div><!-- end col -->
                                    <div class="col-4 offset-2">
                                        <div class="mt-3 float-right">
                                            <p class="mb-2"><strong>Date Created : </strong>{{date('m/d/Y', strtotime($presc->created_at))}}</p>
                                            <p class="mb-2"><strong>Prescription ID: </strong> #{{$presc->id}}</p>
                                        </div>
                                    </div><!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="row mt-3">
                                    <div class="col-6">
                                        <h5>Patient</h5>

                                        <address>
                                            FullName : {{$presc->caserecord->patient->name}}<br>
                                            id : {{$presc->case_record_id}}<br>

                                            @if(!empty($presc->caserecord->patient->birthday))
                                            Birthday : {{date('m/d/Y', strtotime($presc->caserecord->patient->birthday))}}<br>
                                            @endif

                                            @if(!empty($presc->caserecord->patient->phone))
                                            Phone Number : {{$presc->caserecord->patient->phone}}<br>
                                            @endif

                                            @if(!empty($presc->caserecord->patient->email))
                                            Email : {{$presc->caserecord->patient->email}}<br>
                                            @endif

                                            @if(!empty($presc->caserecord->patient->addres))
                                            Address : {{$presc->caserecord->patient->addres}}<br>
                                            @endif

                                        </address>

                                    </div>

                                    <div class="col-6">
                                        <h5>Doctor </h5>

                                        <address>
                                            FullName : {{$presc->caserecord->doctor->name}}<br>

                                            @if(!empty($presc->caserecord->doctor->phone))
                                            Phone Number : {{$presc->caserecord->doctor->phone}}<br>
                                            @endif

                                            @if(!empty($presc->caserecord->doctor->email))
                                            Email : {{$presc->caserecord->doctor->email}}<br>
                                            @endif

                                            @if(!empty($presc->caserecord->doctor->addres))
                                            Address : {{$presc->caserecord->doctor->addres}}<br>
                                            @endif
                                        </address>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table mt-4">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Medicine</th>
                                                        <th>Quantity</th>
                                                        <th>Description</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $prescs = \App\PrescriptionDetail::where(['prescription_id'=> $presc->id])->get();
                                                    $index = 1;
                                                    @endphp

                                                    @foreach($prescs as $presc)
                                                    <tr>
                                                        <td>{{$index}}</td>
                                                        <td>
                                                            <b>{{$presc->medicine->name}}</b>
                                                        </td>
                                                        <td>{{$presc->quantity}}</td>
                                                        <td>{!! html_entity_decode($presc->medicine->dose) !!}</td>
                                                    </tr>
                                                    @php
                                                    $index++;
                                                    @endphp
                                                    @endforeach


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="clearfix pt-4">
                                            <h5 class="text-muted">Notes:</h5>

                                            <small>
                                                All accounts are to be paid within 7 days from receipt of
                                                invoice. To be paid by cheque or credit card or direct payment
                                                online. If account is not paid within 7 days the credits details
                                                supplied as confirmation of work undertaken will be charged the
                                                agreed quoted fee noted above.
                                            </small>
                                        </div>

                                    </div>
                                    <div class="col-6">
                                        <div class="float-right">

                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                                <div class="hidden-print mt-4 mb-4">
                                    
                                    <div class="text-right d-print-none">
                                        <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="fa fa-print mr-1"></i> Print</a>
                                    </div>
                                </div>
                                
                            </div>

                        </div>

                    </div>

                    <!-- end page title -->
                </div> <!-- end container-fluid -->
            </div> <!-- end content -->
        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
    </div>

    <script src="{{asset('AdminSide/js/vendor.min.js')}}"></script>
    <script src="{{asset('AdminSide/js/app.min.js')}}"></script>

</body>

</html>