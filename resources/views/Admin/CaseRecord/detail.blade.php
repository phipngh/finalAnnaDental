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
                <p>Toatal Fee : Null</p>
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
        <div class="card-box">
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
                            Detail</a>
                        <a class="nav-link mb-2" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                            Processing</a>
                        <a class="nav-link mb-2" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                            Instalment Plan</a>

                    </div>
                </div> <!-- end col-->
                <div class="col-sm-10">
                    <div class="tab-content pt-0">
                        <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                            <p class="mb-0">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                        </div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                            <p class="mb-0">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                        </div>
                    </div>
                </div> <!-- end col-->
            </div>
        </div>
    </div> <!-- end col -->

    <!-- end col -->
</div>

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
    $("#desbox,#notebox").height(maxHeight);
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