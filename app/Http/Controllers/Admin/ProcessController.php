<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Calendar;
use Yajra\DataTables\DataTables;

class ProcessController extends Controller
{

    public function store(Request $request)
    {
        $rules = array(
            'title_crProcess'    =>  'required',
            'schedule_date_crProcess'    =>  'required',
            'duration_crProcess'    =>  'required|numeric',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'title'        =>  $request->title_crProcess,
            'description'        =>  $request->description_crProcess,
            'note' => $request->note_crProcess,
            'schedule_date' => $request->schedule_date_crProcess,
            'duration' => $request->duration_crProcess,
            'case_record_id' => $request->case_record_id_crProcess,
        );
        $process = Process::create($form_data);

        $date = $request->schedule_date_crProcess;
        $carbon_date = Carbon::parse($date);
        $carbon_date->addHours($request->duration_crProcess);

        $title = $process->caserecord->patient->name . ' | ' . $process->title;

        $form_data_calendar = array(
            'title'        => $title,
            'start' => $process->schedule_date,
            'end' => $carbon_date,
            'duration' => $process->duration,
            'color' => $request->color_crProcess,
            'process_id' => $process->id,
        );
        Calendar::create($form_data_calendar);
        return response()->json(['success' => 'Data Added successfully.']);
    }


    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Process::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, Process $process)
    {


        $rules = array(
            'title_crProcess'    =>  'required',
            'schedule_date_crProcess'    =>  'required',
            'duration_crProcess'    =>  'required|numeric',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'title'        =>  $request->title_crProcess,
            'description'        =>  $request->description_crProcess,
            'note' => $request->note_crProcess,
            'schedule_date' => $request->schedule_date_crProcess,
            'duration' => $request->duration_crProcess,
            'case_record_id' => $request->case_record_id_crProcess,
        );

        Process::whereId($request->hidden_id_crProcess)->update($form_data);
        $process = Process::find($request->hidden_id_crProcess);

        $date = $request->schedule_date_crProcess;
        $carbon_date = Carbon::parse($date);
        $carbon_date->addHours($request->duration_crProcess);

        $title = $process->caserecord->patient->name . ' | ' . $process->title;

        $form_data_calendar = array(
            'title'        => $title,
            'start' => $process->schedule_date,
            'end' => $carbon_date,
            'duration' => $process->duration,
            'color' => $request->color_crProcess,
        );
        Calendar::where('process_id', $process->id)->update($form_data_calendar);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function destroy($id)
    {
        $data = Process::findOrFail($id);
        Calendar::where('process_id', $data->id)->delete();
        $data->delete();
    }


    ////////////////////////////////////////////

    public function index2(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Process::where('case_record_id', $id)->get();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {

                    $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit_crProcess btn btn-secondary btn-sm rounded"><i class="far fa-edit"></i></button>';
                    $button .= '&nbsp;<button type="button" name="delete" id="' . $data->id . '" class="delete_crProcess btn btn-danger btn-sm rounded"><i class="fas fa-trash"></i></button>';
                    return $button;
                })
                ->editColumn('date', function ($data) {

                    return date('d-m-Y', strtotime($data->schedule_date));
                })
                ->editColumn('time', function ($data) {

                    return date('H:i', strtotime($data->schedule_date));
                })
                

                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('Admin.CaseRecord.detail');
    }
}
