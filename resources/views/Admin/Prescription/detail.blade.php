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
                        <p><b>Hello, {{$pescr->caserecord->patient->name}}</b></p>
                        <p class="text-muted">Thanks a lot because you keep purchasing our products. Our company
                            promises to provide high quality products for you as well as outstanding
                            customer service for every transaction. </p>
                    </div>

                </div><!-- end col -->
                <div class="col-4 offset-2">
                    <div class="mt-3 float-right">
                        <p class="mb-2"><strong>Date Created : </strong>{{date('m/d/Y', strtotime($pescr->created_at))}}</p>
                        <p class="mb-2"><strong>Prescription ID: </strong> #{{$pescr->id}}</p>
                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->

            <div class="row mt-3">
                <div class="col-6">
                    <h5>Patient</h5>

                    <address>
                        FullName : {{$pescr->caserecord->patient->name}}<br>
                        
                        @if(!empty($pescr->caserecord->patient->birthday))
                        Birthday : {{date('m/d/Y', strtotime($pescr->caserecord->patient->birthday))}}<br>
                        @endif

                        @if(!empty($pescr->caserecord->patient->phone))
                        Phone Number : {{$pescr->caserecord->patient->phone}}<br>
                        @endif

                        @if(!empty($pescr->caserecord->patient->email))
                        Email : {{$pescr->caserecord->patient->email}}<br>
                        @endif

                        @if(!empty($pescr->caserecord->patient->addres))
                        Address : {{$pescr->caserecord->patient->addres}}<br>
                        @endif

                    </address>

                </div>

                <div class="col-6">
                    <h5>Doctor </h5>

                    <address>
                    FullName : {{$pescr->caserecord->doctor->name}}<br>
                        
                        @if(!empty($pescr->caserecord->doctor->phone))
                        Phone Number : {{$pescr->caserecord->doctor->phone}}<br>
                        @endif

                        @if(!empty($pescr->caserecord->doctor->email))
                        Email : {{$pescr->caserecord->doctor->email}}<br>
                        @endif

                        @if(!empty($pescr->caserecord->doctor->addres))
                        Address : {{$pescr->caserecord->doctor->addres}}<br>
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
                                    $prescrs = \App\PrescriptionDetail::where(['prescription_id'=> $pescr->id])->get();
                                    $index = 1;
                                @endphp
                                
                               @foreach($prescrs as $prescr)
                                <tr>
                                    <td>{{$index}}</td>
                                    <td>
                                        <b>{{$prescr->medicine->name}}</b> 
                                    </td>
                                    <td>{{$prescr->quantity}}</td>
                                    <td>{!! html_entity_decode($prescr->medicine->dose) !!}</td>
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
                    <a href="#" class="btn btn-info waves-effect waves-light">Submit</a>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection