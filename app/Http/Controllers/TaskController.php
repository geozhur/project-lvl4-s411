<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskStatus;
use App\User;
use App\Tag;
use App\TaskFilter;
use Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, TaskFilter $filters)
    {
        $tasks = Task::filter($filters)->orderBy('id', 'desc')->paginate();
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
        $tags = Tag::get()->pluck('name', 'name');
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
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $executor = User::find($request->input('assignedto_id'));
        $task->assignedto()->associate($executor);
        $status = TaskStatus::find($request->input('status_id'));
        $task->status()->associate($status);
        $task->creator()->associate(Auth::user());
        $task->save();

        $tagsNames = $request->input('tag');
        $tags = [];
        foreach ($tagsNames as $tagName) {
            $newTag = Tag::firstOrCreate(['name' => $tagName]);
            $newTag->save();
            $tags[] = $newTag->id;
        }

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
        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $executors = User::orderBy('name')->pluck('name', 'id');
        $statuses = TaskStatus::orderBy('id')->pluck('name', 'id');
        $tags = Tag::get()->pluck('name', 'name');
        return view('task.edit', compact('task', 'executors', 'statuses', 'tags'));
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
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $executor = User::find($request->input('assignedto_id'));
        $task->assignedto()->associate($executor);
        $status = TaskStatus::find($request->input('status_id'));
        $task->status()->associate($status);
        $task->creator()->associate(Auth::user());
        $task->save();

        $tagsNames = $request->input('tag');
        $tags = [];
        if (isset($tagsNames)) {
            foreach ($tagsNames as $tagName) {
                $newTag = Tag::firstOrCreate(['name' => $tagName]);
                $newTag->save();
                $tags[] = $newTag->id;
            }
        }


        $task->tag()->sync($tags);
        return redirect()->route('tasks.index');
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
