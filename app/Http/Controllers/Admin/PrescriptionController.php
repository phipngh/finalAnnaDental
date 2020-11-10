<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Prescription;
use App\PrescriptionDetail;

class PrescriptionController extends Controller
{
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $rules = array(
                'Pquantity.*'  => 'required'
            );

            $error = Validator::make($request->all(), $rules);
            
            if ($error->fails()) {
                return response()->json([
                    'error'  => $error->errors()->all()
                ]);
            }

            $prescription = Prescription::create(['case_record_id' => $request->case_record_id_crPresc]);

            $Pmedicine = $request->Pmedicine;
            $Pquantity = $request->Pquantity;
            for ($count = 0; $count < count($Pquantity); $count++) {
                $data = array(
                    'prescription_id' => $prescription->id,
                    'medicine_id' => $Pmedicine[$count],
                    'quantity'  => $Pquantity[$count]
                );
                $insert_data[] = $data;
            }

            PrescriptionDetail::insert($insert_data);
            return response()->json([
                'success'  => 'Data Added successfully.'
            ]);
        }
    }

    public function detail($id){
        $pescr = Prescription::find($id);
        return view('Admin.Prescription.detail',compact('pescr'));
    }
}
