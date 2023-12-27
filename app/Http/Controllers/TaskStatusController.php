<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    public function index()
    {
        $taskStatuses = TaskStatus::paginate(10);
        return view('task_statuses.index', compact('taskStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $taskStatus = new TaskStatus();
        return view('task_statuses.create', compact('taskStatus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|unique:task_statuses|max:255'
        ], [
            'unique' => __('messages.flash.validation.statusUnique'),
        ]);
        $taskStatus = new TaskStatus();
        $taskStatus->fill($data);
        $taskStatus->save();
        flash(__('messages.flash.success.addedStatus'))->success();
        return redirect(route('task_statuses.index'));
    }

    public function show(TaskStatus $taskStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskStatus $taskStatus)
    {
        return view('task_statuses.edit', compact('taskStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskStatus $taskStatus)
    {
        $data = $this->validate($request, [
            'name' => 'required:task_statuses|max:255'
        ]);
        $taskStatus->fill($data);
        $taskStatus->save();
        flash(__('messages.flash.success.updatedStatus'))->success();
        return redirect(route('task_statuses.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskStatus $taskStatus)
    {
        if ($taskStatus->tasks->isEmpty()) {
            $taskStatus->delete();
            flash(__('messages.flash.success.deletedStatus'))->success();
            return redirect()->route('task_statuses.index');
        }
        flash(__('messages.flash.error.deletedStatus'))->error();
        return redirect()->back();
    }
}
