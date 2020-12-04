<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Message::latest()->get();
            
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
        return view('Admin.Message.index');
    }

    public function destroy($id)
    {
        $data = Message::findOrFail($id);
        $data->delete();
    }
}
