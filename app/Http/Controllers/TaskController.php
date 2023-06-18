<?php

namespace App\Http\Controllers;

use App\Models\Task;
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
    public function index(Request $request) {  
        try {    
            $tasks = $request->user()->tasks()->paginate(5);

            return view("tasks", compact('tasks'));
        } catch (\Throwable $th) {
            return redirect()->back()->with("danger", $th->getMessage());
        }
    }

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

    public function show(int $id) {  
        try {
            $task = Task::find($id);

            return view("task", compact('task'));
        } catch (\Throwable $th) {
            return redirect()->back()->with("danger", $th->getMessage());
        }
    }

    public function update(int $id,Request $request) {  
        try {
            $task = Task::find($id);
            $task->fill($request->all());
            $task->save();

            return view("task", compact('task'))->with("success",'Task !' . $task->title . '" updated!');
        } catch (\Throwable $th) {
            return redirect()->back()->with("danger", $th->getMessage());
        }
    }
}
