@extends('master.admin.master')

@section('style')
<link href="{{asset('AdminSide/libs/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
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
                    <li class="breadcrumb-item active">Appointments</li>
                </ol>
            </div>
            <h4 class="page-title">Appointments Page</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="header-title text-center"><b>Appointment Ongoing</b></h4>
            <table id="catelogy_table" class="table  table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th style="width: 3%;">#</th>
                        <th style="width: 15%;">Customer Name</th>
                        <th style="width: 10%;">Email</th>
                        <th style="width: 10%;">PhoneNumber</th>
                        <th style="width: 20%;">Date</th>
                        <th style="width: 20%;">Note</th>
                        <th style="width: 7%;">Created At</th>
                        <th style="15%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="header-title text-center"><b>Appointment Ended</b></h4>
            <table id="catelogy" class="table  table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                    <th style="width: 3%;">#</th>
                        <th style="width: 15%;">Customer Name</th>
                        <th style="width: 10%;">Email</th>
                        <th style="width: 10%;">PhoneNumber</th>
                        <th style="width: 20%;">Date</th>
                        <th style="width: 20%;">Note</th>
                        <th style="width: 7%;">Created At</th>
                        <th style="15%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<hr>
<p>hello</p>

@php
$allApp = App\Appointment::where('date','>',Carbon\Carbon::now()->startOfWeek())->where('date','<',Carbon\Carbon::now()->endOfWeek())->count();
$appendApp = App\Appointment::where('date','>',Carbon\Carbon::now()->startOfWeek())->where('date','<',Carbon\Carbon::now()->endOfWeek())->where('is_accepted',1)->count();
@endphp






<!-- ------------------- -->

{{-- Add AND Edit --}}
<div id="formModal" class="modal fade">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="sample_form" method="POST">
                @csrf
                <div class="modal-header text-center">
                    <h4 class="modal-title text-uppercase"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <span id="form_result"></span>

                    <div class="form-group form-row">
                        <div class="col-6">
                            <label>Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Role Name">
                        </div>
                        <div class="col-6">
                            <label>Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Role Name">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-6">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Enter Role Name">
                        </div>
                        <div class="col-6">
                            <label>Date Booked</label>
                            <input type="datetime-local" class="form-control" id="date" name="date" placeholder="Enter Role Name">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-12">
                            <label>Note</label>
                            <textarea type="text" class="form-control" id="note" name="note" placeholder="Enter Role Name" rows="3"></textarea>
                        </div>
                    </div>

                    <input type="hidden" name="hidden_id" id="hidden_id">
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-danger" data-dismiss="modal" id="cancel_button" value="Cancel">
                    <input type="submit" id="action_button" name="action_button" class="btn btn-success" value="Update">
                </div>
            </form>
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


<!-- Responsive examples -->
<script src="{{asset('AdminSide/libs/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('AdminSide/libs/datatables/responsive.bootstrap4.min.js')}}"></script>

<script src="{{asset('AdminSide/libs/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('AdminSide/libs/moment/moment.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#catelogy_table').DataTable({
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.appointment') }}",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phonenumber',
                    name: 'phonenumber'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'note',
                    name: 'note'
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
            ],
            "rowCallback": function(row, data) {
                if (data.is_accepted == 1 ) {
                    $(row).addClass('bg-success text-white');
                }else{
                    $(row).addClass('bg-secondary text-white');
                }  
            },
        }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");

        $('#cancel_button').click(function() {
            if ($('#action_button').val() == 'Edit') {
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
            action_url = "{{ route('admin.appointment.update') }}";
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
                        Swal.fire({
                            position: "top",
                            type: "success",
                            title: "Your data has been saved",
                            showConfirmButton: !1,
                            timer: 1500
                        });
                        $('#sample_form')[0].reset();
                        $('#catelogy_table').DataTable().ajax.reload();
                        $('#formModal').modal('hide');
                    }
                    $('#form_result').html(html);
                }
            });
        });

        $(document).on('click', '.edit', function() {
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url: "/admin/appointment/" + id + "/edit",
                dataType: "json",
                success: function(data) {
                    $('#name').val(data.result.name);
                    $('#hidden_id').val(id);
                    $('#email').val(data.result.email);
                    $('#phonenumber').val(data.result.phonenumber);
                    var newdates = new Date(data.result.date.toString().split('GMT')[0] + ' UTC').toISOString().split('.')[0];
                    $('#date').val(newdates);
                    $('#note').val(data.result.note);
                    $('#formModal').modal('show');
                }
            })
        });

        var id;
        $(document).on('click', '.accept', function() {
            id = $(this).attr('id');
            $.ajax({
                url: "/admin/appointment/accept/" + id,
                success: function(data) {
                    $('#catelogy_table').DataTable().ajax.reload();
                }
            });
        });

        var id;
        $(document).on('click', '.pending', function() {
            id = $(this).attr('id');
            $.ajax({
                url: "/admin/appointment/pending/" + id,
                success: function(data) {
                    $('#catelogy_table').DataTable().ajax.reload();
                }
            });
        });

        var id;
        $(document).on('click', '.delete', function() {
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
                        url: "/admin/appointment/destroy/" + id,
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
        //Table 2 

        $('#catelogy').DataTable({
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.appointment.datatable') }}",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phonenumber',
                    name: 'phonenumber'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'note',
                    name: 'note'
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
            ],
            "rowCallback": function(row, data) {
                
                    $(row).addClass('bg-warning text-white');
              
                  
             
            },
            
        }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");
    });
</script>

<script>
    console.log(moment().format('L'));
    
</script>

@endsection