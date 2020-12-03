@extends('master.user.master')

@section('content')

<div id="overlay"></div>

<br><br><br><br>

<div class="row">
    <div class="col-md-12 text-center">
        <h4 class="text-capitalize mb-3">{{$caserecord->name}}</h4>
    </div>
</div>

<div class="row mx-3">
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 p-2" id="testheight">
        <div class="card-box p-2  rounded border {{$caserecord->is_paied == 1 ? 'border-danger' : 'border-success'}}">
            <ul class="nav nav-tabs nav-bordered">
                <li class="nav-item">
                    <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link active primary">
                        Profile
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="main-tab-content">
                <div class="tab-pane show active" id="profile-b1">
                    <div class="row">
                        <div class="col-12">
                            <div class="px-2 text-dark">
                                <p>* Patient : <span class="text-uppercase">{{$caserecord->patient->name}}</span></p>
                                <p>* Patient : <span class="text-uppercase">{{$caserecord->patient->phone}}</span></p>
                                <p>* Patient : <span class="">{{$caserecord->patient->email}}</span></p>
                                <p>* Total Fee : <span class="text-uppercase">$ {{$caserecord->total_fee}}</span></p>
                                <hr class="{{$caserecord->is_paied == 1 ? 'bg-danger' : 'bg-success'}}">
                                <p>* Doctor : <span class="text-uppercase">{{$caserecord->doctor->name}}</span></p>
                                <p>* Doctor : <span class="text-uppercase">{{$caserecord->doctor->phone}}</span></p>
                                <p>* Doctor : <span class="">{{$caserecord->doctor->email}}</span></p>
                            </div>

                        </div>
                    </div>
                </div>
                @if($caserecord->is_paied == 1)
                <div class="" style="z-index: 2;position: absolute; top: 10%;right: 10%; transform: rotate(0deg); ">
                    <!-- <h1 class="text-danger">CLOSED</h1> -->
                    <img style="position: relative; width: 220px;" src="{{url('upload/case_closed.png')}}" alt="">
                </div>
                @endif
            </div>

        </div>



    </div>

    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 p-2 ">


        <!-- DATA TABLE TEST -->
        <div class="card-box">
            <h4 class="header-title text-center">All Case Record Detail</h4>
            <div class="table-responsive">
                <table id="crdetail" class="table  table-bordered dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 25%;">Service</th>
                            <th style="width: 5%;">Price</th>
                            <th style="width: 3%;">Quantity</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $index=1;
                        @endphp
                        @foreach($crds as $crd)

                        <tr>
                            <td>{{$index}}</td>
                            <td>{{$crd->service->name}}</td>
                            <td>{{$crd->service->price}}</td>
                            <td>{{$crd->quantity}}</td>
                            <td>{{$crd->note}}</td>
                        </tr>
                        @php
                        $index++;
                        @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-primary">
                            <th scope="">-</th>
                            <td class="font-weight-bold">Total</td>
                            @php
                            $total = 0;
                            $datas = \App\CaseRecordDetail::where('case_record_id',$caserecord->id)->get();
                            foreach($datas as $data)
                            $total += $data->service->price*$data->quantity;
                            @endphp
                            <td id="total" class="font-weight-bold">{{$total}}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <hr>
        <div class="card-box">

            <h4 class="header-title text-center my-2">All Case Record Processing Plan</h4>
            <div class="table-responsive">
                <table id="crprocess" class="table table-bordered dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 20%;">Title</th>
                            <th style="width: 20%;">Date</th>
                            <th style="width: 15%;">Time</th>
                            <th style="width: 10%;">Duration</th>
                            <th>Note</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $index=1;
                        @endphp
                        @foreach($crps as $crp)

                        <tr>
                            <td>{{$index}}</td>
                            <td>{{$crp->title}}</td>
                            <td>{{date('d-m-Y', strtotime($crp->schedule_date))}}</td>
                            <td>{{date('H:i', strtotime($crp->schedule_date))}}</td>
                            <td>{{$crp->duration}}</td>
                            <td>{{$crp->note}}</td>

                        </tr>
                        @php
                        $index++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if($caserecord->is_instalment_plant == 1)
        <hr>
        <div class="card-box">
            <h4 class="header-title text-center my-2">All Case Record Installment Plan</h4>
            <div class="table-responsive">
                <table id="crinstallment" class="table table-bordered dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 25%;">Date</th>
                            <th style="width: 15%;">Money</th>
                            <th>Note</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $index=1;
                        @endphp
                        @foreach($crips as $crip)

                        <tr>
                            <td>{{$index}}</td>
                            <td>{{date('d-m-Y', strtotime($crip->created_at))}}</td>
                            <td>{{$crip->money}}</td>
                            <td>{{$crip->note}}</td>
                            
                        </tr>
                        @php
                        $index++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        <hr>
        <div class="card-box">

            <h4 class="header-title text-center my-2">All Case Record Prescription</h4>
            <div class="table-responsive">
                <table id="crprescription" class="table table-bordered dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="">Date</th>
                            <th style="width: 10%;">#</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $index=1;
                        @endphp
                        @foreach($crprs as $crpr)

                        <tr>
                            <td>{{$index}}</td>
                            <td>{{date('d-m-Y', strtotime($crpr->created_at))}}</td>
                            <td><a type="button" href="/presc/{{$crpr->id}}" name="edit" id="{{$crpr->id}}" class="edit btn btn-dark btn-sm rounded"><i class="far fa-edit"></i></a></td>
                            
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
</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

@endsection

@section('script')

@endsection