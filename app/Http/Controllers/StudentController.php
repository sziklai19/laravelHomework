<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Connection;
use App\Solution;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('type:student');
    }

    public function index()
    {
        $ids = [];
        foreach(Connection::where('connections.student', Auth::id())->get('connections.subject') as $item){
            array_push($ids, $item->subject);
        }
        $subjects = Subject::join('users', 'users.id', '=', 'subjects.teacher')
            ->whereIn('subjects.id', $ids)
            ->select('subjects.id', 'subjects.name', 'subjects.code', 'subjects.desc', 'subjects.value', 'users.name as teacher')
            ->get();
        /*$subjects = (DB::table('subjects')
            ->join('connections', 'subjects.id', '=', 'connections.subject'))
            ->join('users', 'users.id', '=', 'connections.student')
            ->where('users.id', '=', Auth::id())
            ->get('subjects.*', 'users.name');*/
        return view('home.student', ['student_subjects' => $subjects]);
    }

    public function assignments(){
        $assignments = Assignment::join('connections', 'connections.subject', '=', 'assignments.subject')
            ->where('connections.student', Auth::id())
            ->where('assignments.deadline_from', '<=', Date('Y-m-d H:i'))
            ->where('assignments.deadline_to', '>', Date('Y-m-d H:i'))
            ->select('assignments.id as id',
                'assignments.name as name',
                'assignments.subject as subject',
                'assignments.value as value',
                'assignments.deadline_from as deadline_from',
                'assignments.deadline_to as deadline_to')->get();
        $subjects = Subject::join('connections', 'connections.subject', '=', 'subjects.id')
            ->where('connections.student', Auth::id())
            ->whereIn('subjects.id', (
                Assignment::join('connections', 'connections.subject', '=', 'assignments.subject')
                ->where('connections.student', Auth::id())
                ->where('assignments.deadline_from', '<=', Date('Y-m-d H:i'))
                ->where('assignments.deadline_to', '>', Date('Y-m-d H:i'))
                ->select('assignments.subject as subject')->get()
            ))
            ->select('subjects.id', 'subjects.name as name')->get();

        return view('student-assignments')
            ->with('subjects', $subjects)
            ->with('assignments', $assignments);
    }

    public function apply()
    {
        $ids = [];
        foreach(DB::table('connections')->where('connections.student', Auth::id())->get('connections.subject') as $item){
            array_push($ids, $item->subject);
        }
        $subjects = DB::table('subjects')
            ->join('users', 'users.id', '=', 'subjects.teacher')
            ->whereNotIn('subjects.id', $ids)
            ->where('public', true)
            ->select('subjects.id', 'subjects.name', 'subjects.code', 'subjects.desc', 'subjects.value', 'users.name as teacher')
            ->get();
        return view('apply-subject', ['subjects' => $subjects]);
    }

    public function add($id)
    {
        $connection = new Connection;

        $connection->student = Auth::id();
        $connection->subject = $id;

        $connection->save();

        return redirect(route('student'));
    }

    public function quit(Request $request,  $id)
    {
        Connection::where('student', Auth::id())->where('subject', $id)->delete();

        return redirect()->back();
    }
}
