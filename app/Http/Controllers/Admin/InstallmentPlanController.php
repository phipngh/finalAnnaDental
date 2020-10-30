<?php

namespace App\Http\Controllers\Admin;

use App\CaseRecord;
use App\Http\Controllers\Controller;
use App\InstallmentPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstallmentPlanController extends Controller
{
    
    public function store(Request $request)
    {
        $rules = array(
            'money_crIPlan'    =>  'required|numeric',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'money'        =>  $request->money_crIPlan,
            'case_record_id'        =>  $request->case_record_id_crIPlan,
            'note' => $request-> note_crIPlan
        );
        InstallmentPlan::create($form_data);
        return response()->json(['success' => 'Data Added successfully.']);
    }


    public function edit($id)
    {
        if (request()->ajax()) {
            $data = InstallmentPlan::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, InstallmentPlan $installmentplan)
    {
       

        $rules = array(
            'money_crIPlan'    =>  'required',
           
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'money'        =>  $request->money_crIPlan,
            'case_record_id'        =>  $request->case_record_id_crIPlan,
            'note' => $request-> note_crIPlan
        );

        InstallmentPlan::whereId($request->hidden_id_crIPlan)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function destroy($id)
    {
        $data = InstallmentPlan::findOrFail($id);  
        $data->delete();

    }

}
