<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\CaseRecord;
use App\CaseRecordDetail;
use App\Doctor;
use App\InstallmentPlan;
use App\Medicine;
use App\Prescription;
use App\Process;
use App\Service;


class CaseRecordController extends Controller
{

    public function index(){

        $caserecords = CaseRecord::orderBy('created_at')->paginate(20);

        $doctors = Doctor::all();

        return view('Admin.CaseRecord.index',compact('caserecords','doctors'));
    }

    public function search(Request $request){

        $request->validate([
            'startDate'=>'required',
            'endDate'=>'required|after_or_equal:startDate',
        ]);

        $startDate = $request['startDate'];
        $endDate = $request['endDate'];

        $caserecords = CaseRecord::orderBy('created_at')->whereDate('created_at','>=',$startDate)->whereDate('created_at','<=',$endDate)->get();
        $doctors = Doctor::all();

        return view('Admin.CaseRecord.searchDate',compact('caserecords','startDate','endDate','doctors'));
    }


    public function store(Request $request)
    {
        $rules = array(
            'name_create'    =>  'required',
            'doctor_id_create'    =>  'required',


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

        $cr = CaseRecord::create($form_data);

        \File::makeDirectory(public_path()."/storage/files/1/CaseRecord/".$cr->id);
        

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

    public function description(Request $request, CaseRecord $caserecord)
    {
        $form_data = array(
            'description' => $request->description_form_description,
        );

        $data = CaseRecord::whereId($request->caserecord_id_description)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated', 'result' => $data]);
    }

    public function destroy($id)
    {
        $data = CaseRecord::findOrFail($id);
        $data->delete();
    }

    public function detail($id)
    {
        $caserecord = CaseRecord::find($id);
        $doctors = Doctor::all();
        $crds = CaseRecordDetail::where('case_record_id', $id)->get();
        $crips = InstallmentPlan::where('case_record_id', $id)->get();
        $crps = Process::where('case_record_id', $id)->get();
        $crprs = Prescription::where('case_record_id', $id)->get();
        $services = Service::all();
        $medicines = Medicine::all();

        $images = \File::allFiles(public_path("/storage/files/1/CaseRecord/".$id));
        return view('Admin.CaseRecord.detail', compact('caserecord', 'doctors', 'crds', 'services', 'crips', 'crps', 'medicines', 'crprs'));
    }

    public function invoice($id)
    {
        $caserecord = CaseRecord::find($id);
        return view('Admin.CaseRecord.invoice', compact('caserecord'));
    }

    public function restore($id){
        $cr = CaseRecord::withTrashed()->whereId($id);
        $cr->restore();
    }
}
