<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Message;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $rules = array(
            'name'    =>  'required',
            'email'    =>  'required|email',
            'message'    =>  'required',   
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'name'        =>  $request->name,
            'email'        =>  $request->email,
            'message'        =>  $request->message,   
        );

        Message::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
    }
}
