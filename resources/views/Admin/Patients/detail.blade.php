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
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li> -->
                    <li class="breadcrumb-item active">{{$patient->name}}</li>
                </ol>
            </div>
            <h4 class="page-title">Patients Detail</h4>
        </div>
    </div>
</div>

<div class="row mb-2">
    <div class="col-md-12">
        <a type="button" name="create_caserecord" id="create_caserecord" class="btn btn-primary float-right text-light width-md"> <i class="fas fa-plus"></i><span> &nbsp;Add New Case Record</span></a>
        <h4>{{ $patient->name}}'s Profile</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-3 order-lg-1 text-center">
        <img src="/upload/{{$patient->image}}" class="mx-auto img-fluid img-circle d-block img-thumbnail w-75" alt="avatar">
    </div>

    <div class="col-md-9">
        <div class="card-box">
            <ul class="nav nav-tabs nav-bordered nav-justified">
                <li class="nav-item">
                    <a href="#home-b2" data-toggle="tab" aria-expanded="true" class="nav-link active">
                        Patient Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#profile-b2" data-toggle="tab" aria-expanded="false" class="nav-link">
                        Info
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#messages-b2" data-toggle="tab" aria-expanded="false" class="nav-link">
                        Note
                    </a>
                </li>
            </ul>
            <div class="tab-content" style="overflow-y: initial !important;">
                <div class="tab-pane active" id="home-b2">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Name</h5>
                            <p class="ml-4 h4 text-primary">
                                {{$patient->name}}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h5>Birthday</h5>
                            <p class="ml-4 h4 text-primary">
                                <!-- {{$patient->birthday}} -->
                                @if($patient->birthday)
                                {{date('d-m-Y', strtotime($patient->birthday))}}
                                
                                
                                @endif
                            </p>
                        </div>


                        <div class="col-md-6">
                            <h5>Email</h5>
                            <p class="ml-4 h4 text-primary">
                                {{$patient->email}}
                            </p>
                        </div>
                        <div class="col-md-6">

                            <h5>Phone</h5>
                            <p class="ml-4 h4 text-primary">
                                {{$patient->phone}}
                            </p>
                        </div>

                        <div class="col-md-6">
                            <h5>Sex</h5>
                            <p class="ml-4 h4 text-primary">
                                {{$patient->sex}}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h5>Address</h5>
                            <p class="ml-4 h4 text-primary">
                                {{$patient->address}}
                            </p>
                        </div>
                    </div>

                </div>
                <div class="tab-pane" id="profile-b2">
                    {!! html_entity_decode($patient->info) !!}
                </div>
                <div class="tab-pane" id="messages-b2">
                    {!! html_entity_decode($patient->note) !!}
                </div>
            </div>
        </div>
        <button type="button" name="edit" id="{{$patient->id}}" class="edit btn btn-secondary btn-sm rounded float-right px-3"><i class="far fa-edit"></i></button>
    </div>
</div>

<div class="row" id="caseRecordList">
    <div class="col-md-12">
        <h4 class="mb-4">{{ $patient->name}}'s Case Record</h4>
    </div>
    @foreach($caserecords as $caserecord)
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card border {{$caserecord->is_paied == 0 ? 'border-success' : 'border-danger'}} ">
            <div class="card-header bg-white">
                @if($caserecord->is_paied == 0)
                <span class="badge badge-success float-right">Active</span>
                @else
                <span class="badge badge-danger float-right">Closed</span>
                @endif
                <a href="{{route('admin.caserecord.detail',$caserecord->id)}}" class="{{$caserecord->is_paied == 0 ? 'text-success' : 'text-danger'}} my-3">
                    <h5 class="card-title text-uppercase">{{$caserecord->name}}</h5>
                </a>
                <h6 class="ml-3 card-subtitle text-muted">By {{$caserecord->doctor->name}}</h6>
            </div>
            <hr class="{{$caserecord->is_paied == 0 ? 'border-success' : 'border-danger'}} ">
            <div class="card-body" style="z-index: 1;">
                <p>Day Created : {{date('m-d-Y', strtotime($caserecord->created_at))}}</p>
                <p>Last Updated : {{date('m-d-Y', strtotime($caserecord->updated_at))}}</p>

                @if($caserecord->is_paied == 0)
                <span class="badge badge-warning">Unpaid</span>
                @else
                <span class="badge badge-success">Paid</span>
                @endif

                @if($caserecord->is_instalment_plan == 1)
                <span class="badge badge-warning">Instalment Plan</span>
                @endif

                @php
                $crdCount = \App\CaseRecordDetail::where('case_record_id',$caserecord->id)->count();
                @endphp
                <span class="badge badge-info">{{$crdCount}}</span>
                <br>
                <button type="button" name="edit_create" id="{{$caserecord->id}}" class="edit_create btn btn-success btn-sm rounded float-right px-2 "><i class="far fa-edit"></i></button>
                <button type="button" name="delete_create" id="{{$caserecord->id}}" class="delete_create btn btn-danger btn-sm rounded float-right px-2 mx-1"><i class="fas fa-trash"></i></button>
            </div>

            @if($caserecord->is_paied == 1)
            <div class="" style="z-index: 2;position: absolute; top: 40%;right: 10%; transform: rotate(0deg); ">
                <!-- <h1 class="text-danger">CLOSED</h1> -->
                <img style="position: relative; width: 120px;" src="{{url('upload/case_closed.png')}}" alt="">
            </div>
            @endif
        </div>
    </div>
    @endforeach

</div>
<br>
<hr>
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
                            <input type="text" class="form-control" id="name_create" name="name_create" placeholder="Enter Case Record Name">
                        </div>
                        <div class="col-6">
                            <label>Dortor</label>
                            <select class="custom-select" name="doctor_id_create" id="doctor_id_create" place>
                                @foreach($doctors as $doctor )
                                <option value="{{$doctor->id}}">Dr. {{$doctor->name}}</option>
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

                    <input type="hidden" id="patient_id_create" name="patient_id_create" value="{{$patient->id}}">

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

<div id="formModal" name="formModal" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="overflow-y: initial !important;">
        <div class="modal-content">
            <form id="sample_form" method="POST">
                @csrf
                <div class="modal-header text-center">
                    <h4 class="modal-title col-12 text-center" id="myExtraLargeModalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body"  style="
    overflow-y: auto;">
                    <span id="form_result"></span>
                    <div class="form-group form-row">
                        <div class="col-3 text-center">
                            <img src="" style="width: 75px;" class="rounded-circle" id="image_show" alt="">
                            <input type="file" class="" id="image" name="image" placeholder="Enter Doctor Image">
                        </div>
                        <div class="col-6">
                            <label>Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Patient Name">
                        </div>
                        <div class="col-3">
                            <label>Phone Number</label>
                            <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter Patient Phone Number">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label>Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Patient Email">
                        </div>
                        <div class="col">
                            <label>Gender</label>
                            <select class="custom-select" name="sex" id="sex" place>
                                <option disabled selected>Select Patient Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Unknown">Unknown</option>
                            </select>
                        </div>
                        <div class="col">
                            <label>Birthday</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" placeholder="Enter Patient Birthday">
                        </div>
                    </div>
                    <div class="mt-2 form-row">
                        <div class="col-12">
                            <label>Address</label>
                            <textarea class="form-control mb-1" name="address" id="address" rows="2" placeholder="Enter Patient Address"></textarea>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-6">
                            <label>Info</label>
                            <textarea type="text" class="form-control" id="info" name="info" placeholder="Enter Patient Info" rows="4"></textarea>
                        </div>
                        <div class="col-6">
                            <label>Note</label>
                            <textarea type="text" class="form-control" id="note" name="note" placeholder="Enter Patient Note" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-danger" data-dismiss="modal" id="cancel_button" value="Cancel">
                        <input type="hidden" id="action" name="action" value="Add" />
                        <input type="hidden" id="hidden_id" name="hidden_id" />
                        <input type="submit" id="action_button" name="action_button" class="btn btn-success" value="Add">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

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
        function filePreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    //$('#formModal + #image_show').remove();
                    $('#image_show').attr('src', e.target.result);

                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image").change(function() {
            filePreview(this);
        });
        

        $(document).on('click', '.edit', function() {
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url: "/admin/patient/" + id + "/edit",
                dataType: "json",
                success: function(data) {
                    $('#name').val(data.result.name);
                    var imgurl = "{{url('upload')}}" + "/" + data.result.image;
                    $('#birthday').val(data.result.birthday);
                    $('#sex').val(data.result.sex);
                    $('#email').val(data.result.email);
                    $('#info').val(data.result.info);
                    $('#note').val(data.result.note);
                    $('#phone').val(data.result.phone);
                    $('#address').val(data.result.address);
                    $('#image_show').attr('src', imgurl);

                    
                    //$('#description').val(data.result.description);
                    // $('#slug').val(data.result.slug);
                    $('#hidden_id').val(id);
                    $('.modal-title').text('Services');
                    // $('.modal-title').text('Edit Record');
                    $('#action_button').val('Edit');
                    $('#action').val('Edit');
                    $('#formModal').modal('show');
                }
            })
        });

        $('#sample_form').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData($(this)[0]);
            var id = $(this).attr('id');

            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/admin/patient/" + id + "/update",
                method: "POST",
                //data: $(this).serialize(),
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,

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
                        // html = '<div class="alert alert-success">' + data.success + '</div>';
                        // $('#sample_form')[0].reset();
                        // $('#catelogy_table').DataTable().ajax.reload();

                        Swal.fire({
                            position: "top",
                            type: "success",
                            title: "Your data has been saved",
                            showConfirmButton: !1,
                            timer: 1500
                        });

                        setTimeout(function() {
                            location.reload();
                        }, 1000);


                        if ($('#action').val() == 'Edit') {
                            $('#formModal').modal('hide');
                        }
                    }
                    $('#form_result').html(html);
                }
            });
        });


        $('#cancel_button').click(function() {
            if ($('#action').val() == 'Edit') {
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



    });
</script>

<script>
    $(document).ready(function() {
        // New case record-------------------
        $('#create_caserecord').click(function() {

            $('#action_button_create').val('Add');
            $('#action_create').val('Add');
            $('#form_create_result').html('');
            $('#name_create').val('');
            $('#doctor_id_create').val(1);
            CKEDITOR.instances.ckeditor1_cr.setData("");
            CKEDITOR.instances.ckeditor2_cr.setData("");
            $('#is_instalment_plan_create').prop('checked', false);
            $('#is_paid_create').prop('checked', false);
            // $('#slug').val('');
            $('.modal-title_create').text('Case Record');
            $('#createModal').modal('show');
        });

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
            var patient_id = document.getElementById('patient_id_create').value;
            if ($('#action_create').val() == 'Add') {
                action_url = "{{ route('admin.caserecord.store') }}";
            }

            if ($('#action_create').val() == 'Edit') {
                action_url = "{{ route('admin.caserecord.update') }}";
            }

            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
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


        var caseRecord_id;
        $(document).on('click', '.delete_create', function() {
            caseRecord_id = $(this).attr('id');
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
                        url: "/admin/caserecord/destroy/" + caseRecord_id,
                        success: function(data) {

                            setTimeout(window.location.reload.bind(window.location), 750);

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
    var maxHeight = 0;
    $(".tab-content .tab-pane").each(function() {
        $(this).addClass("active");
        var height = $(this).height();
        maxHeight = height > maxHeight ? height : maxHeight;
        $(this).removeClass("active");
    });
    $(".tab-content .tab-pane:first").addClass("active");
    $(".tab-content").height(maxHeight);
</script>
@endsection