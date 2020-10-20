<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Service;
use App\Helper\Helper as Helper;



class ServiceController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Service::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-info btn-sm rounded">Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm rounded">Delete</button>';
                    return $button;
                })
                ->editColumn('description', function ($data) {
                    if($data->description == ''){
                        return '<span class="badge badge-pill badge-warning">Empty</span>';
                    }else{
                        return $data->description;
                    }
                })
                ->editColumn('note', function ($data) {
                    if($data->note == ''){
                        return '<span class="badge badge-pill badge-warning">Empty</span>';
                    }else{
                        return $data->note;
                    }
                })
                ->rawColumns(['action','description','note','ordinal'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('Admin.Services.index');
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
            'description'        =>  $request->description,
            'note'        =>  $request->note,
            
        );

        Service::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
    }


    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Service::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, Service $service)
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
            // 'slug'        =>  $request->name,
            'price'        =>  $request->price,
            'slug'        =>  Helper::slugify($request->name),
            'description'        =>  $request->description,
            'note'        =>  $request->note,
           
        );

        Service::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function destroy($id)
    {
        $data = Service::findOrFail($id);
        $data->delete();
    }
}
