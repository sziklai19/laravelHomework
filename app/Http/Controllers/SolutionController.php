<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Solution;
use Illuminate\Http\Request;

class SolutionController extends Controller
{
    public function index($id){
        $solution = Solution::find($id);
        $assignment = Assignment::find($solution->assignment);

        return view('solution')
            ->with('solution', $solution)
            ->with('assignment', $assignment);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'solution' => ['required'],
        ]);
        
        $solution = new Solution;

        $solution->solution = $request->solution;
        $solution->student = $request->student;
        $solution->assignment = $request->assignment;

        $solution->save();

        $solutions = Solution::where('assignment', 1)->get();
        $assignment = Assignment::find($request->assignment);

        return route('assignment')
            ->with('solutions', $solutions)
            ->with('subject', $assignment->subject)
            ->with('assignment', $assignment);
    }
}
