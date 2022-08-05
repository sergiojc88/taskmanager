<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Readline\Hoa\Console;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$tasks = Task::all();
        $tasks = Task::orderBy('priority')->get();
        return view('Task.index', ['tasks'=>$tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'priority' => ['required', 'integer', 'min:1', 'unique:task,priority'],
        ]);

        $task = new Task();
        $task->name = $request->name;
        $task->priority = $request->priority;

        $task->save();

        return redirect('task');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $task = Task::findOrFail($id);
        return view('task.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => ['required'],
            'priority' => ['required', 'integer', 'min:1'],
        ]);

        $task = Task::findOrFail($id);
        $task->name = $request->name;
        $task->priority = $request->priority;

        $task->save();

        return redirect('task');
    }

    public function update_priority(Request $request, $id)
    {
        //
        $task = Task::findOrFail($id);
        $prev_priority = $task->priority;
        $task->priority = ($request->priority + 1);

        $task->save();
        $taskid = $task->id;

        if($prev_priority > $request->priority + 1) {
            $task = DB::table('task')->where('priority', '>=', ($request->priority + 1))->where('id', '<>',  $taskid)->where('priority', '<=', $prev_priority)->get();
            foreach ($task as $t) {
                $item = Task::findOrFail($t->id);
                if($item->priority == $request->priority + 1) {
                    $item->priority = $t->priority + 1;
                }
                else {
                    $item->priority = $t->priority + 1;
                }

                $item->save();
            }
        }
        else {
            $task_b = DB::table('task')->where('priority', '<=', ($request->priority + 1))->where('id', '<>',  $taskid)->where('priority', '>=', $prev_priority)->get();
            foreach ($task_b as $t) {
                $item_b = Task::findOrFail($t->id);
                if($item_b->priority == $request->priority + 1) {
                    $item_b->priority = $t->priority - 1;
                }
                else {
                    $item_b->priority = $t->priority - 1;
                }

                $item_b->save();
            }
        }
        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $task = Task::destroy($id);
        return redirect('task');
    }
}
