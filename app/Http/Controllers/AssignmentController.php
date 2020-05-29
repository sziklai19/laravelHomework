<?php

namespace App\Http\Controllers;

use App\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function store(Request $request, $id){
        $validatedData = $request->validate([
            'name' => ['required', 'min:5'],
            'desc' => ['require'],
        ]);

        $assignment = new Assignment;

        $assignment->name = $request->name;
        $assignment->desc = $request->desc;
        $assignment->value = $request->value;
        $assignment->deadline_from = $request->deadline_from;
        $assignment->deadline_to = $request->deadline_to;
        $assignment->subject = Auth::id();

        $assignment->save();

        return redirect(route('teacher'));
    }
}
