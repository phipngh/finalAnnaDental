<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProcessController extends Controller
{
       
    public function store(Request $request)
    {
        $rules = array(
            'title_crProcess'    =>  'required',
            'schedule_date_crProcess'    =>  'required',
            
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'title'        =>  $request->title_crProcess,
            'description'        =>  $request->description_crProcess,
            'note' => $request-> note_crProcess,
            'schedule_date' => $request-> schedule_date_crProcess,
            'schedule_time' => $request-> schedule_time_crProcess,
            'case_record_id' => $request-> case_record_id_crProcess,
        );
        Process::create($form_data);
        return response()->json(['success' => 'Data Added successfully.']);
    }


    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Process::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, Process $process)
    {
       

        $rules = array(
            'title_crProcess'    =>  'required',
            'schedule_date_crProcess'    =>  'required',
           
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'title'        =>  $request->title_crProcess,
            'description'        =>  $request->description_crProcess,
            'note' => $request-> note_crProcess,
            'schedule_date' => $request-> schedule_date_crProcess,
            'schedule_time' => $request-> schedule_time_crProcess,
            'case_record_id' => $request-> case_record_id_crProcess,
        );

        Process::whereId($request->hidden_id_crProcess)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function destroy($id)
    {
        $data = Process::findOrFail($id);  
        $data->delete();

    }

}
