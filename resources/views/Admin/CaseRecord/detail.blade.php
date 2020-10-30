@extends('master.admin.master')

@section('style')
<link rel="stylesheet" href="{{asset('AdminSide/libs/sweetalert2/sweetalert2.min.css')}}">
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">AnnaDental</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.patient')}}">Patients</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.patient')}}">Patients</a></li>
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li> -->
                    <li class="breadcrumb-item active">Case Record</li>
                </ol>
            </div>
            <h4 class="page-title">Patients Detail</h4>
        </div>
    </div>
</div>


<div class="row mb-2">
    <div class="col-md-12 text-center">
        <h4>{{$caserecord->name}}</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card " id="card">
            <div class="px-3 mt-2">
                <span class="badge badge-success float-right">Active</span>
                <h4>{{$caserecord->name}}</h4>
            </div>
            <div class="card-body" style="font-size: 1.1rem;">
                <p>Patient : {{$caserecord->patient->name}}</p>
                <p>Doctor : {{$caserecord->doctor->name}}</p>
                <p>Total Fee : $ {{$caserecord->total_fee}}</p>
                @if($caserecord->is_paied == 0)
                <span class="badge badge-warning">Unpaid</span>
                @else
                <span class="badge badge-success">Paid</span>
                @endif

                @if($caserecord->is_instalment_plan == 1)
                <span class="badge badge-warning">Instalment Plan</span>
                @endif
                <br>
                <button class="edit_create btn btn-sm btn-info float-right mt-4 mr-2" id="{{$caserecord->id}}">Edit</button>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card-box" id="main-card-box">
            <ul class="nav nav-tabs nav-bordered nav-justified">
                <li class="nav-item">
                    <a href="#desbox" data-toggle="tab" aria-expanded="true" class="nav-link active">
                        Description
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#notebox" data-toggle="tab" aria-expanded="false" class="nav-link">
                        Note
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="main-tab-content">
                <div class="tab-pane active" id="desbox">
                    {!! html_entity_decode($caserecord->description) !!}
                </div>
                <div class="tab-pane" id="notebox">
                    {!! html_entity_decode($caserecord->note) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<hr class="border border-primary">
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="header-title mb-4">Tabs Vertical Left</h4>

            <div class="row">
                <div class="col-sm-2">
                    <div class="nav flex-column nav-pills nav-pills-tab" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link mb-2 active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                            Detail
                        </a>
                        <a class="nav-link mb-2" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                            Processing
                        </a>
                        @if($caserecord->is_instalment_plant == 1)
                        <a class="nav-link mb-2" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                            Instalment Plan
                        </a>
                        @endif

                    </div>
                </div> <!-- end col-->
                <div class="col-sm-10">
                    <div class="tab-content pt-0" id="below-tab-content">
                        <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            @if($crds->count() > 0 )

                            <div class="card-box">
                                <a id="create_crDetail" name="create_crDetail" type="button" class="btn btn-primary float-right mx-2 mb-2 text-light width-md"> <i class="fas fa-plus"></i><span> &nbsp;Add New Detail</span></a>
                                <h4 class="header-title text-center my-2">All Case Record Detail</h4>
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">#</th>
                                                <th style="width: 25%;">Service</th>
                                                <th style="width: 15%;">Price</th>
                                                <th>Note</th>
                                                <th style="width: 15%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @php
                                            $index = 1;
                                            $total = 0;
                                            @endphp

                                            @foreach($crds as $crd)
                                            <tr>
                                                <th scope="row">{{$index}}</th>
                                                <td>{{$crd->service->name}}</td>
                                                <td>{{$crd->service->price}}</td>
                                                <td>{{$crd->note}}</td>
                                                <td>
                                                    <button type="button" name="edit_crDetail" id="{{$crd->id}}" class="edit_crDetail btn btn-info btn-sm rounded">Edit</button>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <button type="button" name="delete_crDetail" id="{{$crd->id}}" class="delete_crDetail btn btn-danger btn-sm rounded">Delete</button>
                                                </td>
                                            </tr>
                                            @php
                                            $index++;
                                            $total += $crd->service->price;
                                            @endphp

                                            @endforeach
                                            <tr class="table-primary">
                                                <th scope="">---</th>
                                                <td class="font-weight-bold">Total</td>
                                                <td class="font-weight-bold">{{$total}}</td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @else
                            <div class="col-12 text-center">
                                <p>Theres no detail recorded.</p>
                                <a id="create_crDetail" name="create_crDetail" type="button" class="btn btn-primary mx-2 mb-2 text-light width-md"> <i class="fas fa-plus"></i><span> &nbsp;Add New Detail</span></a>

                            </div>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            @if($crps->count() > 0 )

                            <div class="card-box">
                                <a id="create_crProcess" name="create_crProcess" type="button" class="btn btn-primary float-right mx-2 mb-2 text-light width-md"> <i class="fas fa-plus"></i><span> &nbsp;Add New Detail</span></a>
                                <h4 class="header-title text-center my-2">All Case Record Installment Plan</h4>
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">#</th>
                                                <th style="width: 25%;">Title</th>
                                                <th style="width: 10%;">Date</th>
                                                <th style="width: 10%;">Time</th>
                                                <th style="width: 10%;">Description</th>
                                                <th>Note</th>
                                                <th style="width: 15%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @php
                                            $index = 1;

                                            @endphp

                                            @foreach($crps as $crp)
                                            <tr>
                                                <th scope="row">{{$index}}</th>
                                                <td>{{$crp->title}}</td>
                                                <td>{{$crp->schedule_date}}</td>
                                                <td>{{$crp->schedule_time}}</td>
                                                <td>{{$crp->description}}</td>
                                                <td>{{$crp->note}}</td>

                                                <td>
                                                    <button type="button" name="edit_crProcess" id="{{$crp->id}}" class="edit_crProcess btn btn-info btn-sm rounded">Edit</button>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <button type="button" name="delete_crProcess" id="{{$crp->id}}" class="delete_crProcess btn btn-danger btn-sm rounded">Delete</button>
                                                </td>
                                            </tr>
                                            @php
                                            $index++;

                                            @endphp

                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @else
                            <div class="col-12 text-center">
                                <p>Theres no process recorded.</p>
                                <a id="create_crProcess" name="create_crProcess" type="button" class="btn btn-primary mx-2 mb-2 text-light width-md"> <i class="fas fa-plus"></i><span> &nbsp;Add New Process</span></a>

                            </div>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                            @if($crips->count() > 0 )

                            <div class="card-box">
                                <a id="create_crIPlan" name="create_crIPlan" type="button" class="btn btn-primary float-right mx-2 mb-2 text-light width-md"> <i class="fas fa-plus"></i><span> &nbsp;Add New Detail</span></a>
                                <h4 class="header-title text-center my-2">All Case Record Installment Plan</h4>
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">#</th>
                                                <th style="width: 25%;">Date</th>
                                                <th style="width: 15%;">Money</th>
                                                <th>Note</th>
                                                <th style="width: 15%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @php
                                            $index = 1;
                                            $total = 0;
                                            @endphp

                                            @foreach($crips as $crip)
                                            <tr>
                                                <th scope="row">{{$index}}</th>
                                                <td>{{$crip->created_at}}</td>
                                                <td>{{$crip->money}}</td>
                                                <td>
                                                    @if($crip->note != NULL)
                                                    {{$crip->note}}
                                                    @endif

                                                </td>
                                                <td>
                                                    <button type="button" name="edit_crIPlan" id="{{$crip->id}}" class="edit_crIPlan btn btn-info btn-sm rounded">Edit</button>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <button type="button" name="delete_crIPlan" id="{{$crip->id}}" class="delete_crIPlan btn btn-danger btn-sm rounded">Delete</button>
                                                </td>
                                            </tr>
                                            @php
                                            $index++;
                                            $total += $crip->money;
                                            @endphp

                                            @endforeach
                                            <tr class="table-primary">
                                                <th scope="">---</th>
                                                <td class="font-weight-bold">Total</td>
                                                <td class="font-weight-bold">{{$total}}</td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @else
                            <div class="col-12 text-center">
                                <p>Theres no installment plan recorded.</p>
                                <a id="create_crIPlan" name="create_crIPlan" type="button" class="btn btn-primary mx-2 mb-2 text-light width-md"> <i class="fas fa-plus"></i><span> &nbsp;Add New Plan</span></a>

                            </div>
                            @endif
                        </div>
                    </div>
                </div> <!-- end col-->
            </div>
        </div>
    </div> <!-- end col -->

    <!-- end col -->
</div>

<hr>

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
                                <input type="text" class="form-control" id="title_crProcess" name="title_crProcess" placeholder="Enter Money">
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <div class="col-md-6">
                                <label>Date</label>
                                <input type="date" class="form-control" id="schedule_date_crProcess" name="schedule_date_crProcess">
                            </div>
                            <div class="col-md-6">
                                <label>Time</label>
                                <input type="time" class="form-control" id="schedule_time_crProcess" name="schedule_time_crProcess">
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <div class="col-6">
                                <label>Description</label>
                                <textarea type="text" class="form-control" id="description_crProcess" name="description_crProcess" rows="2" placeholder="Enter Patient Name"></textarea>
                            </div>
                            <div class="col-6">
                                <label>Note</label>
                                <textarea type="text" class="form-control" id="note_crProcess" name="note_crProcess" rows="2" placeholder="Enter Patient Name"></textarea>
                            </div>
                        </div>


                        <!-- ----- -->
                    </div>
                    <input type="hidden" id="case_record_id_crProcess" name="case_record_id_crProcess" value="{{$caserecord->id}}">
                    <div class="modal-footer">
                        <input type="button" class="btn btn-danger" data-dismiss="modal" id="cancel_button" value="Cancel">
                        <input type="hidden" id="action_crProcess" name="action_crProcess" value="Add" />
                        <input type="hidden" id="hidden_crProcess" name="hidden_crProcess" />
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
                                <textarea type="text" class="form-control" id="note_crIPlan" name="note_crIPlan" rows="1" placeholder="Enter Patient Name"></textarea>
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
                                    <option value="{{$service->id}}">{{$service->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-8">
                                <label>Note</label>
                                <textarea type="text" class="form-control" id="note_crDetail" name="note_crDetail" rows="1" placeholder="Enter Patient Name"></textarea>
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
                        <div class="col-6">
                            <label>Description</label>
                            <textarea type="text" class="form-control" id="ckeditor1_cr" name="description_create" placeholder="Enter Patient Info" rows="6"></textarea>
                        </div>
                        <div class="col-6">
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
<script src="{{asset('AdminSide/libs/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{ asset('AdminSide/libs/ckeditor/ckeditor.js') }}"></script>
<!-- installment Plan -->
<script>
    $(document).ready(function() {
        $(document).ready(function() {
            $('#create_crProcess').click(function() {
                $('#action_button_crProcess').val('Add');
                $('#action_crProcess').val('Add');
                $('#form_result_crProcess').html('');
                $('#note_crProcess').val('');
                $('#description_crProcess').val('');
                $('#title_crProcess').val('');
                $('#schedule_time_crProcess').val('');
                $('#schedule_date_crProcess').val('');

                // $('#slug').val('');
                $('.modal-title_crProcess').text('Case Record Installment Plan');
                $('#crProcessModal').modal('show');
            });
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
                        //-----
                        setTimeout(window.location.reload.bind(window.location), 1000);

                        //-----



                        Swal.fire({
                            position: "top",
                            type: "success",
                            title: "Your data has been saved",
                            showConfirmButton: !1,
                            timer: 1500
                        });
                        $('#crProcessForm')[0].reset();

                        if ($('#action_crProcess').val() == 'Edit') {
                            $('#crProcessModal').modal('hide');
                        }
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
                    $('#schedule_date_crProcess').val(data.result.schedule_date);
                    $('#schedule_time_crProcess').val(data.result.schedule_time);
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
                            setTimeout(window.location.reload.bind(window.location), 1000);
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
<!--End crDetail -->

<!-- installment Plan -->
<script>
    $(document).ready(function() {
        $(document).ready(function() {
            $('#create_crIPlan').click(function() {
                $('#action_button_crIPlan').val('Add');
                $('#action_crIPlan').val('Add');
                $('#form_result_crIPlan').html('');
                $('#note_crIPlan').val('');
                $('#money_crIPlan').val('');
                // $('#slug').val('');
                $('.modal-title_crIPlan').text('Case Record Installment Plan');
                $('#crIPlanModal').modal('show');
            });
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
                        //-----
                        setTimeout(window.location.reload.bind(window.location), 1000);

                        //-----



                        Swal.fire({
                            position: "top",
                            type: "success",
                            title: "Your data has been saved",
                            showConfirmButton: !1,
                            timer: 1500
                        });
                        $('#crIPlanForm')[0].reset();

                        if ($('#action_crIPlan').val() == 'Edit') {
                            $('#crIPlanModal').modal('hide');
                        }
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
                            setTimeout(window.location.reload.bind(window.location), 1000);
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
<!--End crDetail -->
<!-- crDetail -->
<script>
    $(document).ready(function() {
        $(document).ready(function() {
            $('#create_crDetail').click(function() {
                $('#action_button_crDetail').val('Add');
                $('#action_crDetail').val('Add');
                $('#form_result_crDetail').html('');
                $('#note_crDetail').val('');
                // $('#slug').val('');
                $('.modal-title_crDetail').text('Case Record Detail');
                $('#crDetailModal').modal('show');
            });
        });
        $('#cancel_button').click(function() {
            if ($('#action_crDetail').val() == 'Edit') {
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
                    if (data.success) {
                        console.log(data.dataa);
                        setTimeout(window.location.reload.bind(window.location), 1000);
                        Swal.fire({
                            position: "top",
                            type: "success",
                            title: "Your data has been saved",
                            showConfirmButton: !1,
                            timer: 1500
                        });
                        $('#crDetailForm')[0].reset();

                        if ($('#action_crDetail').val() == 'Edit') {
                            $('#crDetailModal').modal('hide');
                        }
                    }

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
                            setTimeout(window.location.reload.bind(window.location), 1000);
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
<!--End crDetail -->
<script>
    CKEDITOR.replace('ckeditor1_cr', {
        height: 150
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
                        CKEDITOR.instances.ckeditor1_cr.setData("");
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
                    CKEDITOR.instances.ckeditor1_cr.setData(data.result.description);
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
    $("#desbox,#notebox").height(190);
</script>

<script>
    var maxHeight = 0;
    $("#below-tab-content .tab-pane").each(function() {
        $(this).addClass("active");
        var height = $(this).height();
        maxHeight = height > maxHeight ? height : maxHeight;
        $(this).removeClass("active");
    });
    $("#below-tab-content .tab-pane:first").addClass("active");
    $("#v-pills-home,#v-pills-profile,#v-pills-messages").height(maxHeight);
</script>
<!-- <script>
    var maxHeight = 0;
    $(".tab-content .tab-pane").each(function() {
        $(this).addClass("active");
        var height = $(this).height();
        maxHeight = height > maxHeight ? height : maxHeight;
        $(this).removeClass("active");
    });
    $(".tab-content .tab-pane:first").addClass("active");
    $(".card-box").height(254);
    $(".card").height(300);
</script> -->
@endsection