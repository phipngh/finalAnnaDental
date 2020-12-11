<?php

namespace App\Http\Controllers\Admin;

use App\CaseRecord;
use App\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Patient;
use App\Helper\Helper as Helper;
use Intervention\Image\ImageManagerStatic as Image;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Patient::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="info" id="' . $data->id . '" class="info btn btn-info btn-sm rounded"><i class="fas fa-info"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<a href="/admin/patient/' . $data->id . '" class="btn btn-dark btn-sm rounded"><i class="fas fa-id-card"></i></a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-secondary btn-sm rounded"><i class="far fa-edit"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="' . $data->id . '" class="delete btn btn-danger btn-sm rounded"><i class="fas fa-trash"></i></button>';
                    return $button;
                })
                ->editColumn('name', function ($data) {
                    $button = '<a href="/admin/patient/' . $data->id . '">' . $data->name . '</a>';
                    return $button;
                })
                ->editColumn('info', function ($data) {
                    if ($data->info == '') {
                        return '<span class="badge badge-pill badge-warning">Empty</span>';
                    } else {
                        return '<span class="badge badge-pill badge-success">Active</span>';
                    }
                })
                ->editColumn('note', function ($data) {
                    if ($data->note == '') {
                        return '<span class="badge badge-pill badge-warning">Empty</span>';
                    } else {
                        return '<span class="badge badge-pill badge-success">Active</span>';
                    }
                })
                ->rawColumns(['action', 'info', 'note', 'name', 'ordinal'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('Admin.Patients.index');
    }

    public function store(Request $request)
    {
        $rules = array(
            'name'    =>  'required|unique:patients',


            // 'slug'    =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $fullname = '';
        if ($request->hasFile('image')) {
            $image = $request->image;
            $fullname = uniqid() . '_' . $image->getClientOriginalname();
            //$image->move('upload',$fullname);
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(200, 200);
            $image_resize->save(public_path('upload/' . $fullname));
           
        } else {
            $fullname = 'DefaultAvatar.png';
        }

        $form_data = array(
            'name'        =>  $request->name,
            'birthday'        =>  $request->birthday,
            'sex'        =>  $request->sex,
            'email'        =>  $request->email,
            'phone'        =>  $request->phone,
            'address'        =>  $request->address,
            'image'        =>  $fullname,
            'info'        =>  $request->info,
            'note'        =>  $request->note,
        );

        Patient::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
    }

    public function info($id)
    {
        if (request()->ajax()) {
            $data = Patient::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }


    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Patient::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, Patient $patient)
    {
        $patient = Patient::find($request->hidden_id);

        $rules = array(
            'name'        =>  'required',

        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $fullname = '';

        if ($request->hasFile('image')) {

            if (file_exists(public_path('upload/') . $patient->image)) {
                if ($patient->image == 'DefaultAvatar.png') { } else {
                    unlink(public_path('upload/') . $patient->image);
                }
            }

            $image = $request->image;
            $fullname = uniqid() . '_' . $image->getClientOriginalname();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(200, 200);
            $image_resize->save(public_path('upload/' . $fullname));
            //$form_data = array('image' => $fullname);
            // $doctor->image = $fullname;

        }

        $form_data = array(
            'name'        =>  $request->name,
            'birthday'        =>  $request->birthday,
            'sex'        =>  $request->sex,
            'email'        =>  $request->email,
            'phone'        =>  $request->phone,
            'address'        =>  $request->address,
            'image'        =>  $fullname,
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

    // Detail Patient

    public function detail($id)
    {
        $patient = Patient::findOrFail($id);
        $doctors = Doctor::all();
        //$caserecords = DB::table('case_records')->where('patient_id',$id)->get();
        $caserecords = CaseRecord::where('patient_id', $id)->get();
        return view('Admin.Patients.detail', compact('patient', 'doctors', 'caserecords'));
    }

    public function restore($id){
        $patient = Patient::withTrashed()->whereId($id);
        $caserecord = CaseRecord::withTrashed()->where('patient_id',$id);

        $caserecord->restore();
        $patient->restore();
    }
}
