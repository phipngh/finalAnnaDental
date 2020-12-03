@extends('master.user.master')

@section('content')


<div id="overlay"></div>

<br><br><br><br>
<div class="row">
    <div class="col-md-3">
        <!-- Tabs nav -->
        <div class="nav flex-column nav-pills nav-pills-custom px-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link mb-3 p-3 shadow active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                <i class="fa fa-user-circle-o mr-2"></i>
                <span class="font-weight-bold small text-uppercase">Infomation</span></a>

            <a class="nav-link mb-3 p-3 shadow" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                <i class="fa fa-calendar-minus-o mr-2"></i>
                <span class="font-weight-bold small text-uppercase">Case Record</span></a>

            <!-- <a class="nav-link mb-3 p-3 shadow" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                <i class="fa fa-star mr-2"></i>
                <span class="font-weight-bold small text-uppercase">Reviews</span></a> -->

        </div>
    </div>


    <div class="col-md-9 ">
        <!-- Tabs content -->
        <div class="tab-content px-3" id="v-pills-tabContent">
            <div class="tab-pane fade shadow rounded bg-white show active p-5" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <h4 class="font-italic mb-4">Personal information</h4>

                <div class="modal-body" style=" overflow-y: auto;">
                    <span id="form_result"></span>
                    <div class="form-group form-row">
                        <div class="col-6">
                            <label>Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{Auth::user()->username}}" readonly>
                        </div>
                        <div class="col-6">
                            <label>Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{Auth::user()->email}}" readonly>
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-12">
                            <label>If you wanna change your account password ? &nbsp;&nbsp;<a href="" class="disabled" id="changepassword">Click Here</a></label>
                        </div>
                    </div>
                </div>

            </div>

            <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                @if( App\Patient::where('email', '=', Auth::user()->email)->exists())

                @php
                $patient = App\Patient::where('email', '=', Auth::user()->email)->first();

                @endphp

                <h5>Hello {{$patient->name}}</h5>
                <p>You have {{$patient->caserecords->count()}} case recorded in our Clinic. </p>
                <div class="row">
                    @foreach($patient->caserecords as $caserecord)
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                        <div class="card border {{$caserecord->is_paied == 0 ? 'border-success' : 'border-danger'}} m-2">
                            <div class="card-header bg-white">
                                @if($caserecord->is_paied == 0)
                                <span class="badge badge-success float-right">Active</span>
                                @else
                                <span class="badge badge-danger float-right">Closed</span>
                                @endif
                                <a href="{{route('user.caserecord.detail',$caserecord->id)}}" class="{{$caserecord->is_paied == 0 ? 'text-success' : 'text-danger'}} my-3">
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

                @else
                <h5 class="text-center">You have no case record in our database. If you do please contact AnnaDental for help.</h5>
                <h6 class="float-right m-3 mb-5">- Best Regards</h6>


                @endif

            </div>

            <!-- <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                <h4 class="font-italic mb-4">Reviews</h4>
                <p class="font-italic text-muted mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div> -->


        </div>
    </div>
</div>



<br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br>


<div id="formModalPassword" name="formModal" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="overflow-y: initial !important;">
        <div class="modal-content">
            <form id="changepassword_form" method="POST">
                @csrf
                <div class="modal-header text-center bg-primary">
                    <h5 class="modal-title col-12 text-center text-white" id="myExtraLargeModalLabel">Change Password</h5>
                </div>
                <div class="modal-body">
                    <span id="passwordform_result"></span>
                    <div class="form-group form-row">
                        <div class="col-12">
                            <label>Old Password</label>
                            <input type="password" class="form-control" id="current-password" name="current-password" placeholder="Enter Your Old Password">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-12">
                            <label>New Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your New Password">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-12">
                            <label>Confirm New Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Your New Confirm Password">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="button" class="btn btn-dark" data-dismiss="modal" id="cancel_button" value="Cancel">
                        <button type="submit" id="action_button" name="action_button" class="btn btn-primary text-white">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    console.log('hello.');
</script>
<script>
    $(document).ready(function() {

        $('#sample_form').on('submit', function(event) {
            event.preventDefault();
            var action_url = "{{ route('user.message.store') }}";
            $.ajax({
                url: action_url,
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function(data) {
                    var html = '';
                    if (data.errors) {
                        html = '<div class="alert alert-danger">';
                        if ((data.errors == "invalid")) {
                            html += '<p>Sai roi</p>';
                        } else {

                            for (var count = 0; count < data.errors.length; count++) {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
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

                        console.log(data.errors);
                    }
                    $('#form_result').html(html);

                }
            });
        });


        $('#changepassword').click(function() {
            $('#oldpassword').val('');
            $('#password').val('');
            $('#confirm').val('');
            $('#formModalPassword').modal('show');
        });

        $('#changepassword_form').on('submit', function(event) {
            event.preventDefault();
            var action_url = "{{ route('user.password.update') }}";
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
                            timer: 2000
                        });
                        $('#changepassword_form')[0].reset();
                        $('#formModalPassword').modal('hide');
                    }
                    if(data.wrong){
                        html = '<div class="alert alert-danger">'+data.wrong+'</div>';
                        
                    }
                    $('#passwordform_result').html(html);
                }
            });
        });

    });
</script>

@endsection