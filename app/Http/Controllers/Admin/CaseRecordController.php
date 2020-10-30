<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\CaseRecord;
use App\CaseRecordDetail;
use App\Doctor;
use App\InstallmentPlan;
use App\Process;
use App\Service;


class CaseRecordController extends Controller
{

    public function store(Request $request)
    {
        $rules = array(
            'name_create'    =>  'required',


            // 'slug'    =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'name'        =>  $request->name_create,
            'doctor_id'        =>  $request->doctor_id_create,
            'description'        =>  $request->description_create,
            'total_fee' => 0,
            'note'        =>  $request->note_create,
            'is_instalment_plant'        =>  $request->has('is_instalment_plan_create'),
            'is_paied'        =>  $request->has('is_paid_create'),
            'patient_id'        =>  $request->patient_id_create,

        );

        CaseRecord::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = CaseRecord::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, CaseRecord $caserecord)
    {
        $rules = array(
            'name_create'        =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'name'        =>  $request->name_create,
            'doctor_id'        =>  $request->doctor_id_create,
            'description'        =>  $request->description_create,
            'note'        =>  $request->note_create,
            
            'is_instalment_plant'        =>  $request->has('is_instalment_plan_create'),
          
            // 'is_paied'        =>  $request->has('is_paid_create'),
            'is_paied'        =>  $request->has('is_paid_create'),
            'patient_id'        =>  $request->patient_id_create,

        );

        CaseRecord::whereId($request->hidden_id_create)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function destroy($id)
    {
        $data = CaseRecord::findOrFail($id);
        $data->delete();
    }

    public function detail($id){
        $caserecord = CaseRecord::find($id);
        $doctors = Doctor::all();
        $crds = CaseRecordDetail::where('case_record_id',$id)->get();
        $crips = InstallmentPlan::where('case_record_id',$id)->get();
        $crps = Process::where('case_record_id',$id)->get();
        $services = Service::all();
        return view('Admin.CaseRecord.detail',compact('caserecord','doctors','crds','services','crips','crps'));
    }
}
