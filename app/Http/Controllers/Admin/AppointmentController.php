<?php

namespace App\Http\Controllers\Admin;

use App\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Carbon;
use App\Calendar;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Appointment::whereDate('date', '>=', Carbon::now('Asia/Ho_Chi_Minh'))->orderBy('is_accepted', 'asc')->orderBy('date')->get();
            
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    if ($data->is_accepted == 0) {
                        $button = '<button type="button" name="accept" id="' . $data->id . '" class="accept btn btn-success btn-sm rounded"><i class="fas fa-check"></i></button>';
                    } else {
                        $button = '<button type="button" name="pending" id="' . $data->id . '" class="pending btn btn-warning btn-sm rounded"><i class="fas fa-undo"></i></button>';
                    }
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-secondary btn-sm rounded"><i class="far fa-edit"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm rounded"><i class="fas fa-trash"></i></button>';
                    return $button;
                })
                // ->editColumn('date', function ($data) {

                //     return  \Carbon\Carbon::parse($data->date)->format('H:i || d/m/Y');
                // })
                ->editColumn('created_at', function ($data) {

                    return  \Carbon\Carbon::parse($data->created_at)->diffForHumans();
                })
                ->rawColumns(['action', 'date'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('Admin.Appointment.index');
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Appointment::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, Appointment $appointment)
    {
        $rules = array(
            'name'        =>  'required',
            'email'        =>  'required',
            'phonenumber'        =>  'required',
            'date'        =>  'required|after_or_equal:now',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'name'        =>  $request->name,
            'email'        =>  $request->email,
            'phonenumber'        =>  $request->phonenumber,
            'date'        =>  $request->date,
            'note'        =>  $request->note,
        );
        Appointment::whereId($request->hidden_id)->update($form_data);


        $app = Appointment::findOrFail($request->hidden_id);

        if ($app->is_accepted == 1) {
            $date = $request->date;
            $carbon_date = Carbon::parse($date);
            $carbon_date->addHours(1);

            $title = $request->name . ' | Examinition';

            $form_data_calendar = array(
                'title'        => $title,
                'start' => $date,
                'end' => $carbon_date,
                'duration' => 1,

            );
            Calendar::where('appointment_id', $app->id)->update($form_data_calendar);
        }


        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function destroy($id)
    {
        $data = Appointment::findOrFail($id);
        if ($data->is_accepted == 1) {
            Calendar::where('appointment_id', $id)->delete();
        }
        $data->delete();
    }

    public function accept($id)
    {
        $form_data = array(
            'is_accepted'        =>  1,
        );
        Appointment::whereId($id)->update($form_data);

        $app = Appointment::findOrFail($id);

        $date = $app->date;
        $carbon_date = Carbon::parse($date);
        $carbon_date->addHours(1);

        $title = $app->name . ' | Examination';

        $form_data_calendar = array(
            'title'        => $title,
            'start' => $date,
            'end' => $carbon_date,
            'duration' => 1,
            'color' => '#348cd4',
            'appointment_id' => $app->id,
        );

        Calendar::create($form_data_calendar);
    }

    public function pending($id)
    {
        $form_data = array(
            'is_accepted'        =>  0,
        );
        Appointment::whereId($id)->update($form_data);

        Calendar::where('appointment_id', $id)->delete();
    }

    // Test 2nd Table
    public function index2(Request $request)
    {
        if ($request->ajax()) {
            $data = Appointment::whereDate('date', '<', Carbon::now('Asia/Ho_Chi_Minh'))->orderBy('date')->get();

            
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-secondary btn-sm rounded"><i class="far fa-edit"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm rounded"><i class="fas fa-trash"></i></button>';
                    return $button;
                })
                // ->editColumn('date', function ($data) {

                //     return  \Carbon\Carbon::parse($data->date)->format('H:i || d/m/Y');
                // })
                ->editColumn('created_at', function ($data) {

                    return  \Carbon\Carbon::parse($data->created_at)->diffForHumans();
                })
                ->rawColumns(['action', 'date'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('Admin.Appointment.index');
    }
}
