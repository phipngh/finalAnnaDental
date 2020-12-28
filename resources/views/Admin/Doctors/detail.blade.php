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
                    <li class="breadcrumb-item"><a href="{{route('admin.doctor')}}">Doctor</a></li>
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li> -->
                    <li class="breadcrumb-item active">{{$doctor->name}}</li>
                </ol>
            </div>
            <h4 class="page-title">Doctor Detail</h4>
        </div>
    </div>
</div>

<div class="row mb-2">
    <div class="col-md-12">
        <h4>{{ $doctor->name}}'s Profile</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-3 order-lg-1 text-center">
        <img src="/upload/{{$doctor->image}}" class="mx-auto img-fluid img-circle d-block img-thumbnail w-75" alt="avatar">
    </div>

    <div class="col-md-9">
        <div class="card-box">
            <ul class="nav nav-tabs nav-bordered nav-justified">
                <li class="nav-item">
                    <a href="#home-b2" data-toggle="tab" aria-expanded="true" class="nav-link active">
                        Doctor Profile
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
                                {{$doctor->name}}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h5>Birthday</h5>
                            <p class="ml-4 h4 text-primary">

                                @if($doctor->birthday)
                                {{date('d-m-Y', strtotime($doctor->birthday))}}


                                @endif
                            </p>
                        </div>


                        <div class="col-md-6">
                            <h5>Email</h5>
                            <p class="ml-4 h4 text-primary">
                                {{$doctor->email}}
                            </p>
                        </div>
                        <div class="col-md-6">

                            <h5>Phone</h5>
                            <p class="ml-4 h4 text-primary">
                                {{$doctor->phone}}
                            </p>
                        </div>

                        <div class="col-md-6">
                            <h5>Sex</h5>
                            <p class="ml-4 h4 text-primary">
                                {{$doctor->sex}}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h5>Address</h5>
                            <p class="ml-4 h4 text-primary">
                                {{$doctor->address}}
                            </p>
                        </div>
                    </div>

                </div>
                <div class="tab-pane" id="profile-b2">
                    {!! html_entity_decode($doctor->info) !!}
                </div>
                <div class="tab-pane" id="messages-b2">
                    {!! html_entity_decode($doctor->note) !!}
                </div>
            </div>
        </div>
        <button type="button" name="edit" id="{{$doctor->id}}" class="edit btn btn-secondary btn-sm rounded float-right px-3"><i class="far fa-edit"></i></button>
    </div>
</div>

<div class="row" id="caseRecordList">
    <div class="col-md-12">
        <h4 class="mb-4">{{ $doctor->name}}'s Case Record</h4>
    </div>
    @foreach($doctor_crs as $doctor_cr)
    <div class="col-md-12">
        <h5>{{$doctor_cr->patient->name}}</h5>


        @php
        $caserecordss = App\CaseRecord::where('doctor_id',$doctor->id)->where('patient_id',$doctor_cr->patient_id)->get();
        @endphp
        <div class="row">
            @foreach($caserecordss as $caserecord)
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
                        <h6 class="ml-3 card-subtitle text-muted">By {{$caserecord->patient->name}}</h6>
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
    </div>

    @endforeach

</div>
<br>
<hr>
<!-- ------------------------ -->

<div id="formModal" name="formModal" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="overflow-y: initial !important;">
        <div class="modal-content">
            <form id="sample_form" method="POST">
                @csrf
                <div class="modal-header text-center">
                    <h4 class="modal-title col-12 text-center" id="myExtraLargeModalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" style="
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
                url: "/admin/doctor/" + id + "/edit",
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
                url: "/admin/doctor/" + id + "/update",
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