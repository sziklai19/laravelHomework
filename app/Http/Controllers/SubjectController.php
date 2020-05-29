<?php

namespace App\Http\Controllers;

use App\Connection;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function publicate(Request $request, $id)
    {
        $subject = Subject::find($id);
        if(isset($subject))
        {
            $subject->public = $request->input('public');
            $subject->save();
            return redirect()->back()->with('public', $request->input('public'));
        }
        
        return redirect(route('teacher'));
    }

    public function details($id)
    {
        $subject = Subject::find($id);
        $students = DB::table('connections')->join('users', 'users.id', '=', 'connections.student')->where('connections.subject', $id)->select('users.name', 'users.email')->get();
        $teacher = User::find($subject->teacher);

        return view('subject-details')
            ->with('subject', $subject)
            ->with('students', $students)
            ->with('teacher', $teacher);
    }

    public function delete(Request $request, $id)
    {
        Subject::destroy($id);

        Connection::where('subject', $id)->delete();

        return redirect('teacher');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'min:3'],
            'desc' => [],
            'code' => ['required', 'regex:/^IK-[A-Z]{3}[0-9]{3}$/'],
            'value' => ['required', 'numeric'],
        ]);

        $subject = new Subject;

        $subject->name = $request->name;
        $subject->desc = $request->desc;
        $subject->code = $request->code;
        $subject->value = $request->value;
        $subject->public = false;
        $subject->teacher = Auth::id();

        $subject->save();

        return redirect(route('teacher'));
    }

    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'name' => ['required', 'min:3'],
            'desc' => [],
            'code' => ['required', 'regex:/^IK-[A-Z]{3}[0-9]{3}$/'],
            'value' => ['required', 'numeric'],
        ]);

        $subject = Subject::find($id);

        $subject->name = $request->name;
        $subject->desc = $request->desc;
        $subject->code = $request->code;
        $subject->value = $request->value;
        $subject->teacher = Auth::id();

        $subject->save();

        return redirect(route('subject-details', $id));
    }
}
