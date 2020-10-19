<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Role::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-info btn-sm rounded">Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm rounded">Delete</button>';
                    return $button;
                })
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->diffForHumans();
                })
                ->rawColumns(['action','created_at','ordinal'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('Admin.Roles.index');
    }

    public function store(Request $request){
        $rules = array(
            'name'    =>  'required',
            'slug'    =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'name'        =>  $request->name,
            'slug'        =>  $request->slug,
        );

        Role::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
    }


    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Role::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, Role $role)
    {
        $rules = array(
            'name'        =>  'required',
            'slug'        =>  'required',

        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'name'    =>  $request->name,
            'slug'    =>  $request->slug,
        );

        Role::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function destroy($id)
    {
        $data = Role::findOrFail($id);
        $data->delete();
    }



}
