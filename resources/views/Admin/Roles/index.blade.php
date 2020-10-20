@extends('master.admin.master')

@section('style')
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
                    <li class="breadcrumb-item active">Roles</li>
                </ol>
            </div>
            <h4 class="page-title">Roles Page</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <a type="button" name="create_record" id="create_record" class="btn btn-primary float-right mx-2 mb-2 text-light width-md"> <i class="fas fa-plus"></i><span> &nbsp;Add New Role</span></a>
    </div>
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="header-title text-center"><b>Roles</b></h4>
            <table id="catelogy_table" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Role Title</th>
                        <th>Slug</th>
                        <th>Create At</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- ------------------- -->

{{-- Add AND Edit --}}
<div id="formModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="sample_form" method="POST">
                @csrf
                <div class="modal-header text-center">
                    <h4 class="modal-title text-uppercase"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <span id="form_result"></span>

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Role Name">
                    </div>

                    <!-- <div class="form-group">
                        <label>Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter Role Slug">
                    </div> -->

                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-danger" data-dismiss="modal" id="cancel_button" value="Cancel">
                    <input type="hidden" id="action" name="action" value="Add" />
                    <input type="hidden" id="hidden_id" name="hidden_id" />
                    <input type="submit" id="action_button" name="action_button" class="btn btn-success" value="Add">
                </div>
            </form>
        </div>
    </div>
</div>


{{--Delete--}}
<div id="confirmModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Record</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body text-center">
                <h4 style="margin:0;">Are you sure you want to remove this data?</h4>

            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-success" data-dismiss="modal" value="Cancel">
                {{-- <input type="button" name="ok_button" id="ok_button" class="btn btn-danger" value="OK">--}}
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
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
            "order": [
                [1, "asc"]
            ],
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.role') }}",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'id',
                    name: 'id',
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'slug',
                    name: 'slug'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
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
            // $('#slug').val('');
            $('.modal-title').text('Roles');
            $('#formModal').modal('show');
        });

        $('#cancel_button').click(function() {
            if ($('#action').val() == 'Edit') {
                Swal.fire({
                    title: "Cancelled",
                    text: "Your data is safe :)",
                    type: "error",
                    position: "top"
                })
            }
        });

        $('#sample_form').on('submit', function(event) {
            event.preventDefault();
            var action_url = '';

            if ($('#action').val() == 'Add') {
                action_url = "{{ route('admin.role.store') }}";
            }

            if ($('#action').val() == 'Edit') {
                action_url = "{{ route('admin.role.update') }}";
            }

            $.ajax({
                url: action_url,
                method: "POST",
                data: $(this).serialize(),
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
                        $('#catelogy_table').DataTable().ajax.reload();

                        if ($('#action').val() == 'Edit') {
                            $('#formModal').modal('hide');
                        }
                    }
                    $('#form_result').html(html);
                }
            });
        });

        $(document).on('click', '.edit', function() {
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url: "/admin/role/" + id + "/edit",
                dataType: "json",
                success: function(data) {
                    $('#name').val(data.result.name);
                    // $('#slug').val(data.result.slug);
                    $('#hidden_id').val(id);
                    $('.modal-title').text('Roles');
                    // $('.modal-title').text('Edit Record');
                    $('#action_button').val('Edit');
                    $('#action').val('Edit');
                    $('#formModal').modal('show');
                }
            })
        });

        var user_id;

        // $(document).on('click', '.delete', function() {
        //     user_id = $(this).attr('id');
        //     $('#confirmModal').modal('show');
        // });

        // $('#ok_button').click(function() {
        //     $.ajax({
        //         url: "/admin/role/destroy/" + user_id,
        //         beforeSend: function() {
        //             $('#ok_button').text('Deleting...');
        //         },
        //         success: function(data) {
        //             setTimeout(function() {
        //                 $('#confirmModal').modal('hide');
        //                 $('#catelogy_table').DataTable().ajax.reload();

        //             }, 500);
        //         }
        //     })
        // });

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
                        url: "/admin/role/destroy/" + user_id,
                        success: function(data) {
                            $('#catelogy_table').DataTable().ajax.reload();
                        }
                    });
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        type: "success",

                    });
                } else {
                    t.dismiss === Swal.DismissReason.cancel && Swal.fire({
                        title: "Cancelled",
                        text: "Your data is safe :)",
                        type: "error"
                    })
                }
            })
        });


    });
</script>

@endsection