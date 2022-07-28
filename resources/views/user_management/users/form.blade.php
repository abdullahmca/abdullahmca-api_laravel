<div class="form-group {{ $errors->has('user_name') ? 'has-error' : ''}}">
    <label for="user_name" class="control-label">{{ 'User Name' }}</label>
    <input class="form-control" name="user_name" type="text" id="user_name" value="{{ isset($user->user_name) ? $user->user_name : ''}}" >
    {!! $errors->first('user_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    <label for="password" class="control-label">{{ 'Password' }}</label>
    <input class="form-control" name="password" type="text" id="password" value="{{ isset($user->password) ? $user->password : ''}}" >
    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('nama_user') ? 'has-error' : ''}}">
    <label for="nama_user" class="control-label">{{ 'Nama User' }}</label>
    <input class="form-control" name="nama_user" type="text" id="nama_user" value="{{ isset($user->nama_user) ? $user->nama_user : ''}}" >
    {!! $errors->first('nama_user', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
