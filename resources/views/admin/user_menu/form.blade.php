<div class="form-group {{ $errors->has('id_menu') ? 'has-error' : ''}}">
    <label for="id_menu" class="control-label">{{ 'Id Menu' }}</label>
    <input class="form-control" name="id_menu" type="text" id="id_menu" value="{{ isset($user_menu->id_menu) ? $user_menu->id_menu : ''}}" >
    {!! $errors->first('id_menu', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('id_user') ? 'has-error' : ''}}">
    <label for="id_user" class="control-label">{{ 'Id User' }}</label>
    <input class="form-control" name="id_user" type="text" id="id_user" value="{{ isset($user_menu->id_user) ? $user_menu->id_user : ''}}" >
    {!! $errors->first('id_user', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
