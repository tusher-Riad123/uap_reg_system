<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use DB;

use App\User;

use App\CourseRegistration;

class StudentRecordController extends Controller
{
    public function index() {
        $subjects = DB::table('subjects')->get();

        return view('auth.register', [
            'subjects' => $subjects
        ]);
    }

    public function course(Request $request) {
        $sum = 0;
        $course_ids = $request->course_id;
        foreach($course_ids as $id) {
            $credits[] = DB::table('courses')->where('id', $id)->pluck('credit');
        }
        $credits = array_merge(json_decode(json_encode($credits,true),true));
        foreach($credits as $credit) {
            $sum += $credit[0];
        }

        $total_credit = $sum + (int)$request->credit;

        if($total_credit <= 24) {
            $course = new CourseRegistration();

            $course->credit = $request->credit;
            foreach($course_ids as $id) {
            $course->course_id = $id;
            }
            $course->user_id = Auth::user()->id;
            $course->total_credit = $total_credit;

            $course->save();
            return redirect('/home')->with('status', 'Your advisor has got the application');
        }   else {
            return redirect('/home')->with('status', 'Please calculate credit. you cant get over 24 credit in one semester');
        }
    }

    public function approve(Request $request) {
        CourseRegistration::where('user_id', $request->id)->update(array('status' => "approve"));

        return redirect('/home')->with('status', "Student Approved");
    }

    public function deny(Request $request) {
        CourseRegistration::where('user_id', $request->id)->update(array('status' => "rejected"));

        return redirect('/home')->with('status', "Student Rejected");
    }
}
