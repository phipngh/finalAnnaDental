@extends('master.admin.master')

@section('content')
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
                        <p><b>Hello, {{$caserecord->patient->name}}</b></p>
                        <p class="text-muted">Thanks a lot because you keep purchasing our products. Our company
                            promises to provide high quality products for you as well as outstanding
                            customer service for every transaction. </p>
                    </div>

                </div><!-- end col -->
                <div class="col-4 offset-2">
                    <div class="mt-3 float-right">
                        <p class="mb-2"><strong>Date Created : </strong>{{Carbon\Carbon::now()->format('m-d-Y')}}</p>
                        <p class="mb-2"><strong>Time Created : </strong>{{Carbon\Carbon::now()->format('H:m')}}</p>
                        <p class="mb-2"><strong>Case ID: </strong> #{{$caserecord->id}}</p>
                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->

            <div class="row mt-3">
                <div class="col-6">
                    <h5>Patient</h5>

                    <address>
                        FullName : {{$caserecord->patient->name}}<br>

                        @if(!empty($caserecord->patient->birthday))
                        Birthday : {{date('m/d/Y', strtotime($caserecord->patient->birthday))}}<br>
                        @endif

                        @if(!empty($caserecord->patient->phone))
                        Phone Number : {{$caserecord->patient->phone}}<br>
                        @endif

                        @if(!empty($caserecord->patient->email))
                        Email : {{$caserecord->patient->email}}<br>
                        @endif

                        @if(!empty($caserecord->patient->addres))
                        Address : {{$caserecord->patient->addres}}<br>
                        @endif

                    </address>

                </div>

                <div class="col-6">
                    <h5>Doctor </h5>

                    <address>
                        FullName : {{$caserecord->doctor->name}}<br>

                        @if(!empty($caserecord->doctor->phone))
                        Phone Number : {{$caserecord->doctor->phone}}<br>
                        @endif

                        @if(!empty($caserecord->doctor->email))
                        Email : {{$caserecord->doctor->email}}<br>
                        @endif

                        @if(!empty($caserecord->doctor->addres))
                        Address : {{$caserecord->doctor->addres}}<br>
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
                                    <th>Service</th>
                                    <th>Unit Cost</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $crs = \App\CaseRecordDetail::where(['case_record_id'=> $caserecord->id])->get();
                                $index = 1;
                                @endphp

                                @foreach($crs as $cr)
                                <tr>
                                    <td>{{$index}}</td>
                                    <td>
                                        <b>{{$cr->service->name}}</b>
                                    </td>
                                    <td>$ {{$cr->service->price}}</td>
                                    <td>{{$cr->quantity}}</td>
                                    <td>{{$cr->quantity*$cr->service->price }}</td>

                                </tr>
                                @php
                                $index++;
                                @endphp
                                @endforeach
                                <br>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total : </td>
                                    <td>{{$caserecord->total_fee}}</td>
                                </tr>


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
@endsection