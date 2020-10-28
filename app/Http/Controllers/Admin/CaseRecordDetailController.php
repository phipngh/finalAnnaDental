<?php

namespace App\Http\Controllers\Admin;

use App\CaseRecord;
use App\CaseRecordDetail;
use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class CaseRecordDetailController extends Controller
{
   
    public function store(Request $request)
    {
        $form_data = array(
            'service_id'        =>  $request->service_id_crDetail,
            'case_record_id'        =>  $request->case_record_id_crDetail,
            'note' => $request-> note_crDetail
        );
        CaseRecordDetail::create($form_data);
        $sv = Service::find($request->service_id_crDetail);                   
        $cr = CaseRecord::find($request->case_record_id_crDetail);
        $cr->total_fee = $cr->total_fee + $sv->price;  
        $cr->save();
        
        return response()->json(['success' => 'Data Added successfully.']);
    }


    public function edit($id)
    {
        if (request()->ajax()) {
            $data = CaseRecordDetail::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, CaseRecordDetail $caserecorddetail)
    {
       

        $form_data = array(
            'service_id'        =>  $request->service_id_crDetail,
            'case_record_id'        =>  $request->case_record_id_crDetail,
            'note' => $request-> note_crDetail
        );

                          
        $crd = CaseRecordDetail::find($request->hidden_id_crDetail);
        $cr = CaseRecord::find($crd->case_record_id);

        $svOld = Service::find($crd->service_id); 
        $svNew = Service::find($request->service_id_crDetail); 
        $cr->total_fee = $cr->total_fee - $svOld->price +  $svNew->price;
        $cr->save();

        CaseRecordDetail::whereId($request->hidden_id_crDetail)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function destroy($id)
    {
        $data = CaseRecordDetail::findOrFail($id);  
        $sv = Service::find($data->service_id);                   
        $cr = CaseRecord::find($data->case_record_id);
        $cr->total_fee = $cr->total_fee - $sv->price;  
        $cr->save();

        $data->delete();

    }

    
}
