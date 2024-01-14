<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLabelRequest;
use App\Http\Requests\UpdateLabelRequest;
use App\Models\Label;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Policies\LabelPolicy;

class LabelController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Label::class);
        $labels = Label::paginate(15);

        return view('labels.index', compact('labels'));
    }

    public function create()
    {
        $this->authorize('viewAny', Label::class);
        return view('labels.create');
    }

    public function store(StoreLabelRequest $request)
    {
        $this->authorize('viewAny', Label::class);
        $validated = $request->validated();
        $label = new Label();

        $label->fill($validated);
        $label->save();

        flash(__('controllers.label_create'))->success();
        return redirect()->route('labels.index');
    }

    public function edit(Label $label)
    {
        $this->authorize('viewAny', Label::class);
        return view('labels.edit', compact('label'));
    }

    public function update(UpdateLabelRequest $request, Label $label)
    {
        $this->authorize('viewAny', Label::class);

        $validated = $request->validated();

        $label->fill($validated);
        $label->save();

        flash(__('controllers.label_update'))->success();
        return redirect()->route('labels.index');
    }

    public function destroy(Label $label)
    {
        $this->authorize('viewAny', Label::class);

        if ($label->tasks()->exists()) {
            flash(__('controllers.label_statuses_destroy_failed'))->error();
            return back();
        }
        $label->delete();

        flash(__('controllers.label_destroy'))->success();
        return redirect()->route('labels.index');
    }
}
