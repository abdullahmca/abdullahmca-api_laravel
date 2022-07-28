<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($user->name) ? $user->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <textarea class="form-control" rows="5" name="email" type="textarea" id="email" >{{ isset($user->email) ? $user->email : ''}}</textarea>
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('remember_token') ? 'has-error' : ''}}">
    <label for="remember_token" class="control-label">{{ 'Remember Token' }}</label>
    <textarea class="form-control" rows="5" name="remember_token" type="textarea" id="remember_token" >{{ isset($user->remember_token) ? $user->remember_token : ''}}</textarea>
    {!! $errors->first('remember_token', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
