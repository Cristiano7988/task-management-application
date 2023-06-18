<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
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
    public function store(Request $request) {  
        try {
            DB::beginTransaction();
    
            $task = $request->user()->tasks()->create($request->all());
    
            DB::commit();
            return redirect()->route("home")->with("success", 'Task "' . $task->title . '" created!');
        } catch (\Throwable $th) {
            return redirect()->back()->with("danger", $th->getMessage());
        }
    }

    public function show(Request $request) {  
        try {    
            $tasks = $request->user()->tasks()->paginate(5);
            // dd($tasks);
            return view("tasks", compact('tasks'));
        } catch (\Throwable $th) {
            return redirect()->back()->with("danger", $th->getMessage());
        }
    }
}
