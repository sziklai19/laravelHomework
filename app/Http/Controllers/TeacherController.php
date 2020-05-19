<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('type:teacher');
    }

    public function index()
    {
        $subjects = Subject::where('teacher', Auth::id())->get();
        return view('home.teacher', ['teacher_subjects' => $subjects]);
    }

    public function modify($id)
    {
        $subject = Subject::find($id);

        return view('modify-subject')
            ->with('id', $id)
            ->with('subject', $subject);
    }

    public function addSubject()
    {
        return view('new-subject');
    }
}
