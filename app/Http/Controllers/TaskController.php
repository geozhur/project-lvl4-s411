<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskStatus;
use App\User;
use App\Tag;
use App\TaskFilter;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTask;

class TaskController extends Controller
{

    public function index(Request $request, TaskFilter $filters)
    {
        $tasks = Task::filter($filters)->orderBy('id', 'desc')->paginate();
        $users = User::has('taskAssignedTo')->orderBy('name')->pluck('name', 'id');
        $tags = Tag::has('task')->get()->pluck('name', 'name');
        $statuses = TaskStatus::has('task')->latest()->pluck('name', 'id');
        return view('task.index', compact('tasks', 'users', 'tags', 'statuses'));
    }

    public function create()
    {
        $executors = User::orderBy('name')->pluck('name', 'id');
        $statuses = TaskStatus::orderBy('id')->pluck('name', 'id');
        $tags = Tag::get()->pluck('name', 'name');
        return view('task.create', compact('executors', 'statuses', 'tags'));
    }

    public function store(StoreTask $request)
    {
        $task = new Task($request->validated());
        $task->creator()->associate(Auth::user());
        $task->save();
        $task->syncTags($request->input('tags'));
        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        return view('task.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $executors = User::orderBy('name')->pluck('name', 'id');
        $statuses = TaskStatus::orderBy('id')->pluck('name', 'id');
        $tags = Tag::get()->pluck('name', 'name');
        return view('task.edit', compact('task', 'executors', 'statuses', 'tags'));
    }

    public function update(StoreTask $request, Task $task)
    {
        $input = $request->validated();
        $task->fill($input)->save();
        $task->syncTags($request->input('tags'));
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        flash(__('task.deleted'))->success();
        return redirect()->route('tasks.index');
    }
}
