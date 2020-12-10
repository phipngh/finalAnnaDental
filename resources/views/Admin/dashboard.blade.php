@extends('master.admin.master')

@section('content')


<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Abstack</a></li>
                
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
            <h4 class="page-title">Starter page</h4>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card-box tilebox-one">
            <i class="fe-box float-right"></i>
            <h5 class="text-muted text-uppercase mb-3 mt-0">Appointments in 2020</h5>
            @php
            $appAllYear = App\Appointment::where('date','>',Carbon\Carbon::now()->startOfYear())->where('date','<',Carbon\Carbon::now()->endOfYear())->count();
            $appAll = App\Appointment::all()->count();
            $start2019 = new Carbon\Carbon('first day of January 2019');
            $end2019 = new Carbon\Carbon('last day of December 2019');
            $appLastYear = App\Appointment::where('date','>',$start2019)->where('date','<',$end2019)->count();
            
            @endphp
            <h3 class="mb-3" data-plugin="counterup">{{$appAllYear}}</h3> 
            <span class="badge badge-primary">{{$appAllYear > $appLastYear ? '+' : '-'}}  {{floor(($appAllYear/$appLastYear)*100)}} % </span> <span class="text-muted ml-2 vertical-middle">in {{$appAll}} total</span>
        </div>
    </div>


    <div class="col-md-6 col-xl-3">
        <div class="card-box tilebox-one">
            <i class="fe-layers float-right"></i>
            <h5 class="text-muted text-uppercase mb-3 mt-0">Case Record</h5>
            @php
            $crCurrYear= App\CaseRecord::where('created_at','>',Carbon\Carbon::now()->startOfYear())->where('created_at','<',Carbon\Carbon::now()->endOfYear())->count();
            $crAll = App\CaseRecord::all()->count();
            $start2019 = new Carbon\Carbon('first day of January 2019');
            $end2019 = new Carbon\Carbon('last day of December 2019');
            $crLastYear = App\CaseRecord::where('created_at','>',$start2019)->where('created_at','<',$end2019)->count();
            
            @endphp
            <h3 class="mb-3"><span data-plugin="counterup">{{$crCurrYear}}</span></h3>
            <span class="badge badge-primary">{{$crCurrYear > $crLastYear ? '+' : '-'}}  {{floor(($crCurrYear/$crLastYear)*100)}} % </span> <span class="text-muted ml-2 vertical-middle">in {{$crAll}} total</span>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card-box tilebox-one">
            <i class="fe-tag float-right"></i>
            <h5 class="text-muted text-uppercase mb-3 mt-0">Patient</h5>
            @php
            $ptCurrYear= App\Patient::where('created_at','>',Carbon\Carbon::now()->startOfYear())->where('created_at','<',Carbon\Carbon::now()->endOfYear())->count();
            $ptAll = App\Patient::all()->count();
            $start2019 = new Carbon\Carbon('first day of January 2019');
            $end2019 = new Carbon\Carbon('last day of December 2019');
            $ptLastYear = App\Patient::where('created_at','>',$start2019)->where('created_at','<',$end2019)->count();
            
            @endphp
            <h3 class="mb-3"><span data-plugin="counterup">{{$ptCurrYear}}</span></h3>
            <span class="badge badge-primary"> {{$ptCurrYear > $ptLastYear ? '+' : '-'}}  {{floor(($ptCurrYear/$ptLastYear)*100)}} %</span> <span class="text-muted ml-2 vertical-middle">in {{$ptAll}} total</span>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card-box tilebox-one">
            <i class="fe-briefcase float-right"></i>
            <h5 class="text-muted text-uppercase mb-3 mt-0">Subcribler</h5>
            @php
            $subCurrYear= App\Subcrible::where('created_at','>',Carbon\Carbon::now()->startOfYear())->where('created_at','<',Carbon\Carbon::now()->endOfYear())->count();
            $subAll = App\Subcrible::all()->count();
            $start2019 = new Carbon\Carbon('first day of January 2019');
            $end2019 = new Carbon\Carbon('last day of December 2019');
            $subLastYear = App\Subcrible::where('created_at','>',$start2019)->where('created_at','<',$end2019)->count();
            
            @endphp
            <h3 class="mb-3" data-plugin="counterup">{{$subCurrYear}}</h3>
            <span class="badge badge-primary"> {{$subCurrYear > $subLastYear ? '+' : '-'}}  {{floor(($subCurrYear/$subLastYear)*100)}} % </span> <span class="text-muted ml-2 vertical-middle">in {{$subAll}} total</span>
        </div>
    </div>
</div>

<div class="row my-1">
    <div class="col-lg-6">
        <h4 class="header-title">Week Appointments  </h4>
        <canvas id="pie" height="100" class="mt-4"></canvas>
        <p class="text-muted text-center">From {{Carbon\Carbon::now()->startOfWeek()->format('d M')}} to {{Carbon\Carbon::now()->endOfWeek()->format('d M')}}</p> 
    </div>
    <div class="col-lg-6">
        <h4 class="header-title">All Case Record  </h4>
        <canvas id="piecr" height="100" class="mt-4"></canvas>
        <p class="text-muted text-center">All Clinic Case Records</p> 
    </div>
</div>
@php
    $crDone = App\CaseRecord::where('is_paied',1)->count();

@endphp

<div class="row my-1">
    <div class="col-lg-12">
        <h4 class="header-title"><span id="yearTitle" >2020</span> Appointments  </h4>
        <select class="custom-select form-control w-15" name="select" id="select" >
            <option value="2020">Year : 2020</option>
            <option value="2019">Year : 2019</option>
            <option value="2018">Year : 2018</option>
            <option value="2017">Year : 2017</option>
        </select>
        <canvas id="pieYear" height="80" class="mt-2"></canvas>
        <p class="text-muted text-center"><span id="appYear">2020</span> Appointments Statistic. <br><span id="appTotal">{{$appAllYear}}</span> in total.</p>
    </div>
</div>
<br>
<div class="row my-1">
    <div class="col-lg-12">
        <h4 class="header-title"><span id="ptyearTitle" >2020</span> Patients  </h4>
        <select class="custom-select form-control w-15" name="ptselect" id="ptselect" >
            <option value="2020">Year : 2020</option>
            <option value="2019">Year : 2019</option>
            <option value="2018">Year : 2018</option>
            <option value="2017">Year : 2017</option>
        </select>
        <canvas id="ptpieYear" height="80" class="mt-2"></canvas>
        <p class="text-muted text-center"><span id="ptappYear">2020</span> Patients Statistic. <br><span id="ptappTotal">{{$ptCurrYear}}</span> in total.</p>
    </div>
</div>
<div class="row my-1">
    <div class="col-lg-12">
        <h4 class="header-title"><span id="cryearTitle" >2020</span> Case Records  </h4>
        <select class="custom-select form-control w-15" name="crselect" id="crselect" >
            <option value="2020">Year : 2020</option>
            <option value="2019">Year : 2019</option>
            <option value="2018">Year : 2018</option>
            <option value="2017">Year : 2017</option>
        </select>
        <canvas id="crpieYear" height="80" class="mt-2"></canvas>
        <p class="text-muted text-center"><span id="crappYear">2020</span> Case Records Statistic. <br><span id="crappTotal">{{$crCurrYear}}</span> in total.</p>
    </div>
</div>


@php
$allApp = App\Appointment::where('date','>',Carbon\Carbon::now()->startOfWeek())->where('date','<',Carbon\Carbon::now()->endOfWeek())->count();
$appendApp = App\Appointment::where('date','>',Carbon\Carbon::now()->startOfWeek())->where('date','<',Carbon\Carbon::now()->endOfWeek())->where('is_accepted',1)->count();


$allYear = App\Appointment::where('date','>',Carbon\Carbon::now()->startOfYear())->where('date','<',Carbon\Carbon::now()->endOfYear())->count();

$janStart = new Carbon\Carbon('first day of January');
$janEnd = new Carbon\Carbon('last day of January');
$janEnd = $janEnd->endOfMonth();
$jan = App\Appointment::where('date','>',$janStart)->where('date','<',$janEnd)->count();
$ptjan = App\Patient::where('created_at','>',$janStart)->where('created_at','<',$janEnd)->count();
$crjan = App\CaseRecord::where('created_at','>',$janStart)->where('created_at','<',$janEnd)->count();

$febStart = new Carbon\Carbon('first day of February');
$febEnd = new Carbon\Carbon('last day of February');
$febEnd = $febEnd->endOfMonth();
$feb = App\Appointment::where('date','>',$febStart)->where('date','<',$febEnd)->count();
$ptfeb = App\Patient::where('created_at','>',$febStart)->where('created_at','<',$febEnd)->count();
$crfeb = App\CaseRecord::where('created_at','>',$febStart)->where('created_at','<',$febEnd)->count();

$marStart = new Carbon\Carbon('first day of March');
$marEnd = new Carbon\Carbon('last day of March');
$marEnd = $marEnd->endOfMonth();
$mar = App\Appointment::where('date','>',$marStart)->where('date','<',$marEnd)->count();
$ptmar = App\Patient::where('created_at','>',$marStart)->where('created_at','<',$marEnd)->count();
$crmar = App\CaseRecord::where('created_at','>',$marStart)->where('created_at','<',$marEnd)->count();

$aprStart = new Carbon\Carbon('first day of April');
$aprEnd = new Carbon\Carbon('last day of April');
$aprEnd = $aprEnd->endOfMonth();
$apr = App\Appointment::where('date','>',$aprStart)->where('date','<',$aprEnd)->count();
$ptapr = App\Patient::where('created_at','>',$aprStart)->where('created_at','<',$aprEnd)->count();
$crapr = App\CaseRecord::where('created_at','>',$aprStart)->where('created_at','<',$aprEnd)->count();

$mayStart = new Carbon\Carbon('first day of May');
$mayEnd = new Carbon\Carbon('last day of May');
$mayEnd = $mayEnd->endOfMonth();
$may = App\Appointment::where('date','>',$mayStart)->where('date','<',$mayEnd)->count();
$ptmay = App\Patient::where('created_at','>',$mayStart)->where('created_at','<',$mayEnd)->count();
$crmay = App\CaseRecord::where('created_at','>',$mayStart)->where('created_at','<',$mayEnd)->count();

$junStart = new Carbon\Carbon('first day of June');
$junEnd = new Carbon\Carbon('last day of June');
$junEnd = $junEnd->endOfMonth();
$jun = App\Appointment::where('date','>',$junStart)->where('date','<',$junEnd)->count();
$ptjun = App\Patient::where('created_at','>',$junStart)->where('created_at','<',$junEnd)->count();
$crjun = App\CaseRecord::where('created_at','>',$junStart)->where('created_at','<',$junEnd)->count();

$julStart = new Carbon\Carbon('first day of July');
$julEnd = new Carbon\Carbon('last day of July');
$julEnd = $julEnd->endOfMonth();
$jul = App\Appointment::where('date','>',$julStart)->where('date','<',$julEnd)->count();
$ptjul = App\Patient::where('created_at','>',$julStart)->where('created_at','<',$julEnd)->count();
$crjul = App\CaseRecord::where('created_at','>',$julStart)->where('created_at','<',$julEnd)->count();

$augStart = new Carbon\Carbon('first day of August');
$augEnd = new Carbon\Carbon('last day of August');
$augEnd = $augEnd->endOfMonth();
$aug = App\Appointment::where('date','>',$augStart)->where('date','<',$augEnd)->count();
$ptaug = App\Patient::where('created_at','>',$augStart)->where('created_at','<',$augEnd)->count();
$craug = App\CaseRecord::where('created_at','>',$augStart)->where('created_at','<',$augEnd)->count();

$sepStart = new Carbon\Carbon('first day of September');
$sepEnd = new Carbon\Carbon('last day of September');
$sepEnd = $sepEnd->endOfMonth();
$sep = App\Appointment::where('date','>',$sepStart)->where('date','<',$sepEnd)->count();
$ptsep = App\Patient::where('created_at','>',$sepStart)->where('created_at','<',$sepEnd)->count();
$crsep = App\CaseRecord::where('created_at','>',$sepStart)->where('created_at','<',$sepEnd)->count();

$octStart = new Carbon\Carbon('first day of October');
$octEnd = new Carbon\Carbon('last day of October');
$octEnd = $octEnd->endOfMonth();
$oct = App\Appointment::where('date','>',$octStart)->where('date','<',$octEnd)->count();
$ptoct = App\Patient::where('created_at','>',$octStart)->where('created_at','<',$octEnd)->count();
$croct = App\CaseRecord::where('created_at','>',$octStart)->where('created_at','<',$octEnd)->count();

$novStart = new Carbon\Carbon('first day of November');
$novEnd = new Carbon\Carbon('last day of November');
$novEnd = $novEnd->endOfMonth();
$nov = App\Appointment::where('date','>',$novStart)->where('date','<',$novEnd)->count();
$ptnov = App\Patient::where('created_at','>',$novStart)->where('created_at','<',$novEnd)->count();
$crnov = App\CaseRecord::where('created_at','>',$novStart)->where('created_at','<',$novEnd)->count();

$decStart = new Carbon\Carbon('first day of December');
$decEnd = new Carbon\Carbon('last day of December');
$decEnd = $decEnd->endOfMonth();
$dec = App\Appointment::where('date','>',$decStart)->where('date','<',$decEnd)->count();
$ptdec = App\Patient::where('created_at','>',$decStart)->where('created_at','<',$decEnd)->count();
$crdec = App\CaseRecord::where('created_at','>',$decStart)->where('created_at','<',$decEnd)->count();

@endphp





@endsection

@section('script')
<script src="{{asset('AdminSide/libs/chart-js/Chart.bundle.min.js')}}"></script>

<script>
var ctx = document.getElementById('pie').getContext('2d');
var allApp = {{$allApp}};
var appendApp = {{$appendApp}};
var acceptApp = {{$allApp - $appendApp}};



var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [ 'Approve','Appending'],
        datasets: [{
            label: '# of Votes',
            data: [acceptApp,appendApp],
            backgroundColor: [
                
                "#3ec396",
                "#5d6dc3",
            ],
            borderColor: [
                "#5d6dc3",
              "#3ec396",
            ],
            borderWidth: 1
        }]
    },
    
});
</script>
<script>
var ctx = document.getElementById('piecr').getContext('2d');
var crAll = {{$crAll}};
var crDone = {{$crDone}};
var crUnDone = {{$crAll - $crDone}};



var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [ 'Done','In Processing'],
        datasets: [{
            label: '# of Votes',
            data: [crDone,crUnDone],
            backgroundColor: [
              
              "#32c861",
              "#348cd4"
            ],
            borderColor: [
           
              "#32c861",
              "#348cd4"
            ],
            borderWidth: 1
        }]
    },
    
});
</script>

<script>
var ctx = document.getElementById('pieYear').getContext('2d');
var allApp = {{$allApp}};
var jan = {{$jan}};
var feb = {{$feb}};
var mar = {{$mar}};
var apr = {{$apr}};
var may = {{$may}};
var jun = {{$jun}};
var jul = {{$jul}};
var aug = {{$aug}};
var sep = {{$sep}};
var oct = {{$oct}};
var nov = {{$nov}};
var dec = {{$dec}};



var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
          ],
          datasets: [
            {
              label: "Appointments",
              fill: !1,
              lineTension: 0.05,
              backgroundColor: "#fff",
              borderColor: "#348cd4",
              borderCapStyle: "square",
            //   borderDash: [],
            //   borderDashOffset: 0,
            //   borderJoinStyle: "miter",
            //   pointBorderColor: "#3ec396",
            //   pointBackgroundColor: "#fff",
            //   pointBorderWidth: 8,
            //   pointHoverRadius: 6,
            //   pointHoverBackgroundColor: "#fff",
            //   pointHoverBorderColor: "#3ec396",
            //   pointHoverBorderWidth: 3,
            //   pointRadius: 1,
            //   pointHitRadius: 10,
                 data: [jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec],
            },
          ],
    },
    
});
</script>

<script>
    $(document).ready(function() {
        $('#select').on('change', function (e) {
            var year = $('#select').val();
           
            $('#appYear').html(year);
            $('#yearTitle').html(year);
            $.ajax({
                url: "/admin/dashboard/statistic/appointment/" + year,
                success: function(data) {
                    var year = data.data;
                    $('#appTotal').html(data.sum);
                    var ctx = document.getElementById('pieYear').getContext('2d');
                    var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [
                            "January",
                            "February",
                            "March",
                            "April",
                            "May",
                            "June",
                            "July",
                            "August",
                            "September",
                            "October",
                            "November",
                            "December",
                        ],
                        datasets: [
                            {
                            label: "Appointments",
                            fill: !1,
                            lineTension: 0.05,
                            backgroundColor: "#fff",
                            borderColor: "#348cd4",
                            borderCapStyle: "square",
                            // borderDash: [],
                            // borderDashOffset: 0,
                            // borderJoinStyle: "miter",
                            // pointBorderColor: "#3ec396",
                            // pointBackgroundColor: "#fff",
                            // pointBorderWidth: 8,
                            // pointHoverRadius: 6,
                            // pointHoverBackgroundColor: "#fff",
                            // pointHoverBorderColor: "#3ec396",
                            // pointHoverBorderWidth: 3,
                            // pointRadius: 1,
                            // pointHitRadius: 10,
                                data: [year.jan, year.feb, year.mar, year.apr, year.may, year.jun, year.jul, year.aug, year.sep, year.oct, year.nov, year.dec],
                            },
                        ],
                    },
    
                    });
                   
                }
            });
        
        
        });
    });
</script>

<script>
$(document).ready(function() {
var ctx = document.getElementById('ptpieYear').getContext('2d');
var allApp = {{$allApp}};
var jan = {{$ptjan}};
var feb = {{$ptfeb}};
var mar = {{$ptmar}};
var apr = {{$ptapr}};
var may = {{$ptmay}};
var jun = {{$ptjun}};
var jul = {{$ptjul}};
var aug = {{$ptaug}};
var sep = {{$ptsep}};
var oct = {{$ptoct}};
var nov = {{$ptnov}};
var dec = {{$ptdec}};



var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
          ],
          datasets: [
            {
                label: "Patients",
                fill: !1,
                            lineTension: 0.05,
                            backgroundColor: "#fff",
                            borderColor: "#ff9999",
                            borderCapStyle: "square",
               
                 data: [jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec],
            },
          ],
    },
    
});

$('#ptselect').on('change', function (e) {
    myChart.destroy();
            var year = $('#ptselect').val();
            $('#ptyearTitle').html(year);
            $('#ptappYear').html(year);
          
            $.ajax({
                url: "/admin/dashboard/statistic/patient/" + year,
                success: function(data) {
                    var year = data.data;
                    $('#ptappTotal').html(data.sum);
                    var ctx = document.getElementById('ptpieYear').getContext('2d');
                    var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [
                            "January",
                            "February",
                            "March",
                            "April",
                            "May",
                            "June",
                            "July",
                            "August",
                            "September",
                            "October",
                            "November",
                            "December",
                        ],
                        datasets: [
                            {
                                label: "Patients",
                                fill: !1,
                            lineTension: 0.05,
                            backgroundColor: "#fff",
                            borderColor: "#ff9999",
                            borderCapStyle: "square",
                                data: [year.jan, year.feb, year.mar, year.apr, year.may, year.jun, year.jul, year.aug, year.sep, year.oct, year.nov, year.dec],
                            },
                        ],
                    },
    
                    });
                   
                }
            });
        
        
        });
       });    
</script>

<script>
$(document).ready(function() {
var ctx = document.getElementById('crpieYear').getContext('2d');

var jan = {{$crjan}};
var feb = {{$crfeb}};
var mar = {{$crmar}};
var apr = {{$crapr}};
var may = {{$crmay}};
var jun = {{$crjun}};
var jul = {{$crjul}};
var aug = {{$craug}};
var sep = {{$crsep}};
var oct = {{$croct}};
var nov = {{$crnov}};
var dec = {{$crdec}};



var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
          ],
          datasets: [
            {
                label: "Case Records",
                fill: !1,
                            lineTension: 0.05,
                            backgroundColor: "#fff",
                            borderColor: "#9368f3",
                            borderCapStyle: "square",
               
                 data: [jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec],
            },
          ],
    },
    
});

$('#crselect').on('change', function (e) {
    myChart.destroy();
            var year = $('#crselect').val();
            $('#cryearTitle').html(year);
            $('#crappYear').html(year);
          
            $.ajax({
                url: "/admin/dashboard/statistic/caserecord/" + year,
                success: function(data) {
                    var year = data.data;
                    $('#crappTotal').html(data.sum);
                    var ctx = document.getElementById('crpieYear').getContext('2d');
                    var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [
                            "January",
                            "February",
                            "March",
                            "April",
                            "May",
                            "June",
                            "July",
                            "August",
                            "September",
                            "October",
                            "November",
                            "December",
                        ],
                        datasets: [
                            {
                                label: "Case Records",
                                fill: !1,
                            lineTension: 0.05,
                            backgroundColor: "#fff",
                            borderColor: "#9368f3",
                            borderCapStyle: "square",
                                data: [year.jan, year.feb, year.mar, year.apr, year.may, year.jun, year.jul, year.aug, year.sep, year.oct, year.nov, year.dec],
                            },
                        ],
                    },
    
                    });
                   
                }
            });
        
        
        });
       });    
</script>

@endsection