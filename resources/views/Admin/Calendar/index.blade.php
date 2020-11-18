@extends('master.admin.master')

@section('style')
<link href="{{asset('AdminSide/libs/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('AdminSide/libs/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="{{asset('AdminSide/libs/sweetalert2/sweetalert2.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/qtip2/3.0.3/jquery.qtip.min.css">



@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">AnnaDental</a></li>
                    <li class="breadcrumb-item active">Calendar</li>
                </ol>
            </div>
            <h4 class="page-title">Patients Detail</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="response"></div>
            <div id='calendar'></div>
        </div>
    </div>
</div>



{{Carbon\Carbon::now()}}
<!-- ------------------------ -->
<div id="CldModal" name="CldModal" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" style="overflow-y: initial !important;">
        <div class="modal-content">
            <form id="CldForm" method="POST">
                @csrf
                <div class="modal-header text-center">
                    <h4 class="modal-title col-12 text-center" id="myExtraLargeModalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" style=" overflow-y: auto;">
                    <span id="form_result"></span>
                    <!-- ----- -->
                    <div class="form-row form-group">
                        <div class="col-8">
                            <label>Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title">
                        </div>
                        <div class="col-4">
                            <label>Service</label>
                            <select class="custom-select" name="color" id="color" place>
                                <option value="#348cd4" style="background-color: #348cd4;">Examination </option>
                                <option value="#3ec396" style="background-color: #3ec396;">Checkup <span><i class="fas fa-square"></i></span></option>
                                <option value="#4fbde9" style="background-color: #4fbde9;">Surgery <span><i class="fas fa-square"></i></span></option>
                                <option value="#f9bc0b" style="background-color: #f9bc0b;">Correction <span><i class="fas fa-square"></i></span></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-md-6">
                            <label>Date</label>
                            <input type="datetime-local" class="form-control" id="start" name="start">
                        </div>
                        <div class="col-md-6">
                            <label>Duration</label>
                            <input type="text" class="form-control" id="duration" name="duration">
                        </div>
                    </div>
                    <input type="hidden" id="event_id" name="event_id" value="">
                    <!-- ----- -->
                    <!-- <input type="hidden" id="case_record_id" name="case_record_id" value=""> -->
                    <div class="modal-footer">
                        <input type="button" id="" name="" class="btn btn-danger deleteCalendar" value="">
                        <input type="hidden" id="action" name="action" value="Add" />
                        <input type="hidden" id="hidden" name="hidden" />
                        <input type="submit" id="action_button" name="action_button" class="btn btn-success" value="Add">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--End  CR Process-->
@endsection
@section('script')
<script src="{{asset('AdminSide/libs/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('AdminSide/libs/moment/moment.min.js')}}"></script>
<script src="{{asset('AdminSide/libs/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('AdminSide/libs/fullcalendar/fullcalendar.min.js')}}"></script>
<script>
    $(document).ready(function() {
        var calendar = $('#calendar').fullCalendar({
            selectable: true,
            height: 650,
            showNonCurrentDates: false,
            editable: false,
            defaultView: 'month',
            header: {
                left: "prev,next today",
                center: "title",
                right: "month,agendaWeek,agendaDay",
            },
            events: "{{route('admin.calendar')}}",
            dayClick: function(date, event, view) {
                $('#action_button').val('Add');
                $('#action').val('Add');
                $('#form_result').html('');
                $('#title').val('');
                var newdates = new Date(date.toString().split('GMT')[0] + ' UTC').toISOString().split('.')[0];
                $('#duration').val('');
                //$('#schedule_date').val('2000-01-01T00:00:00');
                $('#start').val(newdates);
                $('.deleteCalendar')[0].style.visibility = 'hidden';
                $('.modal-title').text('Add New Schedule');
                $('#CldModal').modal('show');
                $('#CldForm').on('submit', function(event) {
                    event.preventDefault();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('admin.calendar.store') }}",
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
                                $('#form_result').html(html);
                            }
                            if (data.success) {
                                // $('#calendar').fullCalendar('removeEvents', event);
                                // $('#calendar').fullCalendar('addEventSource', data.result);
                                setTimeout(window.location.reload.bind(window.location), 500);
                                $('#CldModal').modal('hide');
                                console.log(data.result);
                                Swal.fire({
                                    position: "top",
                                    type: "success",
                                    title: "Your data has been saved",
                                    showConfirmButton: !1,
                                    timer: 1500
                                });
                            }
                        },
                        complete: function() {
                            // When AJAX call is complete, will fire upon success or when error is thrown
                            console.log('AJAX call completed');
                        }
                    });
                });
            },
            //-------------------------END THIS WORK WELL------------------------------------------------------
            eventClick: function(event) {
                $('#action_button').val('Update');
                $('#action').val('Edit');
                $('#form_result').html('');
                $('#title').val(event.title);
                //var newdates = event.start.toString().split('GMT')[0] + ' UTC'.toISOString().split('.')[0];
                $('#duration').val(event.duration);
                //$('#schedule_date').val(event.start.format());
                $('#start').val(event.start.format());
                $('.modal-title').text('Edit Schedule');
                $('#event_id').val(event.id);
                $('.deleteCalendar')[0].style.visibility = 'visible';
                $(".deleteCalendar").attr("id", event.id);
                $(".deleteCalendar").attr("name", event.id);
                $(".deleteCalendar").attr("value", "Delete");
                $('#CldModal').modal('show');
                //------------------------
                $(".deleteCalendar").click(function() {
                    //alert("id = " + $('deleteCalendar').attr('id') + "\nname = " + $('deleteCalendar').attr('name') + "\nvalue = " + $('deleteCalendar').attr('value'));
                    console.log('even_id = ' + event.id);
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
                                url: "/admin/calendar/destroy/" + event.id,
                                success: function(data) {
                                    $('#calendar').fullCalendar('removeEvents', event._id);
                                    $('#CldModal').modal('hide');
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
                //THIS ONE WORK WELLS
                //-------------------------
                $('#CldForm').on('submit', function(event) {
                    event.preventDefault();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('admin.calendar.update') }}",
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
                                $('#form_result').html(html);
                            }
                            if (data.success) {
                                setTimeout(window.location.reload.bind(window.location), 500);
                                $('#CldModal').modal('hide');
                                Swal.fire({
                                    position: "top",
                                    type: "success",
                                    title: "Your data has been saved",
                                    showConfirmButton: !1,
                                    timer: 1500
                                });
                            }
                        }
                    });
                });
            },
        })
    });
</script>


@endsection