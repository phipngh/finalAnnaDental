<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Subcrible;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SubcribleController extends Controller
{
    public function index(Request $request)
    {
        $data = Subcrible::latest()->get();
        if ($request->ajax()) {
            
            
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm rounded"><i class="fas fa-trash"></i></button>';
                    return $button;
                })
                ->editColumn('created_at',function($data){
                    return date('d-m-Y', strtotime($data->created_at));
                })
                
                ->rawColumns(['action','created_at'])
                ->addIndexColumn()
                ->make(true);
        }

        
        return view('Admin.Subcrible.index',compact('data'));
    }

    public function destroy($id)
    {
        $data = Subcrible::findOrFail($id);
        $data->delete();
    }
}
