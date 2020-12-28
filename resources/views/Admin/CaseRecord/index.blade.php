@extends('master.admin.master')

@section('style')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<link rel="stylesheet" href="{{asset('AdminSide/libs/sweetalert2/sweetalert2.min.css')}}">



@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">AnnaDental</a></li>
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li> -->
                    <li class="breadcrumb-item active">Case Records</li>
                </ol>
            </div>
            <h4 class="page-title">Case Records Page</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 pb-3">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{route('admin.caserecord.search')}}" enctype="multipart/form-data">
            @csrf
            <span id="form_result"></span>
            <div class="form-row">
                <div class="col-5">
                    <label>Start</label>
                    <input type="date" class="form-control" id="startDate" name="startDate"></input>
                </div>
                <div class="col-5">
                    <label>End</label>
                    <input type="date" class="form-control" id="endDate" name="endDate"></input>
                </div>
                <div class="col-1">
                    <label>.</label>
                    <button type="submit" class=" form-control btn btn-sm btn-primary" id="searchDate">Search</button>
                </div>
            </div>
        </form>
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

<div class="row">
    <div class="col-md-12">
        <div class="float-right">{{$caserecords->links()}}</div>
    </div>
</div>


<!-- ------------------- -->

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



@endsection

@section('script')
<!-- <script src="{{asset('https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js')}}"></script> -->




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
            
            var patient_id = document.getElementById('patient_id_create').value;
            

            
               var action_url = "{{ route('admin.caserecord.update') }}";
            

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
@endsection