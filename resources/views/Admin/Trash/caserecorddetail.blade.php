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
                    <li class="breadcrumb-item active">Trash</li>
                </ol>
            </div>
            <h4 class="page-title">Trash Page</h4>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-12">
        <h5>CaseRecords Detail</h5>
        <div class="card-box table-responsive">
            <h4 class="header-title text-center"><b>CaseRecord Detail</b></h4>
            <table id="catelogy_caserecord" class="table  table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
                    <tr class="text-primary">
                        <th style="width: 1%;">#</th>
                        <th>Service</th>
                        <th>Quantity</th>
                        <th>Case Record</th>
                        <th>Note</th>
                        <th>Created At</th>
                        <th>Deleted At</th>
                        <th style="width: 10%;">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>





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
        $('#catelogy_caserecord').DataTable({
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.trash.caserecorddetail') }}",
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
                    data: 'quantity',
                    name: 'quantity'
                },
                {
                    data: 'case_record_id',
                    name: 'case_record_id'
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
                    data: 'deleted_at',
                    name: 'deleted_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ],
            
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

    });
</script>



@endsection