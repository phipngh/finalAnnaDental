<?php

namespace App\Http\Controllers\Admin;

use App\CaseRecord;
use App\Http\Controllers\Controller;
use App\InstallmentPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

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

        $IPn = InstallmentPlan::where('case_record_id',$request->case_record_id_crIPlan)->pluck('money')->sum();
        return response()->json(['success' => 'Data Added successfully.','data'=>$IPn]);
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
        $IPn = InstallmentPlan::where('case_record_id',$request->case_record_id_crIPlan)->pluck('money')->sum();

        return response()->json(['success' => 'Data is successfully updated','data' => $IPn]);
    }

    public function destroy($id)
    {
        $data = InstallmentPlan::findOrFail($id);  
        $data->delete();

        $IPn = InstallmentPlan::where('case_record_id',$data->case_record_id)->pluck('money')->sum();
        return response()->json(['success' => 'Data is successfully updated','data' => $IPn]);

    }



    ////////////////////////////////////////////

    public function index2(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = InstallmentPlan::where('case_record_id', $id)->get();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {

                    $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit_crIPlan btn btn-secondary btn-sm rounded"><i class="far fa-edit"></i></button>';
                    $button .= '&nbsp;<button type="button" name="delete" id="' . $data->id . '" class="delete_crIPlan btn btn-danger btn-sm rounded"><i class="fas fa-trash"></i></button>';
                    return $button;
                })
                ->editColumn('created_at', function ($data) {

                    return date('d-m-Y', strtotime($data->created_at));
                })
                

                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('Admin.CaseRecord.detail');
    }

}
