<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Appointment;
use App\Patient;
use App\CaseRecord;

class DashboardController extends Controller
{
    public function appByYear($year)
    {

        if ($year == '2020') {

            $janStart = new Carbon('first day of January');
            $janEnd = new Carbon('last day of January');
            $janEnd = $janEnd->endOfMonth();
            $jan = Appointment::where('date', '>', $janStart)->where('date', '<', $janEnd)->count();
            $data['jan'] = $jan;

            $febStart = new Carbon('first day of February');
            $febEnd = new Carbon('last day of February');
            $febEnd = $febEnd->endOfMonth();
            $feb = Appointment::where('date', '>', $febStart)->where('date', '<', $febEnd)->count();
            $data['feb'] = $feb;

            $marStart = new Carbon('first day of March');
            $marEnd = new Carbon('last day of March');
            $marEnd = $marEnd->endOfMonth();
            $mar = Appointment::where('date', '>', $marStart)->where('date', '<', $marEnd)->count();
            $data['mar'] = $mar;

            $aprStart = new Carbon('first day of April');
            $aprEnd = new Carbon('last day of April');
            $aprEnd = $aprEnd->endOfMonth();
            $apr = Appointment::where('date', '>', $aprStart)->where('date', '<', $aprEnd)->count();
            $data['apr'] = $apr;

            $mayStart = new Carbon('first day of May');
            $mayEnd = new Carbon('last day of May');
            $mayEnd = $mayEnd->endOfMonth();
            $may = Appointment::where('date', '>', $mayStart)->where('date', '<', $mayEnd)->count();
            $data['may'] = $may;

            $junStart = new Carbon('first day of June');
            $junEnd = new Carbon('last day of June');
            $junEnd = $junEnd->endOfMonth();
            $jun = Appointment::where('date', '>', $junStart)->where('date', '<', $junEnd)->count();
            $data['jun'] = $jun;

            $julStart = new Carbon('first day of July');
            $julEnd = new Carbon('last day of July');
            $julEnd = $julEnd->endOfMonth();
            $jul = Appointment::where('date', '>', $julStart)->where('date', '<', $julEnd)->count();
            $data['jul'] = $jul;

            $augStart = new Carbon('first day of August');
            $augEnd = new Carbon('last day of August');
            $augEnd = $augEnd->endOfMonth();
            $aug = Appointment::where('date', '>', $augStart)->where('date', '<', $augEnd)->count();
            $data['aug'] = $aug;

            $sepStart = new Carbon('first day of September');
            $sepEnd = new Carbon('last day of September');
            $sepEnd = $sepEnd->endOfMonth();
            $sep = Appointment::where('date', '>', $sepStart)->where('date', '<', $sepEnd)->count();
            $data['sep'] = $sep;

            $octStart = new Carbon('first day of October');
            $octEnd = new Carbon('last day of October');
            $octEnd = $octEnd->endOfMonth();
            $oct = Appointment::where('date', '>', $octStart)->where('date', '<', $octEnd)->count();
            $data['oct'] = $oct;

            $novStart = new Carbon('first day of November');
            $novEnd = new Carbon('last day of November');
            $novEnd = $novEnd->endOfMonth();
            $nov = Appointment::where('date', '>', $novStart)->where('date', '<', $novEnd)->count();
            $data['nov'] = $nov;

            $decStart = new Carbon('first day of December');
            $decEnd = new Carbon('last day of December');
            $decEnd = $decEnd->endOfMonth();
            $dec = Appointment::where('date', '>', $decStart)->where('date', '<', $decEnd)->count();
            $data['dec'] = $dec;

        } elseif ($year == '2019') {
            $janStart = new Carbon('first day of January 2019');
            $janEnd = new Carbon('last day of January 2019');
            $janEnd = $janEnd->endOfMonth();
            $jan = Appointment::where('date', '>', $janStart)->where('date', '<', $janEnd)->count();
            $data['jan'] = $jan;

            $febStart = new Carbon('first day of February 2019');
            $febEnd = new Carbon('last day of February 2019');
            $febEnd = $febEnd->endOfMonth();
            $feb = Appointment::where('date', '>', $febStart)->where('date', '<', $febEnd)->count();
            $data['feb'] = $feb;

            $marStart = new Carbon('first day of March 2019');
            $marEnd = new Carbon('last day of March 2019');
            $marEnd = $marEnd->endOfMonth();
            $mar = Appointment::where('date', '>', $marStart)->where('date', '<', $marEnd)->count();
            $data['mar'] = $mar;

            $aprStart = new Carbon('first day of April 2019');
            $aprEnd = new Carbon('last day of April 2019');
            $aprEnd = $aprEnd->endOfMonth();
            $apr = Appointment::where('date', '>', $aprStart)->where('date', '<', $aprEnd)->count();
            $data['apr'] = $apr;

            $mayStart = new Carbon('first day of May 2019');
            $mayEnd = new Carbon('last day of May 2019');
            $mayEnd = $mayEnd->endOfMonth();
            $may = Appointment::where('date', '>', $mayStart)->where('date', '<', $mayEnd)->count();
            $data['may'] = $may;

            $junStart = new Carbon('first day of June 2019');
            $junEnd = new Carbon('last day of June 2019');
            $junEnd = $junEnd->endOfMonth();
            $jun = Appointment::where('date', '>', $junStart)->where('date', '<', $junEnd)->count();
            $data['jun'] = $jun;

            $julStart = new Carbon('first day of July 2019');
            $julEnd = new Carbon('last day of July 2019');
            $julEnd = $julEnd->endOfMonth();
            $jul = Appointment::where('date', '>', $julStart)->where('date', '<', $julEnd)->count();
            $data['jul'] = $jul;

            $augStart = new Carbon('first day of August 2019');
            $augEnd = new Carbon('last day of August 2019');
            $augEnd = $augEnd->endOfMonth();
            $aug = Appointment::where('date', '>', $augStart)->where('date', '<', $augEnd)->count();
            $data['aug'] = $aug;

            $sepStart = new Carbon('first day of September 2019');
            $sepEnd = new Carbon('last day of September 2019');
            $sepEnd = $sepEnd->endOfMonth();
            $sep = Appointment::where('date', '>', $sepStart)->where('date', '<', $sepEnd)->count();
            $data['sep'] = $sep;

            $octStart = new Carbon('first day of October 2019');
            $octEnd = new Carbon('last day of October 2019');
            $octEnd = $octEnd->endOfMonth();
            $oct = Appointment::where('date', '>', $octStart)->where('date', '<', $octEnd)->count();
            $data['oct'] = $oct;

            $novStart = new Carbon('first day of November 2019');
            $novEnd = new Carbon('last day of November 2019');
            $novEnd = $novEnd->endOfMonth();
            $nov = Appointment::where('date', '>', $novStart)->where('date', '<', $novEnd)->count();
            $data['nov'] = $nov;

            $decStart = new Carbon('first day of December 2019');
            $decEnd = new Carbon('last day of December 2019');
            $decEnd = $decEnd->endOfMonth();
            $dec = Appointment::where('date', '>', $decStart)->where('date', '<', $decEnd)->count();
            $data['dec'] = $dec;
        } elseif ($year == '2018') {
            $janStart = new Carbon('first day of January 2018');
            $janEnd = new Carbon('last day of January 2018');
            $janEnd = $janEnd->endOfMonth();
            $jan = Appointment::where('date', '>', $janStart)->where('date', '<', $janEnd)->count();
            $data['jan'] = $jan;

            $febStart = new Carbon('first day of February 2018');
            $febEnd = new Carbon('last day of February 2018');
            $febEnd = $febEnd->endOfMonth();
            $feb = Appointment::where('date', '>', $febStart)->where('date', '<', $febEnd)->count();
            $data['feb'] = $feb;

            $marStart = new Carbon('first day of March 2018');
            $marEnd = new Carbon('last day of March 2018');
            $marEnd = $marEnd->endOfMonth();
            $mar = Appointment::where('date', '>', $marStart)->where('date', '<', $marEnd)->count();
            $data['mar'] = $mar;

            $aprStart = new Carbon('first day of April 2018');
            $aprEnd = new Carbon('last day of April 2018');
            $aprEnd = $aprEnd->endOfMonth();
            $apr = Appointment::where('date', '>', $aprStart)->where('date', '<', $aprEnd)->count();
            $data['apr'] = $apr;

            $mayStart = new Carbon('first day of May 2018');
            $mayEnd = new Carbon('last day of May 2018');
            $mayEnd = $mayEnd->endOfMonth();
            $may = Appointment::where('date', '>', $mayStart)->where('date', '<', $mayEnd)->count();
            $data['may'] = $may;

            $junStart = new Carbon('first day of June 2018');
            $junEnd = new Carbon('last day of June 2018');
            $junEnd = $junEnd->endOfMonth();
            $jun = Appointment::where('date', '>', $junStart)->where('date', '<', $junEnd)->count();
            $data['jun'] = $jun;

            $julStart = new Carbon('first day of July 2018');
            $julEnd = new Carbon('last day of July 2018');
            $julEnd = $julEnd->endOfMonth();
            $jul = Appointment::where('date', '>', $julStart)->where('date', '<', $julEnd)->count();
            $data['jul'] = $jul;

            $augStart = new Carbon('first day of August 2018');
            $augEnd = new Carbon('last day of August 2018');
            $augEnd = $augEnd->endOfMonth();
            $aug = Appointment::where('date', '>', $augStart)->where('date', '<', $augEnd)->count();
            $data['aug'] = $aug;

            $sepStart = new Carbon('first day of September 2018');
            $sepEnd = new Carbon('last day of September 2018');
            $sepEnd = $sepEnd->endOfMonth();
            $sep = Appointment::where('date', '>', $sepStart)->where('date', '<', $sepEnd)->count();
            $data['sep'] = $sep;

            $octStart = new Carbon('first day of October 2018');
            $octEnd = new Carbon('last day of October 2018');
            $octEnd = $octEnd->endOfMonth();
            $oct = Appointment::where('date', '>', $octStart)->where('date', '<', $octEnd)->count();
            $data['oct'] = $oct;

            $novStart = new Carbon('first day of November 2018');
            $novEnd = new Carbon('last day of November 2018');
            $novEnd = $novEnd->endOfMonth();
            $nov = Appointment::where('date', '>', $novStart)->where('date', '<', $novEnd)->count();
            $data['nov'] = $nov;

            $decStart = new Carbon('first day of December 2018');
            $decEnd = new Carbon('last day of December 2018');
            $decEnd = $decEnd->endOfMonth();
            $dec = Appointment::where('date', '>', $decStart)->where('date', '<', $decEnd)->count();
            $data['dec'] = $dec;
        } elseif ($year == '2017') {
            $janStart = new Carbon('first day of January 2017');
            $janEnd = new Carbon('last day of January 2017');
            $janEnd = $janEnd->endOfMonth();
            $jan = Appointment::where('date', '>', $janStart)->where('date', '<', $janEnd)->count();
            $data['jan'] = $jan;

            $febStart = new Carbon('first day of February 2017');
            $febEnd = new Carbon('last day of February 2017');
            $febEnd = $febEnd->endOfMonth();
            $feb = Appointment::where('date', '>', $febStart)->where('date', '<', $febEnd)->count();
            $data['feb'] = $feb;

            $marStart = new Carbon('first day of March 2017');
            $marEnd = new Carbon('last day of March 2017');
            $marEnd = $marEnd->endOfMonth();
            $mar = Appointment::where('date', '>', $marStart)->where('date', '<', $marEnd)->count();
            $data['mar'] = $mar;

            $aprStart = new Carbon('first day of April 2017');
            $aprEnd = new Carbon('last day of April 2017');
            $aprEnd = $aprEnd->endOfMonth();
            $apr = Appointment::where('date', '>', $aprStart)->where('date', '<', $aprEnd)->count();
            $data['apr'] = $apr;

            $mayStart = new Carbon('first day of May 2017');
            $mayEnd = new Carbon('last day of May 2017');
            $mayEnd = $mayEnd->endOfMonth();
            $may = Appointment::where('date', '>', $mayStart)->where('date', '<', $mayEnd)->count();
            $data['may'] = $may;

            $junStart = new Carbon('first day of June 2017');
            $junEnd = new Carbon('last day of June 2017');
            $junEnd = $junEnd->endOfMonth();
            $jun = Appointment::where('date', '>', $junStart)->where('date', '<', $junEnd)->count();
            $data['jun'] = $jun;

            $julStart = new Carbon('first day of July 2017');
            $julEnd = new Carbon('last day of July 2017');
            $julEnd = $julEnd->endOfMonth();
            $jul = Appointment::where('date', '>', $julStart)->where('date', '<', $julEnd)->count();
            $data['jul'] = $jul;

            $augStart = new Carbon('first day of August 2017');
            $augEnd = new Carbon('last day of August 2017');
            $augEnd = $augEnd->endOfMonth();
            $aug = Appointment::where('date', '>', $augStart)->where('date', '<', $augEnd)->count();
            $data['aug'] = $aug;

            $sepStart = new Carbon('first day of September 2017');
            $sepEnd = new Carbon('last day of September 2017');
            $sepEnd = $sepEnd->endOfMonth();
            $sep = Appointment::where('date', '>', $sepStart)->where('date', '<', $sepEnd)->count();
            $data['sep'] = $sep;

            $octStart = new Carbon('first day of October 2017');
            $octEnd = new Carbon('last day of October 2017');
            $octEnd = $octEnd->endOfMonth();
            $oct = Appointment::where('date', '>', $octStart)->where('date', '<', $octEnd)->count();
            $data['oct'] = $oct;

            $novStart = new Carbon('first day of November 2017');
            $novEnd = new Carbon('last day of November 2017');
            $novEnd = $novEnd->endOfMonth();
            $nov = Appointment::where('date', '>', $novStart)->where('date', '<', $novEnd)->count();
            $data['nov'] = $nov;

            $decStart = new Carbon('first day of December 2017');
            $decEnd = new Carbon('last day of December 2017');
            $decEnd = $decEnd->endOfMonth();
            $dec = Appointment::where('date', '>', $decStart)->where('date', '<', $decEnd)->count();
            $data['dec'] = $dec;
        }

        $sum = $jan + $feb + $mar + $apr + $may + $jun + $jul + $aug + $sep + $oct + $nov + $dec;


        return response()->json(['data' => $data,'sum' => $sum]);
    }


    public function patientByYear($year)
    {

        if ($year == '2020') {

            $janStart = new Carbon('first day of January');
            $janEnd = new Carbon('last day of January');
            $janEnd = $janEnd->endOfMonth();
            $jan = Patient::where('created_at', '>', $janStart)->where('created_at', '<', $janEnd)->count();
            $data['jan'] = $jan;

            $febStart = new Carbon('first day of February');
            $febEnd = new Carbon('last day of February');
            $febEnd = $febEnd->endOfMonth();
            $feb = Patient::where('created_at', '>', $febStart)->where('created_at', '<', $febEnd)->count();
            $data['feb'] = $feb;

            $marStart = new Carbon('first day of March');
            $marEnd = new Carbon('last day of March');
            $marEnd = $marEnd->endOfMonth();
            $mar = Patient::where('created_at', '>', $marStart)->where('created_at', '<', $marEnd)->count();
            $data['mar'] = $mar;

            $aprStart = new Carbon('first day of April');
            $aprEnd = new Carbon('last day of April');
            $aprEnd = $aprEnd->endOfMonth();
            $apr = Patient::where('created_at', '>', $aprStart)->where('created_at', '<', $aprEnd)->count();
            $data['apr'] = $apr;

            $mayStart = new Carbon('first day of May');
            $mayEnd = new Carbon('last day of May');
            $mayEnd = $mayEnd->endOfMonth();
            $may = Patient::where('created_at', '>', $mayStart)->where('created_at', '<', $mayEnd)->count();
            $data['may'] = $may;

            $junStart = new Carbon('first day of June');
            $junEnd = new Carbon('last day of June');
            $junEnd = $junEnd->endOfMonth();
            $jun = Patient::where('created_at', '>', $junStart)->where('created_at', '<', $junEnd)->count();
            $data['jun'] = $jun;

            $julStart = new Carbon('first day of July');
            $julEnd = new Carbon('last day of July');
            $julEnd = $julEnd->endOfMonth();
            $jul = Patient::where('created_at', '>', $julStart)->where('created_at', '<', $julEnd)->count();
            $data['jul'] = $jul;

            $augStart = new Carbon('first day of August');
            $augEnd = new Carbon('last day of August');
            $augEnd = $augEnd->endOfMonth();
            $aug = Patient::where('created_at', '>', $augStart)->where('created_at', '<', $augEnd)->count();
            $data['aug'] = $aug;

            $sepStart = new Carbon('first day of September');
            $sepEnd = new Carbon('last day of September');
            $sepEnd = $sepEnd->endOfMonth();
            $sep = Patient::where('created_at', '>', $sepStart)->where('created_at', '<', $sepEnd)->count();
            $data['sep'] = $sep;

            $octStart = new Carbon('first day of October');
            $octEnd = new Carbon('last day of October');
            $octEnd = $octEnd->endOfMonth();
            $oct = Patient::where('created_at', '>', $octStart)->where('created_at', '<', $octEnd)->count();
            $data['oct'] = $oct;

            $novStart = new Carbon('first day of November');
            $novEnd = new Carbon('last day of November');
            $novEnd = $novEnd->endOfMonth();
            $nov = Patient::where('created_at', '>', $novStart)->where('created_at', '<', $novEnd)->count();
            $data['nov'] = $nov;

            $decStart = new Carbon('first day of December');
            $decEnd = new Carbon('last day of December');
            $decEnd = $decEnd->endOfMonth();
            $dec = Patient::where('created_at', '>', $decStart)->where('created_at', '<', $decEnd)->count();
            $data['dec'] = $dec;

        } elseif ($year == '2019') {
            $janStart = new Carbon('first day of January 2019');
            $janEnd = new Carbon('last day of January 2019');
            $janEnd = $janEnd->endOfMonth();
            $jan = Patient::where('created_at', '>', $janStart)->where('created_at', '<', $janEnd)->count();
            $data['jan'] = $jan;

            $febStart = new Carbon('first day of February 2019');
            $febEnd = new Carbon('last day of February 2019');
            $febEnd = $febEnd->endOfMonth();
            $feb = Patient::where('created_at', '>', $febStart)->where('created_at', '<', $febEnd)->count();
            $data['feb'] = $feb;

            $marStart = new Carbon('first day of March 2019');
            $marEnd = new Carbon('last day of March 2019');
            $marEnd = $marEnd->endOfMonth();
            $mar = Patient::where('created_at', '>', $marStart)->where('created_at', '<', $marEnd)->count();
            $data['mar'] = $mar;

            $aprStart = new Carbon('first day of April 2019');
            $aprEnd = new Carbon('last day of April 2019');
            $aprEnd = $aprEnd->endOfMonth();
            $apr = Patient::where('created_at', '>', $aprStart)->where('created_at', '<', $aprEnd)->count();
            $data['apr'] = $apr;

            $mayStart = new Carbon('first day of May 2019');
            $mayEnd = new Carbon('last day of May 2019');
            $mayEnd = $mayEnd->endOfMonth();
            $may = Patient::where('created_at', '>', $mayStart)->where('created_at', '<', $mayEnd)->count();
            $data['may'] = $may;

            $junStart = new Carbon('first day of June 2019');
            $junEnd = new Carbon('last day of June 2019');
            $junEnd = $junEnd->endOfMonth();
            $jun = Patient::where('created_at', '>', $junStart)->where('created_at', '<', $junEnd)->count();
            $data['jun'] = $jun;

            $julStart = new Carbon('first day of July 2019');
            $julEnd = new Carbon('last day of July 2019');
            $julEnd = $julEnd->endOfMonth();
            $jul = Patient::where('created_at', '>', $julStart)->where('created_at', '<', $julEnd)->count();
            $data['jul'] = $jul;

            $augStart = new Carbon('first day of August 2019');
            $augEnd = new Carbon('last day of August 2019');
            $augEnd = $augEnd->endOfMonth();
            $aug = Patient::where('created_at', '>', $augStart)->where('created_at', '<', $augEnd)->count();
            $data['aug'] = $aug;

            $sepStart = new Carbon('first day of September 2019');
            $sepEnd = new Carbon('last day of September 2019');
            $sepEnd = $sepEnd->endOfMonth();
            $sep = Patient::where('created_at', '>', $sepStart)->where('created_at', '<', $sepEnd)->count();
            $data['sep'] = $sep;

            $octStart = new Carbon('first day of October 2019');
            $octEnd = new Carbon('last day of October 2019');
            $octEnd = $octEnd->endOfMonth();
            $oct = Patient::where('created_at', '>', $octStart)->where('created_at', '<', $octEnd)->count();
            $data['oct'] = $oct;

            $novStart = new Carbon('first day of November 2019');
            $novEnd = new Carbon('last day of November 2019');
            $novEnd = $novEnd->endOfMonth();
            $nov = Patient::where('created_at', '>', $novStart)->where('created_at', '<', $novEnd)->count();
            $data['nov'] = $nov;

            $decStart = new Carbon('first day of December 2019');
            $decEnd = new Carbon('last day of December 2019');
            $decEnd = $decEnd->endOfMonth();
            $dec = Patient::where('created_at', '>', $decStart)->where('created_at', '<', $decEnd)->count();
            $data['dec'] = $dec;
        } elseif ($year == '2018') {
            $janStart = new Carbon('first day of January 2018');
            $janEnd = new Carbon('last day of January 2018');
            $janEnd = $janEnd->endOfMonth();
            $jan = Patient::where('created_at', '>', $janStart)->where('created_at', '<', $janEnd)->count();
            $data['jan'] = $jan;

            $febStart = new Carbon('first day of February 2018');
            $febEnd = new Carbon('last day of February 2018');
            $febEnd = $febEnd->endOfMonth();
            $feb = Patient::where('created_at', '>', $febStart)->where('created_at', '<', $febEnd)->count();
            $data['feb'] = $feb;

            $marStart = new Carbon('first day of March 2018');
            $marEnd = new Carbon('last day of March 2018');
            $marEnd = $marEnd->endOfMonth();
            $mar = Patient::where('created_at', '>', $marStart)->where('created_at', '<', $marEnd)->count();
            $data['mar'] = $mar;

            $aprStart = new Carbon('first day of April 2018');
            $aprEnd = new Carbon('last day of April 2018');
            $aprEnd = $aprEnd->endOfMonth();
            $apr = Patient::where('created_at', '>', $aprStart)->where('created_at', '<', $aprEnd)->count();
            $data['apr'] = $apr;

            $mayStart = new Carbon('first day of May 2018');
            $mayEnd = new Carbon('last day of May 2018');
            $mayEnd = $mayEnd->endOfMonth();
            $may = Patient::where('created_at', '>', $mayStart)->where('created_at', '<', $mayEnd)->count();
            $data['may'] = $may;

            $junStart = new Carbon('first day of June 2018');
            $junEnd = new Carbon('last day of June 2018');
            $junEnd = $junEnd->endOfMonth();
            $jun = Patient::where('created_at', '>', $junStart)->where('created_at', '<', $junEnd)->count();
            $data['jun'] = $jun;

            $julStart = new Carbon('first day of July 2018');
            $julEnd = new Carbon('last day of July 2018');
            $julEnd = $julEnd->endOfMonth();
            $jul = Patient::where('created_at', '>', $julStart)->where('created_at', '<', $julEnd)->count();
            $data['jul'] = $jul;

            $augStart = new Carbon('first day of August 2018');
            $augEnd = new Carbon('last day of August 2018');
            $augEnd = $augEnd->endOfMonth();
            $aug = Patient::where('created_at', '>', $augStart)->where('created_at', '<', $augEnd)->count();
            $data['aug'] = $aug;

            $sepStart = new Carbon('first day of September 2018');
            $sepEnd = new Carbon('last day of September 2018');
            $sepEnd = $sepEnd->endOfMonth();
            $sep = Patient::where('created_at', '>', $sepStart)->where('created_at', '<', $sepEnd)->count();
            $data['sep'] = $sep;

            $octStart = new Carbon('first day of October 2018');
            $octEnd = new Carbon('last day of October 2018');
            $octEnd = $octEnd->endOfMonth();
            $oct = Patient::where('created_at', '>', $octStart)->where('created_at', '<', $octEnd)->count();
            $data['oct'] = $oct;

            $novStart = new Carbon('first day of November 2018');
            $novEnd = new Carbon('last day of November 2018');
            $novEnd = $novEnd->endOfMonth();
            $nov = Patient::where('created_at', '>', $novStart)->where('created_at', '<', $novEnd)->count();
            $data['nov'] = $nov;

            $decStart = new Carbon('first day of December 2018');
            $decEnd = new Carbon('last day of December 2018');
            $decEnd = $decEnd->endOfMonth();
            $dec = Patient::where('created_at', '>', $decStart)->where('created_at', '<', $decEnd)->count();
            $data['dec'] = $dec;
        } elseif ($year == '2017') {
            $janStart = new Carbon('first day of January 2017');
            $janEnd = new Carbon('last day of January 2017');
            $janEnd = $janEnd->endOfMonth();
            $jan = Patient::where('created_at', '>', $janStart)->where('created_at', '<', $janEnd)->count();
            $data['jan'] = $jan;

            $febStart = new Carbon('first day of February 2017');
            $febEnd = new Carbon('last day of February 2017');
            $febEnd = $febEnd->endOfMonth();
            $feb = Patient::where('created_at', '>', $febStart)->where('created_at', '<', $febEnd)->count();
            $data['feb'] = $feb;

            $marStart = new Carbon('first day of March 2017');
            $marEnd = new Carbon('last day of March 2017');
            $marEnd = $marEnd->endOfMonth();
            $mar = Patient::where('created_at', '>', $marStart)->where('created_at', '<', $marEnd)->count();
            $data['mar'] = $mar;

            $aprStart = new Carbon('first day of April 2017');
            $aprEnd = new Carbon('last day of April 2017');
            $aprEnd = $aprEnd->endOfMonth();
            $apr = Patient::where('created_at', '>', $aprStart)->where('created_at', '<', $aprEnd)->count();
            $data['apr'] = $apr;

            $mayStart = new Carbon('first day of May 2017');
            $mayEnd = new Carbon('last day of May 2017');
            $mayEnd = $mayEnd->endOfMonth();
            $may = Patient::where('created_at', '>', $mayStart)->where('created_at', '<', $mayEnd)->count();
            $data['may'] = $may;

            $junStart = new Carbon('first day of June 2017');
            $junEnd = new Carbon('last day of June 2017');
            $junEnd = $junEnd->endOfMonth();
            $jun = Patient::where('created_at', '>', $junStart)->where('created_at', '<', $junEnd)->count();
            $data['jun'] = $jun;

            $julStart = new Carbon('first day of July 2017');
            $julEnd = new Carbon('last day of July 2017');
            $julEnd = $julEnd->endOfMonth();
            $jul = Patient::where('created_at', '>', $julStart)->where('created_at', '<', $julEnd)->count();
            $data['jul'] = $jul;

            $augStart = new Carbon('first day of August 2017');
            $augEnd = new Carbon('last day of August 2017');
            $augEnd = $augEnd->endOfMonth();
            $aug = Patient::where('created_at', '>', $augStart)->where('created_at', '<', $augEnd)->count();
            $data['aug'] = $aug;

            $sepStart = new Carbon('first day of September 2017');
            $sepEnd = new Carbon('last day of September 2017');
            $sepEnd = $sepEnd->endOfMonth();
            $sep = Patient::where('created_at', '>', $sepStart)->where('created_at', '<', $sepEnd)->count();
            $data['sep'] = $sep;

            $octStart = new Carbon('first day of October 2017');
            $octEnd = new Carbon('last day of October 2017');
            $octEnd = $octEnd->endOfMonth();
            $oct = Patient::where('created_at', '>', $octStart)->where('created_at', '<', $octEnd)->count();
            $data['oct'] = $oct;

            $novStart = new Carbon('first day of November 2017');
            $novEnd = new Carbon('last day of November 2017');
            $novEnd = $novEnd->endOfMonth();
            $nov = Patient::where('created_at', '>', $novStart)->where('created_at', '<', $novEnd)->count();
            $data['nov'] = $nov;

            $decStart = new Carbon('first day of December 2017');
            $decEnd = new Carbon('last day of December 2017');
            $decEnd = $decEnd->endOfMonth();
            $dec = Patient::where('created_at', '>', $decStart)->where('created_at', '<', $decEnd)->count();
            $data['dec'] = $dec;
        }

        $sum = $jan + $feb + $mar + $apr + $may + $jun + $jul + $aug + $sep + $oct + $nov + $dec;


        return response()->json(['data' => $data,'sum' => $sum]);
    }


    public function caserecordByYear($year)
    {

        if ($year == '2020') {

            $janStart = new Carbon('first day of January');
            $janEnd = new Carbon('last day of January');
            $janEnd = $janEnd->endOfMonth();
            $jan = CaseRecord::where('created_at', '>', $janStart)->where('created_at', '<', $janEnd)->count();
            $data['jan'] = $jan;

            $febStart = new Carbon('first day of February');
            $febEnd = new Carbon('last day of February');
            $febEnd = $febEnd->endOfMonth();
            $feb = CaseRecord::where('created_at', '>', $febStart)->where('created_at', '<', $febEnd)->count();
            $data['feb'] = $feb;

            $marStart = new Carbon('first day of March');
            $marEnd = new Carbon('last day of March');
            $marEnd = $marEnd->endOfMonth();
            $mar = CaseRecord::where('created_at', '>', $marStart)->where('created_at', '<', $marEnd)->count();
            $data['mar'] = $mar;

            $aprStart = new Carbon('first day of April');
            $aprEnd = new Carbon('last day of April');
            $aprEnd = $aprEnd->endOfMonth();
            $apr = CaseRecord::where('created_at', '>', $aprStart)->where('created_at', '<', $aprEnd)->count();
            $data['apr'] = $apr;

            $mayStart = new Carbon('first day of May');
            $mayEnd = new Carbon('last day of May');
            $mayEnd = $mayEnd->endOfMonth();
            $may = CaseRecord::where('created_at', '>', $mayStart)->where('created_at', '<', $mayEnd)->count();
            $data['may'] = $may;

            $junStart = new Carbon('first day of June');
            $junEnd = new Carbon('last day of June');
            $junEnd = $junEnd->endOfMonth();
            $jun = CaseRecord::where('created_at', '>', $junStart)->where('created_at', '<', $junEnd)->count();
            $data['jun'] = $jun;

            $julStart = new Carbon('first day of July');
            $julEnd = new Carbon('last day of July');
            $julEnd = $julEnd->endOfMonth();
            $jul = CaseRecord::where('created_at', '>', $julStart)->where('created_at', '<', $julEnd)->count();
            $data['jul'] = $jul;

            $augStart = new Carbon('first day of August');
            $augEnd = new Carbon('last day of August');
            $augEnd = $augEnd->endOfMonth();
            $aug = CaseRecord::where('created_at', '>', $augStart)->where('created_at', '<', $augEnd)->count();
            $data['aug'] = $aug;

            $sepStart = new Carbon('first day of September');
            $sepEnd = new Carbon('last day of September');
            $sepEnd = $sepEnd->endOfMonth();
            $sep = CaseRecord::where('created_at', '>', $sepStart)->where('created_at', '<', $sepEnd)->count();
            $data['sep'] = $sep;

            $octStart = new Carbon('first day of October');
            $octEnd = new Carbon('last day of October');
            $octEnd = $octEnd->endOfMonth();
            $oct = CaseRecord::where('created_at', '>', $octStart)->where('created_at', '<', $octEnd)->count();
            $data['oct'] = $oct;

            $novStart = new Carbon('first day of November');
            $novEnd = new Carbon('last day of November');
            $novEnd = $novEnd->endOfMonth();
            $nov = CaseRecord::where('created_at', '>', $novStart)->where('created_at', '<', $novEnd)->count();
            $data['nov'] = $nov;

            $decStart = new Carbon('first day of December');
            $decEnd = new Carbon('last day of December');
            $decEnd = $decEnd->endOfMonth();
            $dec = CaseRecord::where('created_at', '>', $decStart)->where('created_at', '<', $decEnd)->count();
            $data['dec'] = $dec;

        } elseif ($year == '2019') {
            $janStart = new Carbon('first day of January 2019');
            $janEnd = new Carbon('last day of January 2019');
            $janEnd = $janEnd->endOfMonth();
            $jan = CaseRecord::where('created_at', '>', $janStart)->where('created_at', '<', $janEnd)->count();
            $data['jan'] = $jan;

            $febStart = new Carbon('first day of February 2019');
            $febEnd = new Carbon('last day of February 2019');
            $febEnd = $febEnd->endOfMonth();
            $feb = CaseRecord::where('created_at', '>', $febStart)->where('created_at', '<', $febEnd)->count();
            $data['feb'] = $feb;

            $marStart = new Carbon('first day of March 2019');
            $marEnd = new Carbon('last day of March 2019');
            $marEnd = $marEnd->endOfMonth();
            $mar = CaseRecord::where('created_at', '>', $marStart)->where('created_at', '<', $marEnd)->count();
            $data['mar'] = $mar;

            $aprStart = new Carbon('first day of April 2019');
            $aprEnd = new Carbon('last day of April 2019');
            $aprEnd = $aprEnd->endOfMonth();
            $apr = CaseRecord::where('created_at', '>', $aprStart)->where('created_at', '<', $aprEnd)->count();
            $data['apr'] = $apr;

            $mayStart = new Carbon('first day of May 2019');
            $mayEnd = new Carbon('last day of May 2019');
            $mayEnd = $mayEnd->endOfMonth();
            $may = CaseRecord::where('created_at', '>', $mayStart)->where('created_at', '<', $mayEnd)->count();
            $data['may'] = $may;

            $junStart = new Carbon('first day of June 2019');
            $junEnd = new Carbon('last day of June 2019');
            $junEnd = $junEnd->endOfMonth();
            $jun = CaseRecord::where('created_at', '>', $junStart)->where('created_at', '<', $junEnd)->count();
            $data['jun'] = $jun;

            $julStart = new Carbon('first day of July 2019');
            $julEnd = new Carbon('last day of July 2019');
            $julEnd = $julEnd->endOfMonth();
            $jul = CaseRecord::where('created_at', '>', $julStart)->where('created_at', '<', $julEnd)->count();
            $data['jul'] = $jul;

            $augStart = new Carbon('first day of August 2019');
            $augEnd = new Carbon('last day of August 2019');
            $augEnd = $augEnd->endOfMonth();
            $aug = CaseRecord::where('created_at', '>', $augStart)->where('created_at', '<', $augEnd)->count();
            $data['aug'] = $aug;

            $sepStart = new Carbon('first day of September 2019');
            $sepEnd = new Carbon('last day of September 2019');
            $sepEnd = $sepEnd->endOfMonth();
            $sep = CaseRecord::where('created_at', '>', $sepStart)->where('created_at', '<', $sepEnd)->count();
            $data['sep'] = $sep;

            $octStart = new Carbon('first day of October 2019');
            $octEnd = new Carbon('last day of October 2019');
            $octEnd = $octEnd->endOfMonth();
            $oct = CaseRecord::where('created_at', '>', $octStart)->where('created_at', '<', $octEnd)->count();
            $data['oct'] = $oct;

            $novStart = new Carbon('first day of November 2019');
            $novEnd = new Carbon('last day of November 2019');
            $novEnd = $novEnd->endOfMonth();
            $nov = CaseRecord::where('created_at', '>', $novStart)->where('created_at', '<', $novEnd)->count();
            $data['nov'] = $nov;

            $decStart = new Carbon('first day of December 2019');
            $decEnd = new Carbon('last day of December 2019');
            $decEnd = $decEnd->endOfMonth();
            $dec = CaseRecord::where('created_at', '>', $decStart)->where('created_at', '<', $decEnd)->count();
            $data['dec'] = $dec;
        } elseif ($year == '2018') {
            $janStart = new Carbon('first day of January 2018');
            $janEnd = new Carbon('last day of January 2018');
            $janEnd = $janEnd->endOfMonth();
            $jan = CaseRecord::where('created_at', '>', $janStart)->where('created_at', '<', $janEnd)->count();
            $data['jan'] = $jan;

            $febStart = new Carbon('first day of February 2018');
            $febEnd = new Carbon('last day of February 2018');
            $febEnd = $febEnd->endOfMonth();
            $feb = CaseRecord::where('created_at', '>', $febStart)->where('created_at', '<', $febEnd)->count();
            $data['feb'] = $feb;

            $marStart = new Carbon('first day of March 2018');
            $marEnd = new Carbon('last day of March 2018');
            $marEnd = $marEnd->endOfMonth();
            $mar = CaseRecord::where('created_at', '>', $marStart)->where('created_at', '<', $marEnd)->count();
            $data['mar'] = $mar;

            $aprStart = new Carbon('first day of April 2018');
            $aprEnd = new Carbon('last day of April 2018');
            $aprEnd = $aprEnd->endOfMonth();
            $apr = CaseRecord::where('created_at', '>', $aprStart)->where('created_at', '<', $aprEnd)->count();
            $data['apr'] = $apr;

            $mayStart = new Carbon('first day of May 2018');
            $mayEnd = new Carbon('last day of May 2018');
            $mayEnd = $mayEnd->endOfMonth();
            $may = CaseRecord::where('created_at', '>', $mayStart)->where('created_at', '<', $mayEnd)->count();
            $data['may'] = $may;

            $junStart = new Carbon('first day of June 2018');
            $junEnd = new Carbon('last day of June 2018');
            $junEnd = $junEnd->endOfMonth();
            $jun = CaseRecord::where('created_at', '>', $junStart)->where('created_at', '<', $junEnd)->count();
            $data['jun'] = $jun;

            $julStart = new Carbon('first day of July 2018');
            $julEnd = new Carbon('last day of July 2018');
            $julEnd = $julEnd->endOfMonth();
            $jul = CaseRecord::where('created_at', '>', $julStart)->where('created_at', '<', $julEnd)->count();
            $data['jul'] = $jul;

            $augStart = new Carbon('first day of August 2018');
            $augEnd = new Carbon('last day of August 2018');
            $augEnd = $augEnd->endOfMonth();
            $aug = CaseRecord::where('created_at', '>', $augStart)->where('created_at', '<', $augEnd)->count();
            $data['aug'] = $aug;

            $sepStart = new Carbon('first day of September 2018');
            $sepEnd = new Carbon('last day of September 2018');
            $sepEnd = $sepEnd->endOfMonth();
            $sep = CaseRecord::where('created_at', '>', $sepStart)->where('created_at', '<', $sepEnd)->count();
            $data['sep'] = $sep;

            $octStart = new Carbon('first day of October 2018');
            $octEnd = new Carbon('last day of October 2018');
            $octEnd = $octEnd->endOfMonth();
            $oct = CaseRecord::where('created_at', '>', $octStart)->where('created_at', '<', $octEnd)->count();
            $data['oct'] = $oct;

            $novStart = new Carbon('first day of November 2018');
            $novEnd = new Carbon('last day of November 2018');
            $novEnd = $novEnd->endOfMonth();
            $nov = CaseRecord::where('created_at', '>', $novStart)->where('created_at', '<', $novEnd)->count();
            $data['nov'] = $nov;

            $decStart = new Carbon('first day of December 2018');
            $decEnd = new Carbon('last day of December 2018');
            $decEnd = $decEnd->endOfMonth();
            $dec = CaseRecord::where('created_at', '>', $decStart)->where('created_at', '<', $decEnd)->count();
            $data['dec'] = $dec;
        } elseif ($year == '2017') {
            $janStart = new Carbon('first day of January 2017');
            $janEnd = new Carbon('last day of January 2017');
            $janEnd = $janEnd->endOfMonth();
            $jan = CaseRecord::where('created_at', '>', $janStart)->where('created_at', '<', $janEnd)->count();
            $data['jan'] = $jan;

            $febStart = new Carbon('first day of February 2017');
            $febEnd = new Carbon('last day of February 2017');
            $febEnd = $febEnd->endOfMonth();
            $feb = CaseRecord::where('created_at', '>', $febStart)->where('created_at', '<', $febEnd)->count();
            $data['feb'] = $feb;

            $marStart = new Carbon('first day of March 2017');
            $marEnd = new Carbon('last day of March 2017');
            $marEnd = $marEnd->endOfMonth();
            $mar = CaseRecord::where('created_at', '>', $marStart)->where('created_at', '<', $marEnd)->count();
            $data['mar'] = $mar;

            $aprStart = new Carbon('first day of April 2017');
            $aprEnd = new Carbon('last day of April 2017');
            $aprEnd = $aprEnd->endOfMonth();
            $apr = CaseRecord::where('created_at', '>', $aprStart)->where('created_at', '<', $aprEnd)->count();
            $data['apr'] = $apr;

            $mayStart = new Carbon('first day of May 2017');
            $mayEnd = new Carbon('last day of May 2017');
            $mayEnd = $mayEnd->endOfMonth();
            $may = CaseRecord::where('created_at', '>', $mayStart)->where('created_at', '<', $mayEnd)->count();
            $data['may'] = $may;

            $junStart = new Carbon('first day of June 2017');
            $junEnd = new Carbon('last day of June 2017');
            $junEnd = $junEnd->endOfMonth();
            $jun = CaseRecord::where('created_at', '>', $junStart)->where('created_at', '<', $junEnd)->count();
            $data['jun'] = $jun;

            $julStart = new Carbon('first day of July 2017');
            $julEnd = new Carbon('last day of July 2017');
            $julEnd = $julEnd->endOfMonth();
            $jul = CaseRecord::where('created_at', '>', $julStart)->where('created_at', '<', $julEnd)->count();
            $data['jul'] = $jul;

            $augStart = new Carbon('first day of August 2017');
            $augEnd = new Carbon('last day of August 2017');
            $augEnd = $augEnd->endOfMonth();
            $aug = CaseRecord::where('created_at', '>', $augStart)->where('created_at', '<', $augEnd)->count();
            $data['aug'] = $aug;

            $sepStart = new Carbon('first day of September 2017');
            $sepEnd = new Carbon('last day of September 2017');
            $sepEnd = $sepEnd->endOfMonth();
            $sep = CaseRecord::where('created_at', '>', $sepStart)->where('created_at', '<', $sepEnd)->count();
            $data['sep'] = $sep;

            $octStart = new Carbon('first day of October 2017');
            $octEnd = new Carbon('last day of October 2017');
            $octEnd = $octEnd->endOfMonth();
            $oct = CaseRecord::where('created_at', '>', $octStart)->where('created_at', '<', $octEnd)->count();
            $data['oct'] = $oct;

            $novStart = new Carbon('first day of November 2017');
            $novEnd = new Carbon('last day of November 2017');
            $novEnd = $novEnd->endOfMonth();
            $nov = CaseRecord::where('created_at', '>', $novStart)->where('created_at', '<', $novEnd)->count();
            $data['nov'] = $nov;

            $decStart = new Carbon('first day of December 2017');
            $decEnd = new Carbon('last day of December 2017');
            $decEnd = $decEnd->endOfMonth();
            $dec = CaseRecord::where('created_at', '>', $decStart)->where('created_at', '<', $decEnd)->count();
            $data['dec'] = $dec;
        }

        $sum = $jan + $feb + $mar + $apr + $may + $jun + $jul + $aug + $sep + $oct + $nov + $dec;


        return response()->json(['data' => $data,'sum' => $sum]);
    }
}
