<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Appointment;

class AppointmentController extends Controller
{

    public function store(Request $request)
    {
        $rules = array(
            'name'    =>  'required',
            'email'    =>  'required|email',
            'phonenumber'    =>  'required|numeric',
            'date'    =>  'required|after_or_equal:now|',
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

        Appointment::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
    }
}
