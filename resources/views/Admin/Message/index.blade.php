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
                    <li class="breadcrumb-item active">Message</li>
                </ol>
            </div>
            <h4 class="page-title">Message Page</h4>
        </div>
    </div>
</div>

<div class="row">
    
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="header-title text-center text-primary"><b>Message</b></h4>
            <table id="catelogy_table" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr class="text-primary">
                        <th style="width: 1%;">#</th>
                        
                        <!-- <th style="width: 5%;">Image</th> -->
                        <th style="width: 15%;">Name</th>
                        <th style="width: 15%;">Email</th>
                        <th>Message</th>
                        <th style="width: 5%;">Date</th>
                        
                        <th style="width: 5%;">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>





@endsection

@section('script')

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
    $(document).ready(function() {

        // Datatable config

        $('#catelogy_table').DataTable({
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "order": [
                [0, "asc"]
            ],
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.message') }}",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                
                // {
                //     data: 'image',
                //     name: 'image'
                // },
                {
                    data: 'name',
                    name: 'name'
                },
                
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'message',
                    name: 'message'
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
        });


       


        
        //---------------------------------

        
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
                        url: "/admin/message/destroy/" + user_id,
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