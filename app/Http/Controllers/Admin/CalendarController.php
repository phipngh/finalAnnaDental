<?php

namespace App\Http\Controllers\Admin;

use App\Calendar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use  Response;
use Illuminate\Support\Carbon;
use App\Process;

class CalendarController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {

            $event = Calendar::latest()->get();
            return Response::json($event);
        }
        return view('Admin.Calendar.index');
    }


    public function store(Request $request)
    {
        $rules = array(
            'title'    =>  'required',
            'start'    =>  'required|after_or_equal:now',
            'duration'    =>  'required|numeric',
        );

        
        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
           
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $date = $request->start;
        $carbon_date = Carbon::parse($date);
        $carbon_date->addHours($request->duration);

        $form_data = array(
            'title'        =>  $request->title,
            'start' => $request->start,
            'end' => $carbon_date,
            'duration' => $request->duration,
            'color' => $request->color,
        );
        $data = Calendar::create($form_data);


        return response()->json(['success' => 'Data Added successfully.', 'result' => $data]);
    }

    public function update(Request $request)
    {
        $rules = array(
            'title'    =>  'required',
            'start'    =>  'required|after_or_equal:now',
            'duration'    =>  'required|numeric',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $date = $request->start;
        $carbon_date = Carbon::parse($date);
        $carbon_date->addHours($request->duration);

        $form_data = array(
            'title'        =>  $request->title,
            'start' => $request->start,
            'end' => $carbon_date,
            'duration' => $request->duration,
            'color' => $request->color,
        );

        Calendar::whereId($request->event_id)->update($form_data);

        $calendar = Calendar::find($request->event_id);
        if (!empty($calendar->process_id)) {
            $form_data_process = array(
                'title'        =>  $calendar->title,
                'schedule_date' => $calendar->start,
                'duration' => $request->duration,
            );
            Process::whereId($calendar->process_id)->update($form_data_process);
        }

        $event = Calendar::whereId($request->event_id)->get();
        return response()->json(['result' => $event, 'success' => 'Data Added successfully.']);
        //return response()->json(['success' => 'Data Added successfully.']);
    }

    public function destroy($id)
    {
        $records = \DB::table('calendars')->Where('id', $id)->delete();
    }
}
