
<div class="form-group {{ $errors->has('groupid') ? 'has-error' : ''}}">
    <label for="groupid" class="control-label">{{ 'Groupid' }}</label>
    <label for="groupid" class="col-md-12">
        <select class="form-control select2" name="groupid" id="groupid">
            <option value="-">pilih data</option>
            <?php 
            if($member){
                $groupid=$member->groupid;
            }else{
                $groupid="";
            }
            $grup=\DB::table('groups')->get();
            foreach($grup as $gr){
                ?>
                <option value="<?=$gr->groupid?>" <?php if($gr->groupid==$groupid){?>selected<?php }?>> <?=$gr->namagroup?></option>
                <?php 
            }
            ?>
        </select>
    </label>
    <!-- <input class="form-control" name="groupid" type="text" id="groupid" value="{{ isset($member->groupid) ? $member->groupid : ''}}" > -->
    {!! $errors->first('groupid', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('nama') ? 'has-error' : ''}}">
    <label for="nama" class="control-label">{{ 'Nama' }}</label>
    <input class="form-control" name="nama" type="text" id="nama" value="{{ isset($member->nama) ? $member->nama : ''}}" >
    {!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('hp') ? 'has-error' : ''}}">
    <label for="hp" class="control-label">{{ 'Hp' }}</label>
    <input class="form-control" name="hp" type="text" maxlength="14" id="hp" value="{{ isset($member->hp) ? $member->hp : ''}}" >
    {!! $errors->first('hp', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <input class="form-control" name="email" type="email" id="email" value="{{ isset($member->email) ? $member->email : ''}}" >
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('profil_pic') ? 'has-error' : ''}}">
    <label for="profil_pic" class="control-label">{{ 'Profil Pic' }}</label>
    <input class="form-control" name="profil_pic" type="text" id="profil_pic" value="{{ isset($member->profil_pic) ? $member->profil_pic : ''}}" >
    {!! $errors->first('profil_pic', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('alamat') ? 'has-error' : ''}}">
    <label for="alamat" class="control-label">{{ 'Alamat' }}</label>
    <textarea class="form-control" rows="5" name="alamat" type="textarea" id="alamat" >{{ isset($member->alamat) ? $member->alamat : ''}}</textarea>
    {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
