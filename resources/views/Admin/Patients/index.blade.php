@extends('master.admin.master')

@section('style')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<link href="{{asset('AdminSide/libs/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('AdminSide/libs/datatables/buttons.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('AdminSide/libs/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />

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
                    <li class="breadcrumb-item active">Patients</li>
                </ol>
            </div>
            <h4 class="page-title">Patients Page</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <a type="button" name="create_record" id="create_record" class="btn btn-primary float-right mx-2 mb-2 text-light width-md"> <i class="fas fa-plus"></i><span> &nbsp;Add New Patient</span></a>
    </div>
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="header-title text-center text-primary"><b>Patients</b></h4>
            <table id="catelogy_table" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr class="text-primary">
                        <th style="width: 1%;">#</th>
                        <th style="width: 1%;">ID</th>
                        <th>Name</th>
                        <th>Birthday</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th style="width: 2%;">Info</th>
                        <th style="width: 2%;">Note</th>
                        <th style="width: 10%;">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


<!-- ------------------- -->


<!-- ------------------- -->

<div id="formModal" name="formModal" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="overflow-y: initial !important;">
        <div class="modal-content">
            <form id="sample_form" method="POST">
                @csrf
                <div class="modal-header text-center">
                    <h4 class="modal-title col-12 text-center" id="myExtraLargeModalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" style=" overflow-y: auto;">
                    <span id="form_result"></span>
                    <div class="form-group form-row">
                        <div class="col-6">
                            <label>Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Patient Name">
                        </div>
                        <div class="col-6">
                            <label>Image</label>
                            <input type="text" class="form-control" id="image" name="image" placeholder="Enter Patient Image">
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
                        <div class="col">
                            <label>Phone Number</label>
                            <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter Patient Phone Number">
                        </div>
                        <div class="col-8">
                            <label>Address</label>
                            <textarea class="form-control mb-1" name="address" id="address" rows="4" placeholder="Enter Patient Address"></textarea>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-6">
                            <label>Info</label>
                            <textarea type="text" class="form-control" id="ckeditor1" name="info" placeholder="Enter Patient Info" rows="6"></textarea>
                        </div>
                        <div class="col-6">
                            <label>Note</label>
                            <textarea type="text" class="form-control" id="ckeditor2" name="note" placeholder="Enter Patient Note" rows="4"></textarea>
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


<!-- ------------------- -->


<!-- ---------INFO---------- -->

<div id="infoModal" name="infoModal" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="overflow-y: initial !important;">
        <div class="modal-content">

            <div class="modal-header text-center">
                <h4 class="modal-title col-12 text-center" id="myExtraLargeModalLabel">Patient</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" style="height: 85vh;
    overflow-y: auto;">
                <div class="form-group form-row">
                    <div class="col-6">
                        <label>Name</label>
                        <input type="text" class="form-control" id="name_info" name="name_info" disabled>
                    </div>
                    <div class="col-6">
                        <label>Image</label>
                        <input type="text" class="form-control" id="image_info" name="image_info" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label>Email</label>
                        <input type="email" class="form-control" id="email_info" name="email_info" disabled>
                    </div>
                    <div class="col">
                        <label>Gender</label>
                        <select class="custom-select" name="sex_info" id="sex_info" disabled>
                            <option disabled selected>Select Your Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Unknown">Unknown</option>
                        </select>
                    </div>
                    <div class="col">
                        <label>Birthday</label>
                        <input type="date" class="form-control" id="birthday_info" name="birthday_info" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label>Phone</label>
                        <input type="number" class="form-control" id="phone_info" name="phone_info" disabled>
                    </div>
                    <div class="col-8">
                        <label>Address</label>
                        <textarea class="form-control mb-1" name="address_info" id="address_info" rows="4" disabled></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label>Info</label>
                        <textarea type="text" class="form-control" id="ckeditor1_info" name="info_info" placeholder="Enter Patient Description" rows="6" disabled></textarea>
                    </div>
                    <div class="col-6">
                        <label>Note</label>
                        <textarea type="text" class="form-control" id="ckeditor2_info" name="note_info" placeholder="Enter Patient Note" rows="4" disabled></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel">

                </div>
            </div>

        </div>
    </div>
</div>
<!-- ------------------- -->


@endsection

@section('script')
<!-- <script src="{{asset('https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js')}}"></script> -->



<script src="{{asset('AdminSide/libs/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('AdminSide/libs/datatables/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{asset('https://cdn.datatables.net/v/dt/b-1.6.5/datatables.min.js')}}"></script>

<!-- Buttons examples -->
<script src="{{asset('AdminSide/libs/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('AdminSide/libs/datatables/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('AdminSide/libs/jszip/jszip.min.js')}}"></script>
<script src="{{asset('AdminSide/libs/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('AdminSide/libs/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('AdminSide/libs/datatables/buttons.html5.min.js')}}"></script>
<script src="{{asset('AdminSide/libs/datatables/buttons.print.min.js')}}"></script>

<!-- Responsive examples -->
<script src="{{asset('AdminSide/libs/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('AdminSide/libs/datatables/responsive.bootstrap4.min.js')}}"></script>

<script src="{{asset('AdminSide/libs/sweetalert2/sweetalert2.min.js')}}"></script>


<script src="{{ asset('AdminSide/libs/ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('ckeditor1', {
        height: 150
    });
    CKEDITOR.replace('ckeditor2', {
        height: 150
    });
    CKEDITOR.replace('ckeditor1_info', {
        height: 150,
    });
    CKEDITOR.replace('ckeditor2_info', {
        height: 150
    });
</script>


<script>
    $(document).ready(function() {

        // Datatable config

        $('#catelogy_table').DataTable({
            dom: 'Blfrtip',
            buttons: [
                // 'copy',
                // 'excel',
                // 'pdf'
                {
                    extend: 'pdf',
                    footer: false,
                    className: 'btn btn-sm btn-primary mb-1 float-right ml-1',
                    title: 'All Roles',
                    filename: 'Roles',
                    exportOptions: {
                        columns: [0, 2, 3, 4]
                    }
                },
                {
                    extend: 'excel',
                    footer: false,
                    className: 'btn btn-sm btn-primary mb-1 float-right ml-1',
                    title: 'All Roles',
                    filename: 'Roles',
                    exportOptions: {
                        columns: [0, 2, 3, 4]
                    }
                },
                {
                    extend: 'copy',
                    className: 'btn btn-sm btn-primary mb-1 float-right ml-1',
                },
                {
                    extend: 'print',
                    className: 'btn btn-sm btn-primary mb-1 float-right ',
                    title: 'All Roles',
                    filename: 'Roles',
                    exportOptions: {
                        columns: [0, 2, 3, 4]
                    },
                },


            ],
            columnDefs: [{
                    "targets": 0,
                    "className": "text-center text-info",
                },
                {
                    "targets": 1,
                    "className": "text-center text-info",
                },
                {
                    "targets": 2,
                    "className": "text-center h5 text-primary text-bold",
                },
                {
                    "targets": 3,
                    "className": "text-center h5 text-primary text-bold",
                },
                {
                    "targets": 4,
                    "className": "text-center",
                },
                {
                    "targets": 5,
                    "className": "text-center",
                },
                {
                    "targets": 6,
                    "className": "text-center",
                },
            ],
            "order": [
                [1, "asc"]
            ],
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.patient') }}",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'birthday',
                    name: 'birthday'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'info',
                    name: 'info'
                },
                {
                    data: 'note',
                    name: 'note'
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
        }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");

        //Add

        $('#create_record').click(function() {

            $('#action_button').val('Add');
            $('#action').val('Add');
            $('#form_result').html('');
            $('#name').val('');
            CKEDITOR.instances.ckeditor1.setData("");
            CKEDITOR.instances.ckeditor2.setData("");

            // $('#slug').val('');
            $('.modal-title').text('Patients');
            $('#formModal').modal('show');
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

        $('#sample_form').on('submit', function(event) {
            event.preventDefault();
            var action_url = '';

            if ($('#action').val() == 'Add') {
                action_url = "{{ route('admin.patient.store') }}";
            }

            if ($('#action').val() == 'Edit') {
                action_url = "{{ route('admin.patient.update') }}";
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
                        $('#sample_form')[0].reset();
                        CKEDITOR.instances.ckeditor1.setData("");
                        CKEDITOR.instances.ckeditor2.setData("");
                        $('#catelogy_table').DataTable().ajax.reload();

                        if ($('#action').val() == 'Edit') {
                            $('#formModal').modal('hide');
                        }
                    }
                    $('#form_result').html(html);
                }
            });
        });

        //show info

        $(document).on('click', '.info', function() {
            var id = $(this).attr('id');
            $.ajax({
                url: "/admin/patient/" + id + "/info",
                dataType: "json",
                success: function(data) {

                    $('#name_info').val(data.result.name);

                    $('#birthday_info').val(data.result.birthday);
                    $('#sex_info').val(data.result.sex);
                    $('#email_info').val(data.result.email);
                    $('#phone_info').val(data.result.phone);
                    $('#address_info').val(data.result.address);
                    $('#image_info').val(data.result.image);
                    CKEDITOR.instances.ckeditor1_info.setData(data.result.info);
                    CKEDITOR.instances.ckeditor2_info.setData(data.result.note);
                    // var descHtml ='<div class="p-1 overflow-auto">';
                    // descHtml += data.result.description;
                    // descHtml += '</div>';
                    // $('#description_info').html(descHtml);
                    //$('#description').val(data.result.description);
                    // $('#slug').val(data.result.slug);
                    $('#hidden_id').val(id);
                    // $('.modal-title').text('Edit Record');


                    $('#infoModal').modal('show');
                }
            })
        });

        // ---------------


        //---------------------------------

        $(document).on('click', '.edit', function() {
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url: "/admin/patient/" + id + "/edit",
                dataType: "json",
                success: function(data) {
                    $('#name').val(data.result.name);

                    $('#birthday').val(data.result.birthday);
                    $('#sex').val(data.result.sex);
                    $('#email').val(data.result.email);
                    $('#phone').val(data.result.phone);
                    $('#address').val(data.result.address);
                    $('#image').val(data.result.image);

                    CKEDITOR.instances.ckeditor1.setData(data.result.info);
                    CKEDITOR.instances.ckeditor2.setData(data.result.note);
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


        var user_id;
        $(document).on('click', '.delete', function() {
            user_id = $(this).attr('id');
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
                        url: "/admin/patient/destroy/" + user_id,
                        success: function(data) {
                            $('#catelogy_table').DataTable().ajax.reload();
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