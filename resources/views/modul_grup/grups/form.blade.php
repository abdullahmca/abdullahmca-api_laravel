<div class="form-group {{ $errors->has('namagroup') ? 'has-error' : ''}}">
    <label for="namagroup" class="control-label">{{ 'namagroup' }}</label>
    <input class="form-control" name="namagroup" type="text" id="namagroup" value="{{ isset($grup->namagroup) ? $grup->namagroup : ''}}" >
    {!! $errors->first('namagroup', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('kota') ? 'has-error' : ''}}">
    <label for="kota" class="control-label">{{ 'Kota' }}</label>
    <input class="form-control" name="kota" type="text" id="kota" value="{{ isset($grup->kota) ? $grup->kota : ''}}" >
    {!! $errors->first('kota', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
