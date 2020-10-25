<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Patient;
use App\Helper\Helper as Helper;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Patient::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="info" id="'.$data->id.'" class="info btn btn-info btn-sm rounded">Info</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<a href="/admin/patient/'.$data->id.'" class="btn btn-dark btn-sm rounded">Detail</a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-secondary btn-sm rounded">Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm rounded">Delete</button>';
                    return $button;
                })
                ->editColumn('info', function ($data) {
                    if($data->info == ''){
                        return '<span class="badge badge-pill badge-warning">Empty</span>';
                    }else{
                        return '<span class="badge badge-pill badge-success">Active</span>';
                    }
                })
                ->editColumn('note', function ($data) {
                    if($data->note == ''){
                        return '<span class="badge badge-pill badge-warning">Empty</span>';
                    }else{
                        return '<span class="badge badge-pill badge-success">Active</span>';
                    }
                })
                ->rawColumns(['action','info','note','ordinal'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('Admin.Patients.index');
    }

    public function store(Request $request){
        $rules = array(
            'name'    =>  'required|unique:patients',
            
            // 'slug'    =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
       
        $form_data = array(
            'name'        =>  $request->name,
            'birthday'        =>  $request->birthday,
            'sex'        =>  $request->sex,
            'email'        =>  $request->email,
            'phone'        =>  $request->phone,
            'address'        =>  $request->address,
            'image'        =>  $request->image,
            'info'        =>  $request->info,
            'note'        =>  $request->note, 
        );

        Patient::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
    }

    public function info($id)
    {
        if(request()->ajax())
        {
            $data = Patient::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }


    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Patient::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, Patient $patient)
    {
        $rules = array(
            'name'        =>  'required',
           
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'name'        =>  $request->name,
            'birthday'        =>  $request->birthday,
            'sex'        =>  $request->sex,
            'email'        =>  $request->email,
            'phone'        =>  $request->phone,
            'address'        =>  $request->address,
            'image'        =>  $request->image,
            'info'        =>  $request->info,
            'note'        =>  $request->note,
           
        );

        Patient::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function destroy($id)
    {
        $data = Patient::findOrFail($id);
        $data->delete();
    }


    public function detail($id){
        $patient = Patient::findOrFail($id);
        return view('Admin.Patients.detail',compact('patient'));
    }
}
