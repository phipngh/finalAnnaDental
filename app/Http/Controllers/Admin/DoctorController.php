<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Doctor;
use App\CaseRecord;
use App\Helper\Helper as Helper;
use Intervention\Image\ImageManagerStatic as Image;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Doctor::orderBy('created_at')->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="info" id="' . $data->id . '" class="info btn btn-info btn-sm rounded"><i class="fas fa-info"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-secondary btn-sm rounded"><i class="far fa-edit"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="' . $data->id . '" class="delete btn btn-danger btn-sm rounded"><i class="fas fa-trash"></i></button>';
                    return $button;
                })
                ->editColumn('description', function ($data) {
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
                ->editColumn('name', function ($data) {
                    if(CaseRecord::where('doctor_id',$data->id)->exists()){
                        return '<a href="/admin/doctor/' . $data->id . '">' . $data->name . '</a>' . '<span class="badge badge-pill badge-success float-right">'.CaseRecord::where('doctor_id',$data->id)->count() .'</span>';
                    }else{
                        return '<a href="/admin/doctor/' . $data->id . '">' . $data->name . '</a>' . '<span class="badge badge-pill badge-danger float-right">New</span>';
                    }       
                })
                ->rawColumns(['action', 'description', 'note', 'ordinal', 'name'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('Admin.Doctors.index');
    }

    public function store(Request $request)
    {
        $rules = array(
            'name'    =>  'required|unique:doctors',
            
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
            //$image_resize->move('upload',$fullname);
        } else {
            $fullname = 'doctor.png';
        }

        $form_data = array(
            'name'        =>  $request->name,
            'major'        =>  $request->major,
            'birthday'        =>  $request->birthday,
            'sex'        =>  $request->sex,
            'email'        =>  $request->email,
            'phone'        =>  $request->phone,
            'address'        =>  $request->address,
            'image'        =>  $fullname,
            'info'        =>  $request->info,
            'note'        =>  $request->note,
        );

        Doctor::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
    }

    public function info($id)
    {
        if (request()->ajax()) {
            $data = Doctor::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }


    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Doctor::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, Doctor $doctor)
    {
        $doctor = Doctor::find($request->hidden_id);

        $rules = array(
            'name'        =>  'required',

        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $fullname = '';
        if ($request->hasFile('image')) {

            if (file_exists(public_path('upload/') . $doctor->image)) {
                if ($doctor->image == 'doctor.png') { }
                else {
                    unlink(public_path('upload/') . $doctor->image);
                }
            }

            

            $image = $request->image;
            $fullname = uniqid() . '_' . $image->getClientOriginalname();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(200, 200);
            $image_resize->save(public_path('upload/' . $fullname));
            //$form_data = array('image' => $fullname);
            // $doctor->image = $fullname;
            $form_data = array(
                'image' => $fullname,
            );
        }


        $form_data = array(
            'name'        =>  $request->name,
            'major'        =>  $request->major,
            'birthday'        =>  $request->birthday,
            'sex'        =>  $request->sex,
            'email'        =>  $request->email,
            'phone'        =>  $request->phone,
            'address'        =>  $request->address,
            'image'        =>  $fullname,
            'info'        =>  $request->info,
            'note'        =>  $request->note,

        );

        Doctor::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function destroy($id)
    {
        $data = Doctor::findOrFail($id);
        $data->delete();
    }

    public function detail($id)
    {
        $doctor = Doctor::findOrFail($id);   
        $caserecords = CaseRecord::where('doctor_id', $id)->get();
        //$doctor_cr = CaseRecord::where('doctor_id',$id)->get();
        $doctor_crs = CaseRecord::where('doctor_id', $id)->select('patient_id')->distinct()->get();
        return view('Admin.Doctors.detail', compact('doctor', 'caserecords','doctor_crs'));
    }
}
