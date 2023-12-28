<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $taskStatuses = TaskStatus::pluck('name', 'id')->all();
        $users = User::pluck('name', 'id')->all();

        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters(
                [
                    AllowedFilter::exact('status_id'),
                    AllowedFilter::exact('created_by_id'),
                    AllowedFilter::exact('assigned_to_id')
                ]
            )
            ->orderBy('id', 'asc')
            ->paginate();

        $filter = $request->filter ?? null;

        return view('tasks.index', compact('tasks', 'taskStatuses', 'users', 'filter'));
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function create()
    {
        if (Auth::guest()) {
            return abort(403);
        }

        $statuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');
        return view('tasks.create', compact('statuses', 'users', 'labels'));
    }

    public function store(StoreTaskRequest $request)
    {
        if (Auth::guest()) {
            return redirect()->route('tasks.index');
        }

        $validated = $request->validated();
        $createdById = Auth::id();
        $data = [...$validated, 'created_by_id' => $createdById];

        $task = new Task();
        $task->fill($data);
        $task->save();

        if (array_key_exists('labels', $validated)) {
            $task->labels()->attach($validated['labels']);
        }

        $message = __('controllers.tasks_create');
        flash($message)->success();
        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        if (Auth::guest()) {
            abort(403);
        }
        $statuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');
        return view('tasks.edit', compact('statuses', 'users', 'labels', 'task'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        if (Auth::guest()) {
            return redirect()->route('tasks.index');
        }

        $validated = $request->validated();
        $createdById = $task->created_by_id;
        $data = [...$validated, 'created_by_id' => $createdById];

        $task->fill($data);


        if (array_key_exists('labels', $validated)) {
            $task->labels()->sync($validated['labels']);
        }
        $task->save();

        $message = __('controllers.tasks_update');
        flash($message)->success();
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        if (Auth::id() === $task->created_by_id) {
            $task->labels()->detach();
            $task->delete();
            flash(__('controllers.tasks_destroy'))->success();
        } else {
            flash(__('tasks_destroy_failed'))->error();
        }
        return redirect()->route('tasks.index');
    }
}
