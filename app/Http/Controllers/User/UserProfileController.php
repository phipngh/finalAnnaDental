<?php

namespace App\Http\Controllers\User;

use App\CaseRecord;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Patient;
use App\CaseRecordDetail;
use App\Prescription;
use App\Process;
use App\InstallmentPlan;

class UserProfileController extends Controller
{
    public function profile()
    {

        return view('User.profile');
    }

    public function changepassword(Request $request)
    {


        if (Auth::check()) {
            $request_data = $request->All();

            $rules = array(
                'current-password'        =>  'required',
                'password'        =>  'required|same:password',
                'password_confirmation' => 'required|same:password'
            );

            $error = Validator::make($request->all(), $rules);

            if ($error->fails()) {
                return response()->json(['errors' => $error->errors()->all()]);
            } else {
                $current_password = Auth::User()->password;
                if (Hash::check($request_data['current-password'], $current_password)) {
                    $user_id = Auth::User()->id;
                    $obj_user = User::find($user_id);
                    $obj_user->password = Hash::make($request_data['password']);
                    $obj_user->save();
                    return response()->json(['success' => 'ok roi']);
                } else {
                    // cant response properly
                    return response()->json(['wrong' => 'Invalid Current Password. Please Try Again.']);
                }
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function detail(Request $request, $id)
    {
        $caserecord = CaseRecord::findOrFail($id);
        $crds = CaseRecordDetail::where('case_record_id', $id)->get();
        $crips = InstallmentPlan::where('case_record_id', $id)->get();
        $crps = Process::where('case_record_id', $id)->get();
        $crprs = Prescription::where('case_record_id', $id)->get();
        $email = $caserecord->patient->email;
        if($email != Auth::user()->email){
            return redirect('/profile');
        }

        return view('User.caserecord',compact('caserecord','crds', 'crips', 'crps', 'crprs'));
    }

    public function presc($id){
        $presc = Prescription::find($id);
        if($presc->caserecord->patient->email != Auth::user()->email){
            return redirect('/profile');
        }
        return view('User.prescription',compact('presc'));
    }
}
