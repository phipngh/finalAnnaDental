<?php

namespace App\Http\Controllers\Admin;

use App\CaseRecord;
use App\CaseRecordDetail;
use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class CaseRecordDetailController extends Controller
{

    public function store(Request $request)
    {
        $rules = array(
            'quantity_crDetail'    =>  'required|numeric',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'service_id'        =>  $request->service_id_crDetail,
            'quantity'        =>  $request->quantity_crDetail,
            'case_record_id'        =>  $request->case_record_id_crDetail,
            'note' => $request->note_crDetail
        );
        CaseRecordDetail::create($form_data);
        $sv = Service::find($request->service_id_crDetail);
        $cr = CaseRecord::find($request->case_record_id_crDetail);
        $cr->total_fee +=  $sv->price * $request->quantity_crDetail;
        $cr->save();

        $datas = CaseRecordDetail::where('case_record_id',$request->case_record_id_crDetail)->get();
        $total = 0;
        foreach($datas as $data){
            $total += $data->service->price*$data->quantity;
        }
            
        return response()->json(['success' => 'Data Added successfully.','total' => $total]);
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
        $rules = array(
            'quantity_crDetail'    =>  'required|numeric',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'service_id'        =>  $request->service_id_crDetail,
            'quantity'        =>  $request->quantity_crDetail,
            'case_record_id'        =>  $request->case_record_id_crDetail,
            'note' => $request->note_crDetail
        );


        $crd = CaseRecordDetail::find($request->hidden_id_crDetail);
        $cr = CaseRecord::find($crd->case_record_id);

        $svOld = Service::find($crd->service_id);
        $qtyOld = $crd->quantity;

        $svNew = Service::find($request->service_id_crDetail);
        $qtyNew = $request->quantity_crDetail;

        $cr->total_fee = $cr->total_fee - ($svOld->price * $qtyOld) + ($svNew->price * $qtyNew);
        $cr->save();

        CaseRecordDetail::whereId($request->hidden_id_crDetail)->update($form_data);

        $datas = CaseRecordDetail::where('case_record_id',$request->case_record_id_crDetail)->get();
        $total = 0;
        foreach($datas as $data){
            $total += $data->service->price*$data->quantity;
        }

        return response()->json(['success' => 'Data is successfully updated','total' => $total]);
    }

    public function destroy($id)
    {
        $data = CaseRecordDetail::findOrFail($id);
        $sv = Service::find($data->service_id);
        $cr = CaseRecord::find($data->case_record_id);
        $cr->total_fee -=  $sv->price * $data->quantity;
        $cr->save();

        $data->delete();

        $datass = CaseRecordDetail::where('case_record_id',$data->case_record_id)->get();
        $total = 0;
        foreach($datass as $datas){
            $total += $datas->service->price*$datas->quantity;
        }

        return response()->json(['success' => 'Data is successfully updated','total' => $total]);
    }



    //TEST DATATABLE
    public function index2(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = CaseRecordDetail::where('case_record_id', $id)->get();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {

                    $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit_crDetail btn btn-secondary btn-sm rounded"><i class="far fa-edit"></i></button>';
                    $button .= '&nbsp;<button type="button" name="delete" id="' . $data->id . '" class="delete_crDetail btn btn-danger btn-sm rounded"><i class="fas fa-trash"></i></button>';
                    return $button;
                })
                ->editColumn('service_id', function ($data) {

                    return $data->service->name;
                })
                ->editColumn('price', function ($data) {

                    return $data->service->price;
                })
                

                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('Admin.CaseRecord.detail');
    }

    //END TEST DATATABLE

}
