<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskStatus;
use App\User;
use App\Tag;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::paginate();
        return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $executors = User::orderBy('name')->pluck('name', 'id');
        $statuses = TaskStatus::orderBy('id')->pluck('name', 'id');
        $tags = \App\Tag::get()->pluck('name', 'id');
        return view('task.create', compact('executors', 'statuses', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task();
        $task->name = $request->get('name');
        $task->description = $request->get('description');
        $task->assignedto_id = $request->get('executor');
        $task->creator_id = \Auth::user()->id;
        $task->save();

        $tagsNames = $request->get('tag');
        foreach ($tagsNames as $tagName) {
            Tag::firstOrCreate(['name' => $tagName])->save();
        }

        $tags = Tag::whereIn('name', $tagsNames)->get()->pluck('id');
        $task->tag()->sync($tags);

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        flash(__('task.deleted'))->success();
        return redirect()->route('tasks.index');
    }
}
