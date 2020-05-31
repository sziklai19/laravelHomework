<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Solution;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SolutionController extends Controller
{
    public function index($id){
        $solution = Solution::find($id);
        $assignment = Assignment::find($solution->assignment);

        return view('solution')
            ->with('solution', $solution)
            ->with('assignment', $assignment);
    }

    public function add($assignmentId){
        $assignment = Assignment::find($assignmentId);

        return view('add-solution')
            ->with('subject', $assignment->subject)
            ->with('assignment', $assignment);
    }

    public function store(Request $request){
        if($request->file == null){
            $validatedData = $request->validate([
                'solution' => ['required'],
            ]);

            $solution = Solution::updateOrCreate([
                'student' => $request->student, 'assignment' => $request->assignment
            ]);

            $solution->solution = $request->solution;
            $solution->file = null;
            $solution->student = $request->student;
            $solution->assignment = $request->assignment;
            
            $solution->save();
        }else{
            $solution = Solution::updateOrCreate([
                'student' => $request->student, 'assignment' => $request->assignment
            ]);

            $path = Storage::putFile('./public/solutions', $request->file('file'));

            $solution->file = $path;
            $solution->solution = null;
            $solution->student = $request->student;
            $solution->assignment = $request->assignment;

            $solution->save();
        }

        $assignment = Assignment::find($request->assignment);

        return redirect(route('assignment', ['id' => $assignment->id, 'subject' => $assignment->subject]));
    }

    public function rate(Request $request){
        $assignment = Assignment::find($request->assignmentId);
        $validatedData = $request->validate([
            'result' => ['required', 'numeric', 'min:0', 'max:'.$assignment->value],
        ]);
        
        $solution = Solution::find($request->solutionId);

        $solution->result = $request->result;
        $solution->comment = $request->comment;
        $solution->rated_at = Date('Y-m-d H:i');

        $solution->save();


        return redirect(route('assignment', ['subject' => $assignment->subject, 'id' => $assignment->id]));
    }

    public function download($id){
        $file = Solution::find($id)->file;
        $name = 'solution.'.explode('.', $file)[count(explode('.', $file))-1];
        return Storage::download($file, $name);
    }
}
