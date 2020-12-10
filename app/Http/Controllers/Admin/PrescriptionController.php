<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Prescription;
use App\PrescriptionDetail;
use Yajra\DataTables\DataTables;

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


    public function destroy($id){
        $data = Prescription::findOrFail($id);  
        $data->delete();
    }


    ////////////////////////////////////////////

    public function index2(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Prescription::where('case_record_id', $id)->get();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    //href="{{route('admin.presciption.detail',$crpr->id)}}"
                    $button = '<a type="button" href="/admin/prescription/'.$data->id. '" name="edit" id="' . $data->id . '" class="edit btn btn-secondary btn-sm rounded" target="_blank"><i class="far fa-edit"></i></a>';
                    $button .= '&nbsp<button  name="delete" id="' . $data->id . '" class="delete_pre btn btn-danger btn-sm rounded"><i class="fas fa-trash"></i></button>';
                    return $button;
                })
                ->editColumn('date', function ($data) {

                    return date('d-m-Y', strtotime($data->created_at));
                })
                

                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('Admin.CaseRecord.detail');
    }
}
