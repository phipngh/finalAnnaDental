@extends('master.admin.master')

@section('style')
    <link href="{{asset('AdminSide/libs/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('AdminSide/libs/datatables/buttons.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('AdminSide/libs/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    <div class="row">
        <div class="col-12">

            <a  type="button" name="create_record" id="create_record" class="btn btn-primary float-right mx-2 mb-2 text-light width-md" > <span>Add New Role</span></a>
        </div>
        <div class="col-12">
            <div class="card-box table-responsive">
                <h4 class="header-title"><b>Roles</b></h4>
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

    <a  type="button" data-toggle="modal" data-target="#modal" name="addModal" id="addModal" class="btn btn-primary float-right mx-2 mb-2 text-light width-md" >Add New Role</a>
<!-- ------------------- -->

    {{--    Add AND Edit --}}
    <div id="formModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="sample_form" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Gender</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <span id="form_result"></span>

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control"  id="name" name="name" placeholder="Enter Role Name">
                        </div>

                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" class="form-control"  id="slug" name="slug" placeholder="Enter Role Slug">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel">
                        <input type="hidden" name="action" id="action" value="Add" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="submit" name="action_button" id="action_button" class="btn btn-success" value="Add">
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
                    {{--                <input type="button" name="ok_button" id="ok_button" class="btn btn-danger" value="OK">--}}
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                </div>
            </div>
        </div>
    </div>

<!-- ------------------- -->

    <div id="modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h2 class="text-uppercase text-center mb-4">
                        Roles
                    </h2>

                    <form id="sample_form" class="form-horizontal"  method="POST">
                        @csrf
                        <span id="form_result"></span>

                        <div class="form-group">
                            <div class="col-12">
                                <label for="emailaddress1">Role Name</label>
                                <input type="text" class="form-control"  id="name" name="name">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-12">
                                <label for="emailaddress1">Role Slug</label>
                                <input type="text" class="form-control"  id="slug" name="slug">
                            </div>
                        </div>

                        <hr class="mt-4 h-25">

                        <div class="form-group account-btn text-center">
                            <div class="col-12">
                                <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel">
                                <input type="hidden" name="action" id="action" value="Add" />
                                <input type="hidden" name="hidden_id" id="hidden_id" />
                                <input type="submit" name="action_button" id="action_button" class="btn btn-success" value="Add">
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>




@endsection

@section('script')
    <script src="{{asset('https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js')}}"></script>



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


    <script>
        $(document).ready(function(){

            $('#catelogy_table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    // 'copy',
                    // 'excel',
                    // 'pdf'
                    {
                        extend: 'pdf',
                        footer: false,
                        className: 'btn btn-sm btn-primary',
                        title: 'All Roles',
                        filename: 'Roles',
                        exportOptions: {
                            columns: [0, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'excel',
                        footer: false,
                        className: 'btn btn-sm btn-primary',
                        title: 'All Roles',
                        filename: 'Roles',
                        exportOptions: {
                            columns: [0, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'copy',
                        className: 'btn btn-sm btn-primary',
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-sm btn-primary',
                        title: 'All Roles',
                        filename: 'Roles',
                        exportOptions: {
                            columns: [0, 2, 3, 4]
                        },
                    },

                ],
                "order": [[ 1, "asc" ]],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.role') }}",
                },
                columns: [
                    {
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

            $('#create_record').click(function(){
                $('.modal-title').text('Add New Record');
                $('#action_button').val('Add');
                $('#action').val('Add');
                $('#form_result').html('');
                $('#object').val('');

                $('#formModal').modal('show');
            });

            $('#sample_form').on('submit', function(event){
                event.preventDefault();
                var action_url = '';

                if($('#action').val() == 'Add')
                {
                    action_url = "{{ route('admin.role.store') }}";
                }

                if($('#action').val() == 'Edit')
                {
                    action_url = "{{ route('admin.role.update') }}";
                }

                $.ajax({
                    url: action_url,
                    method:"POST",
                    data:$(this).serialize(),
                    dataType:"json",
                    success:function(data)
                    {
                        var html = '';
                        if(data.errors)
                        {
                            html = '<div class="alert alert-danger">';
                            for(var count = 0; count < data.errors.length; count++)
                            {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if(data.success)
                        {
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $('#sample_form')[0].reset();
                            $('#catelogy_table').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                    }
                });
            });

            $(document).on('click', '.edit', function(){
                var id = $(this).attr('id');
                $('#form_result').html('');
                $.ajax({
                    url :"/admin/role/"+id+"/edit",
                    dataType:"json",
                    success:function(data)
                    {
                        $('#name').val(data.result.name);
                        $('#slug').val(data.result.slug);
                        $('#hidden_id').val(id);
                        $('.modal-title').text('Edit Record');
                        $('#action_button').val('Edit');
                        $('#action').val('Edit');
                        $('#formModal').modal('show');
                    }
                })
            });

            var user_id;

            $(document).on('click', '.delete', function(){
                user_id = $(this).attr('id');
                $('#confirmModal').modal('show');
            });

            $('#ok_button').click(function(){
                $.ajax({
                    url:"/admin/role/destroy/"+user_id,
                    beforeSend:function(){
                        $('#ok_button').text('Deleting...');
                    },
                    success:function(data)
                    {
                        setTimeout(function(){
                            $('#confirmModal').modal('hide');
                            $('#catelogy_table').DataTable().ajax.reload();

                        }, 500);
                    }
                })
            });


        });
    </script>


{{--    Hello--}}
@endsection



