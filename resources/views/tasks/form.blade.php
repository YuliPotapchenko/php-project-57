{{ Form::label('name', __('task.name')) }}
@if (!$errors->has('name'))
    {{ Form::text('name', old('$taskStatus->name'), ['class' => 'form-control my-2']) }}
@else
    @error('name')
    {{ Form::text('name', old('$taskStatus->name'), ['class' => 'form-control is-invalid']) }}
    <div class="invalid-feedback"> {{ $message }}</div>
    @enderror
@endif

{{ Form::label('description', __('task.description')) }}
{{ Form::textarea('description', old('$task->description'), ['class' => 'form-control my-2', 'cols' => '50', 'rows' => '10']) }}

{{ Form::label('status_id', __('task.status')), ['class' => "form-group"] }}
@if (!$errors->has('status_id'))
    {{ Form::select('status_id', ['' => '----------'] + $taskStatuses->pluck('name', 'id')->all(), null, ['class' =>"form-control my-2"]) }}
@else
    @error('status_id')
    {{ Form::select('status_id', ['' => '----------'] + $taskStatuses->pluck('name', 'id')->all(), null, ['class' =>"form-control is-invalid"]) }}
    <div class="invalid-feedback"> {{ $message }}</div>
    @enderror
@endif

{{ Form::label('assigned_to_id', __('task.assigned')), ['class' => "form-group"] }}
{{ Form::select('assigned_to_id', ['' => '----------'] + $users->pluck('name', 'id')->all(), null, ['class' =>"form-control my-2"]) }}

{{ Form::label('labels', __('task.labels')), ['class' => "form-group"] }}
{{ Form::select('labels[]', ['' => '----------' ] + $labels->pluck('name', 'id')->all(), null, ['class' =>"form-control my-2", 'multiple']) }}
