<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use DB;

use App\User;

use App\Course;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->advisor == 1) {
            $students = DB::table('course_registrations')
                ->select('users.id as id','users.name as user_name','courses.name as course_name', 'courses.credit as credit', 'course_registrations.credit as total')
                ->join('users','course_registrations.user_id','=','users.id')
                ->join('courses', 'course_registrations.course_id', '=', 'courses.id')
                ->where('users.name', '!=', Auth::user()->name)
                ->where('users.semester', Auth::user()->semester)
                ->where('users.year', Auth::user()->year)
                ->where('users.subject_id', Auth::user()->subject_id)
                ->where('course_registrations.status', 'unread')
                ->get();

            return view('home', [
                'students' => $students
            ]);
        }   else {
            $courses = DB::table('courses')->where('subject_id', '=', Auth::user()->subject_id)->get();

            return view('home', [
                'courses' => $courses
            ]);
        }
    }
}
