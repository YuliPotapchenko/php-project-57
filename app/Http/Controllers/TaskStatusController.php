<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskStatusRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Models\TaskStatus;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TaskStatusController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', TaskStatus::class);
        $taskStatuses = TaskStatus::paginate(15);

        return view('taskStatuses.index', compact('taskStatuses'));
    }

    public function create()
    {
        $this->authorize('create', TaskStatus::class);
        return view('taskStatuses.create');
    }

    public function store(StoreTaskStatusRequest $request)
    {
        $this->authorize('store', TaskStatus::class);

        $validated = $request->validated();
        $taskStatus = new TaskStatus();

        $taskStatus->fill($validated);
        $taskStatus->save();
        $message = __('controllers.task_statuses_create');
        flash($message)->success();
        return redirect()->route('task_statuses.index');
    }

    public function edit(TaskStatus $taskStatus)
    {
        return view('taskStatuses.edit', compact('taskStatus'));
    }

    public function update(UpdateTaskStatusRequest $request, TaskStatus $taskStatus)
    {
        $this->authorize('update', $taskStatus);

        $validated = $request->validated();

        $taskStatus->fill($validated);
        $taskStatus->save();

        flash(__('controllers.task_statuses_update'))->success();
        return redirect()->route('task_statuses.index');
    }

    public function destroy(TaskStatus $taskStatus)
    {
        $this->authorize('delete', $taskStatus);
        if ($taskStatus->tasks()->exists()) {
            flash(__('controllers.task_statuses_destroy_failed'))->error();
            return back();
        }
        $taskStatus->delete();

        flash(__('controllers.task_statuses_destroy'))->success();
        return redirect()->route('task_statuses.index');
    }
}
