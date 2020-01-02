<?php

namespace App\Http\Controllers;

use App\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $taskStatuses = TaskStatus::paginate();
        return view('taskstatus.index', compact('taskStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('taskstatus.create');
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
            'name' => 'required|min:2|max:255|unique:task_statuses,name',
        ]);

        TaskStatus::create($request->all());
        return redirect()->route('taskstatuses.index');
    }

    public function show(TaskStatus $taskStatus)
    {
//
    }

    public function edit(TaskStatus $taskstatus)
    {
        return view('taskstatus.edit', compact('taskstatus'));
    }

    public function update(Request $request, TaskStatus $taskstatus)
    {
        $request->validate([
            'name' => 'required|min:2|max:255|unique:task_statuses,name',
        ]);

        $taskstatus->fill($request->all())->save();
        flash(__('task.name_updated'))->success();
        return redirect()->route('taskstatuses.index');
    }

    public function destroy(TaskStatus $taskstatus)
    {
        if (!$taskstatus->hasTask() && $taskstatus->id != TaskStatus::DEFAULT_ID) {
            $taskstatus->delete();
            flash(__('task.status_deleted'))->success();
        } else {
            flash(__('task.status_not_deleted'))->warning();
        }

        return redirect()->route('taskstatuses.index');
    }
}
