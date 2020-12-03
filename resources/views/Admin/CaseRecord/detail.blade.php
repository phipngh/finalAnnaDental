@extends('master.admin.master')

@section('style')
<link href="{{asset('AdminSide/libs/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('AdminSide/libs/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="{{asset('AdminSide/libs/sweetalert2/sweetalert2.min.css')}}">
<link rel="stylesheet" href="{{asset('UserSide/css/lightgallery.css')}}">

@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">AnnaDental</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.patient')}}">Patients</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.patient.detail',$caserecord->patient->id)}}">{{$caserecord->patient->name}}</a></li>
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li> -->
                    <li class="breadcrumb-item active">Case Record</li>
                </ol>
            </div>
            <h4 class="page-title">Patients Detail</h4>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12 text-center">
        <h4 class="text-capitalize">{{$caserecord->name}}</h4>
    </div>
</div>

<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12" id="testheight">
        <div class="card-box">
            <ul class="nav nav-tabs nav-bordered">
                <li class="nav-item">
                    <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                        Profile
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#settings-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                        Note
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="main-tab-content">
                <div class="tab-pane show active" id="profile-b1">
                    <div class="row">
                        <div class="col-12">
                            <div class="px-2">
                                <p>* Patient : <span class="text-uppercase">{{$caserecord->patient->name}}</span></p>
                                <p>* Doctor : <span class="text-uppercase">{{$caserecord->doctor->name}}</span></p>
                                <hr>
                                <p class="text-center ">Case : <span class="text-capitalize h4">{{$caserecord->name}}</span>
                                </p>
                                <p>* Total Fee : <span class="text-uppercase">$ {{$caserecord->total_fee}}</span></p>
                                @php
                                $IPn = \App\InstallmentPlan::where('case_record_id',$caserecord->id)->pluck('money')->sum();
                                @endphp
                                @if($caserecord->is_instalment_plant == 1)
                                <p>* Installment Plan : <span class="text-uppercase">$ <span id="ipn">{{$IPn}}</span> / $ {{$caserecord->total_fee}}</span></p>
                                @endif
                                <div class="row">
                                    @if($caserecord->is_active == 1)
                                    <span class="badge badge-success mx-2">ACTIVE</span>
                                    @else
                                    <span class="badge badge-warning mx-2">INACTIVE</span>
                                    @endif

                                    @if($caserecord->is_instalment_plant == 1)
                                    <span class="badge badge-warning mx-2">INSTALLMENT PLANT</span>
                                    @endif
                                </div>
                                <div class="row">
                                    @php
                                    $crdCount = \App\CaseRecordDetail::where('case_record_id',$caserecord->id)->count();
                                    @endphp
                                    <span class="badge badge-info m-2">Detail : {{$crdCount}}</span>

                                    @php
                                    $cripCount = \App\InstallmentPlan::where('case_record_id',$caserecord->id)->count();
                                    @endphp
                                    @if($caserecord->is_instalment_plant == 1)
                                    <span class="badge badge-info m-2">Installment Plan : {{$cripCount}}</span>
                                    @endif

                                    @php
                                    $crpsCount = \App\Process::where('case_record_id',$caserecord->id)->count();
                                    @endphp
                                    <span class="badge badge-info m-2">Prosessing : {{$crpsCount}}</span>

                                    @php
                                    $crpreCount = \App\Prescription::where('case_record_id',$caserecord->id)->count();
                                    @endphp
                                    <span class="badge badge-info m-2">Prescription : {{$crpreCount}}</span>

                                </div>
                            </div>
                            <button class="edit_create btn btn-sm btn-info float-right mr-2" id="{{$caserecord->id}}">Edit</button>

                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="settings-b1">
                    {!! html_entity_decode($caserecord->note) !!}
                </div>
                @if($caserecord->is_paied == 1)
                <div class="" style="z-index: 2;position: absolute; top: 10%;right: 10%; transform: rotate(0deg); ">
                    <!-- <h1 class="text-danger">CLOSED</h1> -->
                    <img style="position: relative; width: 320px;" src="{{url('upload/case_closed.png')}}" alt="">
                </div>
                @endif
            </div>

        </div>

        <div class="card-box">
            <h4 class="mb-3 header-title text-center">Description</h4>
            <form id="form_description" method="POST">
                @csrf
                <div class="form-group">
                    <textarea type="text" class="form-control" id="ckeditor1_cr" name="description_form_description"></textarea>
                </div>
                <input type="hidden" id="caserecord_id_description" name="caserecord_id_description" value="{{$caserecord->id}}">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-danger d-none" id="description_cancel">Cancel</button>
                    <button type="submit" class="btn btn-primary mx-1 d-none" id="description_submit">Submit</button>
                    <button type="button" class="btn btn-secondary" id="toggle">Enable</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-6">


        <!-- DATA TABLE TEST -->
        <div class="card-box">
            <a id="create_crDetail" name="create_crDetail" type="button" class="btn btn-primary float-right mx-2 mb-2 text-light width-md"> <i class="fas fa-plus"></i><span> &nbsp;Add New Detail</span></a>
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
                            <th style="width: 16%;">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="table-primary">
                            <th scope="">-</th>
                            <td class="font-weight-bold">Total</td>
                            <td></td>
                            <td></td>
                            @php
                            $total = 0;
                            $datas = \App\CaseRecordDetail::where('case_record_id',$caserecord->id)->get();
                            foreach($datas as $data)
                            $total += $data->service->price*$data->quantity;
                            @endphp

                            <td id="total" class="font-weight-bold">{{$total}}</td>
                            <td class="text-center"><a type="button" href="{{route('admin.caserecord.invoice',$caserecord->id)}}" name="edit_crDetail" id="" class="edit_crDetail btn btn-secondary btn-sm rounded"><i class="fas fa-file-invoice-dollar"></i></a></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>


        <div class="card-box">

            <a id="create_crProcess" name="create_crProcess" type="button" class="btn btn-primary float-right mx-2 mb-2 text-light width-md"> <i class="fas fa-plus"></i><span> &nbsp;Add New Detail</span></a>
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
                            <th style="width: 16%;">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        @if($caserecord->is_instalment_plant == 1)
        <div class="card-box">
            <a id="create_crIPlan" name="create_crIPlan" type="button" class="btn btn-primary float-right mx-2 mb-2 text-light width-md"> <i class="fas fa-plus"></i><span> &nbsp;Add New Detail</span></a>
            <h4 class="header-title text-center my-2">All Case Record Installment Plan</h4>
            <div class="table-responsive">
                <table id="crinstallment" class="table table-bordered dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 25%;">Date</th>
                            <th style="width: 15%;">Money</th>
                            <th>Note</th>
                            <th style="width: 16%;">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        @endif

        <div class="card-box">

            <a id="create_crPresc" name="create_crPresc" type="button" class="btn btn-primary float-right mx-2 mb-2 text-light width-md"> <i class="fas fa-plus"></i><span> &nbsp;Add New Prescription</span></a>
            <h4 class="header-title text-center my-2">All Case Record Prescription</h4>
            <div class="table-responsive">
                <table id="crprescription" class="table table-bordered dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="">Date</th>
                            <th style="width: 16%;">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>



    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="h3 text-center mb-3">Patient Processing Gallery</div>
    </div>

    @php
    $path = File::glob(public_path('/storage/files/1/CaseRecord/'.$caserecord->id).'/*') ;
    @endphp


    @if($path)
    <div class="col-12 bg-dark">
        <div id="lightgallery" class="my-3 mx-2">

            @foreach(File::glob(public_path('/storage/files/1/CaseRecord/'.$caserecord->id).'/*') as $path)
            @if(substr($path, 65) != 'thumbs')
            <a href="{{substr($path, 39)}}" class="">
                <img src="{{substr($path, 39)}}" style="height: 150px; padding: 5px;" class="rounded" />
            </a>
            @endif
            @endforeach
        </div>
    </div>
    @else
    <div class="col-12">
        <p class="text-center">There no photo for this process...</p>
    </div>
    
    @endif


</div>

<div class="row">
    <div class="col-12">

    </div>
</div>

<!-- CR Process -->
<!-- ------------------------ -->
<div id="crProcessModal" name="crProcessModal" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" style="overflow-y: initial !important;">
        <div class="modal-content">
            <form id="crProcessForm" method="POST">
                @csrf
                <div class="modal-header text-center">
                    <h4 class="modal-title_crProcess col-12 text-center" id="myExtraLargeModalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" style=" overflow-y: auto;">
                    <span id="form_result_Process"></span>
                    <div class="modal-append">
                        <!-- ----- -->
                        <div class="form-row form-group">
                            <div class="col-12">
                                <label>Title</label>
                                <input type="text" class="form-control" id="title_crProcess" name="title_crProcess" placeholder="Enter Title">
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <div class="col-md-6">
                                <label>Date</label>
                                <input type="datetime-local" class="form-control" id="schedule_date_crProcess" name="schedule_date_crProcess">
                            </div>
                            <div class="col-md-3">
                                <label>Duration</label>
                                <input type="text" class="form-control" id="duration_crProcess" name="duration_crProcess" placeholder="Enter Duration (Hour)">
                            </div>
                            <div class="col-md-3">
                                <label>Service</label>
                                <select class="custom-select" name="color_crProcess" id="color_crProcess" place>
                                    <option value="#348cd4" style="background-color: #348cd4;">Examination </option>
                                    <option value="#3ec396" style="background-color: #3ec396;">Checkup <span><i class="fas fa-square"></i></span></option>
                                    <option value="#4fbde9" style="background-color: #4fbde9;">Surgery <span><i class="fas fa-square"></i></span></option>
                                    <option value="#f9bc0b" style="background-color: #f9bc0b;">Correction <span><i class="fas fa-square"></i></span></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <div class="col-6">
                                <label>Description</label>
                                <textarea type="text" class="form-control" id="description_crProcess" name="description_crProcess" rows="2" placeholder="Enter Description"></textarea>
                            </div>
                            <div class="col-6">
                                <label>Note</label>
                                <textarea type="text" class="form-control" id="note_crProcess" name="note_crProcess" rows="2" placeholder="Enter Note"></textarea>
                            </div>
                        </div>


                        <!-- ----- -->
                    </div>
                    <input type="hidden" id="case_record_id_crProcess" name="case_record_id_crProcess" value="{{$caserecord->id}}">
                    <div class="modal-footer">
                        <input type="button" class="btn btn-danger" data-dismiss="modal" id="cancel_button" value="Cancel">
                        <input type="hidden" id="action_crProcess" name="action_crProcess" value="Add" />
                        <input type="hidden" id="hidden_id_crProcess" name="hidden_id_crProcess" />
                        <input type="submit" id="action_button_crProcess" name="action_button_crProcess" class="btn btn-success" value="Add">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--End  CR Process-->
<!-- CR Insallment Plans -->
<!-- ------------------------ -->
<div id="crIPlanModal" name="crIPlanModal" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" style="overflow-y: initial !important;">
        <div class="modal-content">
            <form id="crIPlanForm" method="POST">
                @csrf
                <div class="modal-header text-center">
                    <h4 class="modal-title_crIPlan col-12 text-center" id="myExtraLargeModalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" style=" overflow-y: auto;">
                    <span id="form_result_crIPlan"></span>
                    <div class="modal-append">
                        <!-- ----- -->
                        <div class="form-group form-row">
                            <div class="col-4">
                                <label>Money</label>
                                <input type="text" class="form-control" id="money_crIPlan" name="money_crIPlan" placeholder="Enter Money">
                            </div>
                            <div class="col-8">
                                <label>Note</label>
                                <textarea type="text" class="form-control" id="note_crIPlan" name="note_crIPlan" rows="1" placeholder="Enter Note"></textarea>
                            </div>
                        </div>
                        <!-- ----- -->
                    </div>
                    <input type="hidden" id="case_record_id_crIPlan" name="case_record_id_crIPlan" value="{{$caserecord->id}}">
                    <div class="modal-footer">
                        <input type="button" class="btn btn-danger" data-dismiss="modal" id="cancel_button" value="Cancel">
                        <input type="hidden" id="action_crIPlan" name="action_crIPlan" value="Add" />
                        <input type="hidden" id="hidden_id_crIPlan" name="hidden_id_crIPlan" />
                        <input type="submit" id="action_button_crIPlan" name="action_button_crIPlan" class="btn btn-success" value="Add">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--End  CR Installment Plans -->
<!-- CR Detail -->
<!-- ------------------------ -->
<div id="crDetailModal" name="crDetailModal" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" style="overflow-y: initial !important;">
        <div class="modal-content">
            <form id="crDetailForm" method="POST">
                @csrf
                <div class="modal-header text-center">
                    <h4 class="modal-title_crDetail col-12 text-center" id="myExtraLargeModalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" style=" overflow-y: auto;">
                    <span id="form_result_crDetail"></span>
                    <div class="modal-append">
                        <!-- ----- -->
                        <div class="form-group form-row">
                            <div class="col-4">
                                <label>Service</label>
                                <select class="custom-select" name="service_id_crDetail" id="service_id_crDetail" place>
                                    @foreach($services as $service )
                                    <option value="{{$service->id}}">${{$service->price}}-{{$service->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <label for="">Quantity</label>
                                <input type="text" class="form-control" id="quantity_crDetail" name="quantity_crDetail" placeholder="Enter Quantity">
                            </div>
                            <div class="col-6">
                                <label>Note</label>
                                <textarea type="text" class="form-control" id="note_crDetail" name="note_crDetail" rows="1" placeholder="Enter Note"></textarea>
                            </div>
                        </div>
                        <!-- ----- -->
                    </div>
                    <input type="hidden" id="case_record_id_crDetail" name="case_record_id_crDetail" value="{{$caserecord->id}}">
                    <div class="modal-footer">
                        <input type="button" class="btn btn-danger" data-dismiss="modal" id="cancel_button" value="Cancel">
                        <input type="hidden" id="action_crDetail" name="action_crDetail" value="Add" />
                        <input type="hidden" id="hidden_id_crDetail" name="hidden_id_crDetail" />
                        <input type="submit" id="action_button_crDetail" name="action_button_crDetail" class="btn btn-success" value="Add">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--End  CR Detail -->
<!-- CR Detail -->
<!-- ------------------------ -->
<div id="crPrescModal" name="crPrescModal" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" style="overflow-y: initial !important;">
        <div class="modal-content">
            <form id="crPrescForm" method="POST">
                @csrf
                <div class="modal-header text-center">
                    <h4 class="modal-title_crPresc col-12 text-center" id="myExtraLargeModalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" style=" overflow-y: auto;">
                    <span id="form_result_crPresc"></span>
                    <!-- ----- -->
                    <div class="Apeendform" id="Apeendform">

                    </div>
                    <input type="hidden" id="case_record_id_crPresc" name="case_record_id_crPresc" value="{{$caserecord->id}}">
                    <div class="modal-footer">
                        <input type="button" class="btn btn-danger" data-dismiss="modal" id="cancel_button" value="Cancel">
                        <input type="hidden" id="action_crPresc" name="action_crPresc" value="Add" />
                        <input type="hidden" id="hidden_id_crPresc" name="hidden_id_crPresc" />
                        <input type="submit" id="action_button_crPresc" name="action_button_crPresc" class="btn btn-success" value="Add">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--End  CR Detail -->
<!-- ------------------------ -->
<div id="createModal" name="createModal" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="overflow-y: initial !important;">
        <div class="modal-content">
            <form id="create_form" method="POST">
                @csrf
                <div class="modal-header text-center">
                    <h4 class="modal-title_create col-12 text-center" id="myExtraLargeModalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" style=" overflow-y: auto;">
                    <span id="form_create_result"></span>
                    <div class="form-group form-row">
                        <div class="col-6">
                            <label>Name</label>
                            <input type="text" class="form-control" id="name_create" name="name_create" placeholder="Enter Patient Name">
                        </div>
                        <div class="col-6">
                            <label>Dortor</label>
                            <select class="custom-select" name="doctor_id_create" id="doctor_id_create" place>
                                @foreach($doctors as $doctor )
                                <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <!-- <div class="col-6">
                            <label>Description</label>
                            <textarea type="text" class="form-control" id="ckeditor1_cr" name="description_create" placeholder="Enter Patient Info" rows="6"></textarea>
                        </div> -->
                        <div class="col-12">
                            <label>Note</label>
                            <textarea type="text" class="form-control" id="ckeditor2_cr" name="note_create" placeholder="Enter Patient Note" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="form-row my-3">
                        <div class="col-sm-4 text-center  checkbox checkbox-info">
                            <input type="checkbox" class="form-check-input" id="is_instalment_plan_create" name="is_instalment_plan_create" {{ old('is_instalment_plan_create') ? 'checked="checked"' : '' }} onclick="myFunction()">
                            <label class="form-check-label" for="exampleCheck1">Instalment Plan</label>
                        </div>

                        <div class="col-sm-4 text-center  checkbox checkbox-info">
                            <input type="checkbox" class="form-check-input" id="is_paid_create" name="is_paid_create" {{ old('is_paid_create') ? 'checked="checked"' : '' }}>
                            <label class="form-check-label" for="exampleCheck1">Paid</label>
                        </div>


                        <!-- <div class="col-sm-4 text-center">
                            <input type="checkbox" class="form-check-input" id="is_done_create" name="is_done_create" {{ old('is_done_create') ? 'checked="checked"' : '' }} disabled>
                            <label class="form-check-label" for="exampleCheck1">Done</label>
                        </div> -->

                    </div>

                    <input type="hidden" id="caserecord_id_create" name="caserecord_id_create" value="{{$caserecord->id}}">
                    <input type="hidden" id="patient_id_create" name="patient_id_create" value="{{$caserecord->patient_id}}">

                    <div class="modal-footer">
                        <input type="button" class="btn btn-danger" data-dismiss="modal" id="cancel_button_create" value="Cancel">
                        <input type="hidden" id="action_create" name="action_create" value="Add" />
                        <input type="hidden" id="hidden_id_create" name="hidden_id_create" />
                        <input type="submit" id="action_button_create" name="action_button_create" class="btn btn-success" value="Add">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




<!-- ------------ -->
@endsection
@section('script')
<script src="{{asset('AdminSide/libs/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('AdminSide/libs/datatables/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{asset('https://cdn.datatables.net/v/dt/b-1.6.5/datatables.min.js')}}"></script>

<script src="{{asset('AdminSide/libs/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('AdminSide/libs/datatables/responsive.bootstrap4.min.js')}}"></script>

<script src="{{asset('AdminSide/libs/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{ asset('AdminSide/libs/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('UserSide/js/lightgallery.js') }}"></script>
<script src="{{ asset('UserSide/js/lg-thumbnail.js') }}"></script>
<script src="{{ asset('UserSide/js/lg-fullscreen.js') }}"></script>


<script>
    $(document).ready(function() {

    });
</script>
<!-- installment Plan -->
<script>
    $(document).ready(function() {


    });
</script>
<!--End crDetail -->

<!-- installment Plan -->

<!--End crDetail -->
<!-- crDetail -->
<script>
    $(document).ready(function() {
        // $(document).ready(function() {
        //     $('#create_crDetail').click(function() {
        //         $('#action_button_crDetail').val('Add');
        //         $('#action_crDetail').val('Add');
        //         $('#form_result_crDetail').html('');
        //         $('#note_crDetail').val('');
        //         $('#quantity_crDetail').val(1);

        //         // $('#slug').val('');
        //         $('.modal-title_crDetail').text('Case Record Detail');
        //         $('#crDetailModal').modal('show');
        //     });
        // });
        // $('#cancel_button').click(function() {
        //     if ($('#action_crDetail').val() == 'Edit') {
        //         Swal.fire({
        //             title: "Cancelled",
        //             text: "Your data is safe :)",
        //             type: "error",
        //             position: "center",
        //             showConfirmButton: !1,
        //             timer: 1500,
        //         })
        //     }
        // });

        // $('#crDetailForm').on('submit', function(event) {
        //     event.preventDefault();
        //     var action_url = '';

        //     if ($('#action_crDetail').val() == 'Add') {
        //         action_url = "{{ route('admin.caserecorddetail.store') }}";
        //     }

        //     if ($('#action_crDetail').val() == 'Edit') {
        //         action_url = "{{ route('admin.caserecorddetail.update') }}";
        //     }
        //     $.ajax({

        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         url: action_url,
        //         method: "POST",
        //         data: $(this).serialize(),
        //         // data: $("form[name='formModal']").serialize(),
        //         dataType: "json",
        //         success: function(data) {
        //             var html = '';
        //             if (data.errors) {
        //                 html = '<div class="alert alert-danger">';
        //                 for (var count = 0; count < data.errors.length; count++) {
        //                     html += '<p>' + data.errors[count] + '</p>';
        //                 }
        //                 html += '</div>';
        //             }
        //             if (data.success) {
        //                 console.log(data.dataa);
        //                 setTimeout(window.location.reload.bind(window.location), 1000);
        //                 Swal.fire({
        //                     position: "top",
        //                     type: "success",
        //                     title: "Your data has been saved",
        //                     showConfirmButton: !1,
        //                     timer: 1500
        //                 });
        //                 $('#crDetailForm')[0].reset();

        //                 if ($('#action_crDetail').val() == 'Edit') {
        //                     $('#crDetailModal').modal('hide');
        //                 }
        //             }
        //             $('#form_result_crDetail').html(html);


        //         }
        //     });
        // });


        // $(document).on('click', '.edit_crDetail', function() {
        //     var id = $(this).attr('id');
        //     $.ajax({
        //         url: "/admin/caserecorddetail/" + id + "/edit",
        //         dataType: "json",
        //         success: function(data) {
        //             $('#service_id_crDetail').val(data.result.service_id);
        //             $('#note_crDetail').val(data.result.note);
        //             $('#quantity_crDetail').val(data.result.quantity);
        //             $('#hidden_id_crDetail').val(id);
        //             $('.modal-title_crDetail').text('Edit CRDetail');
        //             // $('.modal-title').text('Edit Record');
        //             $('#action_button_crDetail').val('Edit');
        //             $('#action_crDetail').val('Edit');
        //             $('#crDetailModal').modal('show');
        //         }
        //     })
        // });

        // var id;
        // $(document).on('click', '.delete_crDetail', function() {
        //     id = $(this).attr('id');
        //     Swal.fire({
        //         title: "Are you sure?",
        //         text: "You won't be able to revert this!",
        //         type: "warning",
        //         showCancelButton: !0,
        //         confirmButtonText: "Yes, delete it!",
        //         cancelButtonText: "No, cancel!",
        //         confirmButtonClass: "btn btn-success mt-2",
        //         cancelButtonClass: "btn btn-danger ml-2 mt-2",
        //         buttonsStyling: !1
        //     }).then(function(t) {
        //         if (t.value) {
        //             $.ajax({
        //                 url: "/admin/caserecorddetail/destroy/" + id,
        //                 success: function(data) {
        //                     setTimeout(window.location.reload.bind(window.location), 1000);
        //                 }
        //             });
        //             Swal.fire({
        //                 title: "Deleted!",
        //                 text: "Your file has been deleted.",
        //                 type: "success",
        //                 timer: 1500,
        //                 showConfirmButton: !1,
        //             });
        //         } else {
        //             t.dismiss === Swal.DismissReason.cancel && Swal.fire({
        //                 title: "Cancelled",
        //                 text: "Your data is safe :)",
        //                 type: "error",
        //                 timer: 1500,
        //                 showConfirmButton: !1,
        //             })
        //         }
        //     })
        // });
    });
</script>
<!--End crDetail -->
<script>
    $(document).ready(function() {

        var description_form = {
            !!json_encode($caserecord - > description) !!
        };
        CKEDITOR.instances.ckeditor1_cr.setData(description_form);

        $(function() {
            $('button#toggle').click(function() {
                if (CKEDITOR.instances.ckeditor1_cr.readOnly == true) {
                    CKEDITOR.instances.ckeditor1_cr.setReadOnly(false);
                    $('#description_submit').removeClass("d-none");
                    $('#description_cancel').removeClass("d-none");
                    $('#toggle').text('Disable');
                } else {
                    CKEDITOR.instances.ckeditor1_cr.setReadOnly(true);
                    $('#description_submit').addClass("d-none");
                    $('#description_cancel').addClass("d-none");
                    $('#toggle').text('Enable');
                }

            });
        });

        $('#description_cancel').click(function() {
            Swal.fire({
                title: "Cancelled",
                text: "Your data is safe :)",
                type: "error",
                position: "center",
                showConfirmButton: !1,
                timer: 1500,
            });
            CKEDITOR.instances.ckeditor1_cr.setReadOnly(true);
            $('#description_submit').addClass("d-none");
            $('#description_cancel').addClass("d-none");
            $('#toggle').text('Enable');
            CKEDITOR.instances.ckeditor1_cr.setData(description_form);
        });

        $('#form_description').on('submit', function(event) {
            event.preventDefault();

            var caserecord_id = document.getElementById('caserecord_id_description').value;

            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/admin/caserecord/" + caserecord_id + "/update/description",
                method: "POST",
                data: $(this).serialize(),
                // data: $("form[name='formModal']").serialize(),
                dataType: "json",

                success: function(data) {
                    var html = '';

                    if (data.success) {
                        Swal.fire({
                            position: "top",
                            type: "success",
                            title: "Your data has been saved",
                            showConfirmButton: !1,
                            timer: 1500
                        });
                        CKEDITOR.instances.ckeditor1_cr.setData(data.result.description);
                        $('#description_submit').addClass("d-none");
                        $('#description_cancel').addClass("d-none");
                        $('#toggle').text('Enable');
                        CKEDITOR.instances.ckeditor1_cr.setReadOnly(true);
                    }

                }
            });
        });

    });
</script>
<script>
    CKEDITOR.replace('ckeditor1_cr', {
        height: 350,
        readOnly: true,
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    });
    CKEDITOR.replace('ckeditor2_cr', {
        height: 150
    });
</script>

<script>
    $(document).ready(function() {
        // New case record-------------------


        $('#cancel_button_create').click(function() {
            if ($('#action_create').val() == 'Edit') {
                Swal.fire({
                    title: "Cancelled",
                    text: "Your data is safe :)",
                    type: "error",
                    position: "center",
                    showConfirmButton: !1,
                    timer: 1500,
                })
            }
        });

        $('#create_form').on('submit', function(event) {
            event.preventDefault();
            var action_url = '';
            var caserecord_id = document.getElementById('caserecord_id_create').value;

            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/admin/caserecord/" + caserecord_id + "/update",
                method: "POST",
                data: $(this).serialize(),
                // data: $("form[name='formModal']").serialize(),
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

                        setTimeout(window.location.reload.bind(window.location), 1000);
                        $('#create_form')[0].reset();
                        //CKEDITOR.instances.ckeditor1_cr.setData("");
                        CKEDITOR.instances.ckeditor2_cr.setData("");


                        if ($('#action_create').val() == 'Edit') {
                            $('#createModal').modal('hide');
                        }
                    }
                    $('#form_create_result').html(html);
                }
            });
        });


        //---------------------------------

        $(document).on('click', '.edit_create', function() {
            var id = $(this).attr('id');

            $('#form_create_result').html('');
            $.ajax({
                url: "/admin/caserecord/" + id + "/edit",
                dataType: "json",
                success: function(data) {

                    $('#name_create').val(data.result.name);
                    $('#doctor_id_create').val(data.result.doctor_id);
                    // $('#is_instalment_plan_create').val(data.result.is_instalment_plant);
                    if (data.result.is_instalment_plant == 1) {
                        $('#is_instalment_plan_create').prop('checked', true);
                    } else {
                        $('#is_instalment_plan_create').prop('checked', false);
                    }

                    if (data.result.is_paied == 1) {
                        $('#is_paid_create').prop('checked', true);
                    } else {
                        $('#is_paid_create').prop('checked', false);
                    }

                    // if(data.result.is_active == 0){
                    //     $('#is_done_create').prop('checked', true);
                    // }else{
                    //     $('#is_done_create').prop('checked', false);
                    // }
                    //CKEDITOR.instances.ckeditor1_cr.setData(data.result.description);
                    CKEDITOR.instances.ckeditor2_cr.setData(data.result.note);
                    //$('#description').val(data.result.description);
                    // $('#slug').val(data.result.slug);
                    $('#hidden_id_create').val(id);
                    $('.modal-title_create').text('Case Record');
                    // $('.modal-title').text('Edit Record');
                    $('#action_button_create').val('Edit');
                    $('#action_create').val('Edit');
                    $('#createModal').modal('show');
                }
            })
        });

    });
</script>
<script>
    var maxHeight = 0;
    $("#main-tab-content .tab-pane").each(function() {
        $(this).addClass("active");
        var height = $(this).height();
        maxHeight = height > maxHeight ? height : maxHeight;
        $(this).removeClass("active");
    });
    $("#main-tab-content .tab-pane:first").addClass("active");
    $("#profile-b1,#messages-b1,#settings-b1").height(maxHeight);
</script>








<!-- DATA TABLE FOR ALL TABLE TEST START HERE -->

<!-- CASE RECORD DETAIL -->
<script>
    $(document).ready(function() {
        var id = {
            {
                $caserecord - > id
            }
        };
        $('#crdetail').DataTable({
            searching: false,
            paging: true,
            info: false,
            lengthChange: false,
            pageLength: 5,
            processing: true,
            serverSide: true,
            ajax: {
                url: "/admin/crdetail/" + id,
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'service_id',
                    name: 'service_id'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'quantity',
                    name: 'quantity'
                },
                {
                    data: 'note',
                    name: 'note'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                },
            ],
        }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");

        $(document).ready(function() {
            $('#create_crDetail').click(function() {
                $('#action_button_crDetail').val('Add');
                $('#action_crDetail').val('Add');
                $('#form_result_crDetail').html('');
                $('#note_crDetail').val('');
                $('#quantity_crDetail').val(1);
                $('.modal-title_crDetail').text('Case Record Detail');
                $('#crDetailModal').modal('show');
            });
        });
        $('#cancel_button').click(function() {
            if ($('#action_crDetail').val() == 'Edit') {
                Swal.fre({
                    title: "Cancelled",
                    text: "Your data is safe :)",
                    type: "error",
                    position: "center",
                    showConfirmButton: !1,
                    timer: 1500,
                })
            }
        });

        $('#crDetailForm').on('submit', function(event) {
            event.preventDefault();
            var action_url = '';

            if ($('#action_crDetail').val() == 'Add') {
                action_url = "{{ route('admin.caserecorddetail.store') }}";
            }

            if ($('#action_crDetail').val() == 'Edit') {
                action_url = "{{ route('admin.caserecorddetail.update') }}";
            }
            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: action_url,
                method: "POST",
                data: $(this).serialize(),
                // data: $("form[name='formModal']").serialize(),
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
                        $('#crdetail').DataTable().ajax.reload();
                        $('#crDetailForm')[0].reset();

                        if ($('#action_crDetail').val() == 'Edit') {
                            $('#crDetailModal').modal('hide');
                        }
                        $('#total').html(data.total);
                        console.log(data.total);
                    }
                    $('#form_result_crDetail').html(html);


                }
            });
        });


        $(document).on('click', '.edit_crDetail', function() {
            var id = $(this).attr('id');
            $.ajax({
                url: "/admin/caserecorddetail/" + id + "/edit",
                dataType: "json",
                success: function(data) {
                    $('#service_id_crDetail').val(data.result.service_id);
                    $('#note_crDetail').val(data.result.note);
                    $('#quantity_crDetail').val(data.result.quantity);
                    $('#hidden_id_crDetail').val(id);
                    $('.modal-title_crDetail').text('Edit CRDetail');
                    // $('.modal-title').text('Edit Record');
                    $('#action_button_crDetail').val('Edit');
                    $('#action_crDetail').val('Edit');
                    $('#crDetailModal').modal('show');
                }
            })
        });

        var id;
        $(document).on('click', '.delete_crDetail', function() {
            id = $(this).attr('id');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-success mt-2",
                cancelButtonClass: "btn btn-danger ml-2 mt-2",
                buttonsStyling: !1
            }).then(function(t) {
                if (t.value) {
                    $.ajax({
                        url: "/admin/caserecorddetail/destroy/" + id,
                        success: function(data) {
                            $('#crdetail').DataTable().ajax.reload();
                            $('#total').html(data.total);
                        }
                    });
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        type: "success",
                        timer: 1500,
                        showConfirmButton: !1,
                    });
                } else {
                    t.dismiss === Swal.DismissReason.cancel && Swal.fire({
                        title: "Cancelled",
                        text: "Your data is safe :)",
                        type: "error",
                        timer: 1500,
                        showConfirmButton: !1,
                    })
                }
            })
        });


    });
</script>

<script>
    $(document).ready(function() {
        var id = {
            {
                $caserecord - > id
            }
        };
        $('#crinstallment').DataTable({
            searching: false,
            paging: true,
            info: false,
            lengthChange: false,
            pageLength: 5,
            processing: true,
            serverSide: true,
            ajax: {
                url: "/admin/crinstallment/" + id,
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'money',
                    name: 'money'
                },
                {
                    data: 'note',
                    name: 'note'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                },
            ],
        }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");

        $('#create_crIPlan').click(function() {
            $('#action_button_crIPlan').val('Add');
            $('#action_crIPlan').val('Add');
            $('#form_result_crIPlan').html('');
            $('#note_crIPlan').val('');
            $('#money_crIPlan').val('');
            $('.modal-title_crIPlan').text('Case Record Installment Plan');
            $('#crIPlanModal').modal('show');
        });

        $('#cancel_button').click(function() {
            if ($('#action_crIPlan').val() == 'Edit') {
                Swal.fire({
                    title: "Cancelled",
                    text: "Your data is safe :)",
                    type: "error",
                    position: "center",
                    showConfirmButton: !1,
                    timer: 1500,
                })
            }
        });

        $('#crIPlanForm').on('submit', function(event) {
            event.preventDefault();
            var action_url = '';

            if ($('#action_crIPlan').val() == 'Add') {
                action_url = "{{ route('admin.installmentplan.store') }}";
            }

            if ($('#action_crIPlan').val() == 'Edit') {
                action_url = "{{ route('admin.installmentplan.update') }}";
            }
            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: action_url,
                method: "POST",
                data: $(this).serialize(),
                // data: $("form[name='formModal']").serialize(),
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
                        console.log(data.dataa);

                        Swal.fire({
                            position: "top",
                            type: "success",
                            title: "Your data has been saved",
                            showConfirmButton: !1,
                            timer: 1500
                        });
                        $('#crinstallment').DataTable().ajax.reload();
                        $('#crIPlanForm')[0].reset();
                        $('#ipn').html(data.data);


                        $('#crIPlanModal').modal('hide');

                    }
                    $('#form_result_crIPlan').html(html);

                }
            });
        });

        $(document).on('click', '.edit_crIPlan', function() {
            var id = $(this).attr('id');
            $.ajax({
                url: "/admin/installmentplan/" + id + "/edit",
                dataType: "json",
                success: function(data) {
                    $('#money_crIPlan').val(data.result.money);
                    $('#note_crIPlan').val(data.result.note);
                    $('#hidden_id_crIPlan').val(id);
                    $('.modal-title_crIPlan').text('Edit Installment Plan');
                    // $('.modal-title').text('Edit Record');
                    $('#action_button_crIPlan').val('Edit');
                    $('#action_crIPlan').val('Edit');
                    $('#crIPlanModal').modal('show');
                }
            })
        });

        var id;
        $(document).on('click', '.delete_crIPlan', function() {
            id = $(this).attr('id');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-success mt-2",
                cancelButtonClass: "btn btn-danger ml-2 mt-2",
                buttonsStyling: !1
            }).then(function(t) {
                if (t.value) {
                    $.ajax({
                        url: "/admin/installmentplan/destroy/" + id,
                        success: function(data) {
                            $('#crinstallment').DataTable().ajax.reload();
                            $('#ipn').html(data.data);
                        }
                    });
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        type: "success",
                        timer: 1500,
                        showConfirmButton: !1,
                    });
                } else {
                    t.dismiss === Swal.DismissReason.cancel && Swal.fire({
                        title: "Cancelled",
                        text: "Your data is safe :)",
                        type: "error",
                        timer: 1500,
                        showConfirmButton: !1,
                    })
                }
            })
        });
    });
</script>

<script>
    $(document).ready(function() {
        var id = {
            {
                $caserecord - > id
            }
        };
        $('#crprocess').DataTable({
            searching: false,
            paging: true,
            info: false,
            lengthChange: false,
            pageLength: 5,
            processing: true,
            serverSide: true,
            ajax: {
                url: "/admin/crprocess/" + id,
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'title',
                    name: 'titile'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'time',
                    name: 'time'
                },
                {
                    data: 'duration',
                    name: 'duration'
                },
                {
                    data: 'note',
                    name: 'note'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                },
            ],
        }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");

        $('#create_crProcess').click(function() {
            $('#action_button_crProcess').val('Add');
            $('#action_crProcess').val('Add');
            $('#form_result_crProcess').html('');
            $('#note_crProcess').val('');
            $('#description_crProcess').val('');
            $('#title_crProcess').val('');
            $('#duration_crProcess').val('');
            $('#schedule_date_crProcess').val('');

            // $('#slug').val('');
            $('.modal-title_crProcess').text('Case Record Installment Plan');
            $('#crProcessModal').modal('show');
        });

        $('#cancel_button').click(function() {
            if ($('#action_crProcess').val() == 'Edit') {
                Swal.fire({
                    title: "Cancelled",
                    text: "Your data is safe :)",
                    type: "error",
                    position: "center",
                    showConfirmButton: !1,
                    timer: 1500,
                })
            }
        });

        $('#crProcessForm').on('submit', function(event) {
            event.preventDefault();
            var action_url = '';

            if ($('#action_crProcess').val() == 'Add') {
                action_url = "{{ route('admin.process.store') }}";
            }

            if ($('#action_crProcess').val() == 'Edit') {
                action_url = "{{ route('admin.process.update') }}";
            }
            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: action_url,
                method: "POST",
                data: $(this).serialize(),
                // data: $("form[name='formModal']").serialize(),
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
                        console.log(data.dataa);
                        Swal.fire({
                            position: "top",
                            type: "success",
                            title: "Your data has been saved",
                            showConfirmButton: !1,
                            timer: 1500
                        });
                        $('#crprocess').DataTable().ajax.reload();
                        $('#crProcessForm')[0].reset();


                        $('#crProcessModal').modal('hide');

                    }
                    $('#form_result_Process').html(html);

                }
            });
        });


        $(document).on('click', '.edit_crProcess', function() {
            var id = $(this).attr('id');
            $.ajax({
                url: "/admin/process/" + id + "/edit",
                dataType: "json",
                success: function(data) {
                    $('#title_crProcess').val(data.result.title);
                    $('#description_crProcess').val(data.result.description);
                    $('#note_crProcess').val(data.result.note);
                    var newdates = new Date(data.result.schedule_date.toString().split('GMT')[0] + ' UTC').toISOString().split('.')[0];
                    $('#schedule_date_crProcess').val(newdates);
                    $('#duration_crProcess').val(data.result.duration);
                    $('#hidden_id_crProcess').val(id);
                    $('.modal-title_crProcess').text('Edit Process');
                    // $('.modal-title').text('Edit Record');
                    $('#action_button_crProcess').val('Edit');
                    $('#action_crProcess').val('Edit');
                    $('#crProcessModal').modal('show');
                }
            })
        });

        var id;
        $(document).on('click', '.delete_crProcess', function() {
            id = $(this).attr('id');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-success mt-2",
                cancelButtonClass: "btn btn-danger ml-2 mt-2",
                buttonsStyling: !1
            }).then(function(t) {
                if (t.value) {
                    $.ajax({
                        url: "/admin/process/destroy/" + id,
                        success: function(data) {
                            $('#crprocess').DataTable().ajax.reload();
                        }
                    });
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        type: "success",
                        timer: 1500,
                        showConfirmButton: !1,
                    });
                } else {
                    t.dismiss === Swal.DismissReason.cancel && Swal.fire({
                        title: "Cancelled",
                        text: "Your data is safe :)",
                        type: "error",
                        timer: 1500,
                        showConfirmButton: !1,
                    })
                }
            })
        });

    });
</script>

<script>
    $(document).ready(function() {
        var id = {
            {
                $caserecord - > id
            }
        };
        $('#crprescription').DataTable({
            searching: false,
            paging: true,
            info: false,
            lengthChange: false,
            pageLength: 5,
            processing: true,
            serverSide: true,
            ajax: {
                url: "/admin/crprescription/" + id,
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                },
            ],
        }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");

        function dynamic_field(number) {
            html = '<div class="form-group form-row" id="medicineAdd">';
            html += '<div class="col-6">';
            html += '<label>Service</label>';
            html += '<select class="custom-select" name="Pmedicine[]" id="service_id_crPresc">';
            html += '@foreach($medicines as $medicine )';
            html += '<option value="{{$medicine->id}}">{{$medicine->name}}</option>';
            html += '@endforeach';
            html += '</select>';
            html += '</div>';
            html += '<div class="col-4">';
            html += '<label>Quantity</label>';
            html += '<input type="text" id="" name="Pquantity[]" placeholder="Quantity" class="form-control">';
            html += '</div>';
            html += '<div class="col-2">';
            html += '<label for="">Action</label>';
            if (number > 1) {
                html += '<a id="removeRow" type="button" class="btn btn-danger form-control text-white">Remove Row</a></div></div>';
                $('#Apeendform').append(html);
            } else {
                html += '<a id="addRow" type="button" class="btn btn-success form-control text-white">Add Row</a></div></div>';
                $('#Apeendform').html(html);
            }
        }

        $(document).on('click', '#addRow', function() {
            count++;
            dynamic_field(count);
        });

        $(document).on('click', '#removeRow', function() {
            count--;
            $(this).closest("#medicineAdd").remove();
        });


        $('#create_crPresc').click(function() {
            count = 1;
            dynamic_field(count);
            $('#action_button_crPresc').val('Add');
            $('#action_crPresc').val('Add');
            $('#form_result_crPresc').html('');
            $('#note_crPresc').val('');
            // $('#slug').val('');
            $('.modal-title_crPresc').text('Case Record Prescription');
            $('#crPrescModal').modal('show');
        });


        $('#crPrescForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '{{ route("admin.presciption.store") }}',
                method: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('#action_button_crPresc').attr('disabled', 'disabled');
                },
                success: function(data) {
                    if (data.error) {
                        var error_html = '';
                        for (var count = 0; count < data.error.length; count++) {
                            error_html += '<p>' + data.error[count] + '</p>';
                        }
                        $('#form_result_crPresc').html('<div class="alert alert-danger">' + error_html + '</div>');
                    } else {
                        dynamic_field(1);
                        $('#form_result_crPresc').html('<div class="alert alert-success">' + data.success + '</div>');
                        $('#crprescription').DataTable().ajax.reload();
                    }
                    $('#action_button_crPresc').attr('disabled', false);
                }
            })
        });

        var id;
        $(document).on('click', '.delete_pre', function() {
            id = $(this).attr('id');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-success mt-2",
                cancelButtonClass: "btn btn-danger ml-2 mt-2",
                buttonsStyling: !1
            }).then(function(t) {
                if (t.value) {
                    $.ajax({
                        url: "/admin/prescription/destroy/" + id,
                        success: function(data) {
                            $('#crprescription').DataTable().ajax.reload();
                        }
                    });
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        type: "success",
                        timer: 1500,
                        showConfirmButton: !1,
                    });
                } else {
                    t.dismiss === Swal.DismissReason.cancel && Swal.fire({
                        title: "Cancelled",
                        text: "Your data is safe :)",
                        type: "error",
                        timer: 1500,
                        showConfirmButton: !1,
                    })
                }
            })
        });
    });
</script>
<script type="text/javascript">
    lightGallery(document.getElementById('lightgallery'));
</script>

@endsection