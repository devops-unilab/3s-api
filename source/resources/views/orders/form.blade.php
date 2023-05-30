<div class="form-group {{ $errors->has('division_id') ? 'has-error' : ''}}">
    {!! Form::label('division_id', 'Division Id', ['class' => 'control-label']) !!}
    {!! Form::number('division_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('division_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('service_id') ? 'has-error' : ''}}">
    {!! Form::label('service_id', 'Service Id', ['class' => 'control-label']) !!}
    {!! Form::number('service_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('service_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('client_user_id') ? 'has-error' : ''}}">
    {!! Form::label('client_user_id', 'Client User Id', ['class' => 'control-label']) !!}
    {!! Form::number('client_user_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('client_user_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
    {!! Form::textarea('description', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('campus') ? 'has-error' : ''}}">
    {!! Form::label('campus', 'Campus', ['class' => 'control-label']) !!}
    {!! Form::text('campus', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('campus', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('tag') ? 'has-error' : ''}}">
    {!! Form::label('tag', 'Tag', ['class' => 'control-label']) !!}
    {!! Form::text('tag', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('tag', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
    {!! Form::label('phone_number', 'Phone Number', ['class' => 'control-label']) !!}
    {!! Form::text('phone_number', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('division') ? 'has-error' : ''}}">
    {!! Form::label('division', 'Division', ['class' => 'control-label']) !!}
    {!! Form::text('division', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('division', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
    {!! Form::text('status', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('solution') ? 'has-error' : ''}}">
    {!! Form::label('solution', 'Solution', ['class' => 'control-label']) !!}
    {!! Form::textarea('solution', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('solution', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('rating') ? 'has-error' : ''}}">
    {!! Form::label('rating', 'Rating', ['class' => 'control-label']) !!}
    {!! Form::text('rating', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('rating', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
    {!! Form::text('email', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('service_at') ? 'has-error' : ''}}">
    {!! Form::label('service_at', 'Service At', ['class' => 'control-label']) !!}
    {!! Form::input('datetime-local', 'service_at', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('service_at', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('finished_at') ? 'has-error' : ''}}">
    {!! Form::label('finished_at', 'Finished At', ['class' => 'control-label']) !!}
    {!! Form::input('datetime-local', 'finished_at', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('finished_at', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('confirmed_at') ? 'has-error' : ''}}">
    {!! Form::label('confirmed_at', 'Confirmed At', ['class' => 'control-label']) !!}
    {!! Form::input('datetime-local', 'confirmed_at', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('confirmed_at', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('provider_user_id') ? 'has-error' : ''}}">
    {!! Form::label('provider_user_id', 'Provider User Id', ['class' => 'control-label']) !!}
    {!! Form::number('provider_user_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('provider_user_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('assigned_user_id') ? 'has-error' : ''}}">
    {!! Form::label('assigned_user_id', 'Assigned User Id', ['class' => 'control-label']) !!}
    {!! Form::number('assigned_user_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('assigned_user_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('attachment') ? 'has-error' : ''}}">
    {!! Form::label('attachment', 'Attachment', ['class' => 'control-label']) !!}
    {!! Form::textarea('attachment', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('attachment', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('place') ? 'has-error' : ''}}">
    {!! Form::label('place', 'Place', ['class' => 'control-label']) !!}
    {!! Form::text('place', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('place', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
