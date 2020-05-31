<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Solution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($subject, $id){
        $assignment = Assignment::find($id);
        if(Auth::user()->teacher){
            $solutions = Solution::where('assignment', $id)->get();
        }else{
            $solutions = Solution::where('assignment', 1)->where('student', Auth::id())->get();
        }

        return view('assignment')
            ->with('assignment', $assignment)
            ->with('subject', $subject)
            ->with('solutions', $solutions);
    }

    public function add($id){
        return view('new-assignment')
            ->with('subject', $id);
    }

    public function modify($subject, $id){
        $assignment = Assignment::find($id);

        return view('modify-assignment')
            ->with('subject', $subject)
            ->with('assignment', $assignment);
    }

    public function store(Request $request, $subject){
        $validatedData = $request->validate([
            'name' => ['required', 'min:5'],
            'desc' => ['required'],
        ]);

        $assignment = new Assignment;

        $assignment->name = $request->name;
        $assignment->desc = $request->desc;
        $assignment->value = $request->value;
        $assignment->deadline_from = str_replace('T', ' ', $request->deadline_from);
        $assignment->deadline_to = str_replace('T', ' ', $request->deadline_to);
        $assignment->subject = $subject;

        $assignment->save();

        return redirect(route('subject-details', $subject));
    }

    public function update(Request $request, $subject, $id){
        $validatedData = $request->validate([
            'name' => ['required', 'min:5'],
            'desc' => ['required'],
        ]);

        $assignment = Assignment::find($id);

        $assignment->name = $request->name;
        $assignment->desc = $request->desc;
        $assignment->value = $request->value;
        $assignment->deadline_from = str_replace('T', ' ', $request->deadline_from);
        $assignment->deadline_to = str_replace('T', ' ', $request->deadline_to);
        $assignment->subject = $subject;

        $assignment->update();

        return redirect(route('subject-details', $subject));
    }
}
