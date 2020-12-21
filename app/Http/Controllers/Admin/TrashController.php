<?php

namespace App\Http\Controllers\Admin;

use App\CaseRecord;
use App\CaseRecordDetail;
use App\Http\Controllers\Controller;
use App\InstallmentPlan;
use App\Prescription;
use App\PrescriptionDetail;
use App\Process;
use App\Patient;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Doctor;
use App\Service;

class TrashController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Patient::onlyTrashed()->orderBy('deleted_at')->get();
            
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    
                    $button = '<button type="button" name="restore" id="' . $data->id . '" class="restore btn btn-success btn-sm rounded"><i class="fas fa-undo"></i></button>';
                    return $button;
                })
                ->editColumn('deleted_at', function ($data) {

                    return  \Carbon\Carbon::parse($data->deleted_at)->diffForHumans();
                })
                ->editColumn('created_at', function ($data) {

                    return  date('d-m-Y', strtotime($data->created_at));;
                })
                
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('Admin.Trash.index');
    }

    public function index2(Request $request)
    {
        if ($request->ajax()) {
            $data = CaseRecord::onlyTrashed()->orderBy('deleted_at')->get();
            
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    
                    $button = '<button type="button" name="restore" id="' . $data->id . '" class="restore btn btn-success btn-sm rounded"><i class="fas fa-undo"></i></button>';
                    return $button;
                })
                ->editColumn('deleted_at', function ($data) {

                    return  \Carbon\Carbon::parse($data->deleted_at)->diffForHumans();
                })
                ->editColumn('created_at', function ($data) {

                    return  date('d-m-Y', strtotime($data->created_at));;
                })
                ->editColumn('patient_id', function ($data) {

                    $patient = Patient::withTrashed()->where('id',$data->patient_id)->first();
                    return $patient->name;
                })
                ->editColumn('doctor_id', function ($data) {

                    $dr = Doctor::withTrashed()->where('id',$data->doctor_id)->first();
                    return $dr->name;
                })
                
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('Admin.Trash.caserecord');
    }

    public function index3(Request $request)
    {
        if ($request->ajax()) {
            $data = CaseRecordDetail::onlyTrashed()->orderBy('deleted_at')->get();
            
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    
                    $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-secondary btn-sm rounded"><i class="far fa-edit"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm rounded"><i class="fas fa-trash"></i></button>';
                    return $button;
                })
                ->editColumn('deleted_at', function ($data) {

                    return  \Carbon\Carbon::parse($data->deleted_at)->diffForHumans();
                })
                ->editColumn('created_at', function ($data) {

                    return  date('d-m-Y', strtotime($data->created_at));;
                })
                ->editColumn('service_id', function ($data) {

                    $sv = Service::withTrashed()->where('id',$data->service_id)->first();
                    return $sv->name;
                })
                ->editColumn('case_record_id', function ($data) {

                    $cr = CaseRecord::withTrashed()->where('id',$data->case_record_id)->first();
                    return $cr->name;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('Admin.Trash.caserecorddetail');
    }


}
