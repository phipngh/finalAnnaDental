<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Medicine;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Helper\Helper as Helper;

class MedicineController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Medicine::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="info" id="'.$data->id.'" class="info btn btn-info btn-sm rounded">Info</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-secondary btn-sm rounded">Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm rounded">Delete</button>';
                    return $button;
                })
                ->editColumn('description', function ($data) {
                    if($data->description == ''){
                        return '<span class="badge badge-pill badge-warning">Empty</span>';
                    }else{
                        return '<span class="badge badge-pill badge-success">Active</span>';
                    }
                })
                ->editColumn('dose', function ($data) {
                    if($data->dose == ''){
                        return '<span class="badge badge-pill badge-warning">Empty</span>';
                    }else{
                        return '<span class="badge badge-pill badge-success">Active</span>';
                    }
                })
                ->editColumn('price', function ($data) {
                    
                    return '$ ' . $data->price;
                })
                ->editColumn('note', function ($data) {
                    if($data->note == ''){
                        return '<span class="badge badge-pill badge-warning">Empty</span>';
                    }else{
                        return '<span class="badge badge-pill badge-success">Active</span>';
                    }
                })
                ->rawColumns(['action','description','note','dose','ordinal'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('Admin.Medicines.index');
    }

    public function store(Request $request){
        $rules = array(
            'name'    =>  'required|unique:services',
            'price'    =>  'required|numeric',
            // 'slug'    =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
       
        $form_data = array(
            'name'        =>  $request->name,
            'price'        =>  $request->price,
            // 'slug'        =>  $request->name,
            'slug'        =>  Helper::slugify($request->name),
            'manufacturer' => $request->manufacturer,
            'image' => $request->image,
            'dose' => $request->dose,
            'description'        =>  $request->description,
            'note'        =>  $request->note,
            
        );

        Medicine::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
    }

    public function info($id)
    {
        if(request()->ajax())
        {
            $data = Medicine::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }


    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Medicine::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, Medicine $medicine)
    {
        $rules = array(
            'name'        =>  'required',
            'price'        =>  'required|numeric',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'name'        =>  $request->name,
            'price'        =>  $request->price,
            // 'slug'        =>  $request->name,
            'slug'        =>  Helper::slugify($request->name),
            'manufacturer' => $request->manufacturer,
            'image' => $request->image,
            'dose' => $request->dose,
            'description'        =>  $request->description,
            'note'        =>  $request->note,
           
        );

        Medicine::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function destroy($id)
    {
        $data = Medicine::findOrFail($id);
        $data->delete();
    }
}
