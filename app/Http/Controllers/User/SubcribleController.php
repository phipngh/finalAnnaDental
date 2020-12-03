<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Subcrible;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


use App\Jobs\SendEmailJob;
use Illuminate\Support\Carbon;

class SubcribleController extends Controller
{
    public function store(Request $request)
    {
        $rules = array(
            'subcrible_email' => 'required|email|unique:subcribles,email'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(

            'email'        =>  $request->subcrible_email,

        );
        Subcrible::create($form_data);

        $details = ['email' => $request->subcrible_email];
        SendEmailJob::dispatch($details);

        return response()->json(['success' => 'Data Added successfully.']);
    }
}
