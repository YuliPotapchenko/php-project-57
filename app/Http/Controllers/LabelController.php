<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labels = Label::paginate(10);
        return view('labels.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $label = new Label();
        return view('labels.create', compact('label'));
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
            'name' => 'required|unique:labels|max:255',
            'description' => 'nullable|max:500'
        ], [
            'unique' => __('messages.flash.validation.labelUnique'),
        ]);
        $label = new Label();
        $label->fill($data);
        $label->save();
        flash(__('messages.flash.success.added', ['subject' => __('label.subject')]))->success();
        return redirect(route('labels.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function edit(Label $label)
    {
        return view('labels.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Label $label)
    {
        $data = $this->validate($request, [
            'name' => 'required:labels|max:255',
            'description' => 'nullable|max:500'
        ]);
        $label->fill($data);
        $label->save();
        flash(__('messages.flash.success.updated', ['subject' => __('label.subject')]))->success();
        return redirect(route('labels.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function destroy(Label $label)
    {
        if ($label->tasks->isEmpty()) {
            $label->delete();
            flash(__('messages.flash.success.deleted', ['subject' => __('label.subject')]))->success();
            return redirect()->route('labels.index');
        }
        flash(__('messages.flash.error.deletedLabel'))->error();
        return redirect()->back();
    }
}
