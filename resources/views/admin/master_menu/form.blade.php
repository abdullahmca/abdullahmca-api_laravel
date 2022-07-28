<div class="form-group {{ $errors->has('menu') ? 'has-error' : ''}}">
    <label for="menu" class="control-label">{{ 'Menu' }}</label>
    <input class="form-control" name="menu" type="text" id="menu" value="{{ isset($master_menu->menu) ? $master_menu->menu : ''}}" >
    {!! $errors->first('menu', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
    <label for="link" class="control-label">{{ 'Link' }}</label>
    <input class="form-control" name="link" type="text" id="link" value="{{ isset($master_menu->link) ? $master_menu->link : ''}}" >
    {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('icon') ? 'has-error' : ''}}">
    <label for="icon" class="control-label">{{ 'Icon' }}</label>
    <input class="form-control" rows="5" name="icon" type="textarea" id="icon"  value="{{ isset($master_menu->icon) ? $master_menu->icon : ''}}">
    {!! $errors->first('icon', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('parent') ? 'has-error' : ''}}">
    <label for="parent" class="control-label col-md-12">{{ 'Parent' }}</label>
    <select class="form-control" name="parent" id="parent">
        <option value="true">Ya</option>
        <?php 
        $parent='';
        if($formMode == 'edit' ){$parent==$master_menu->parent;}else{$parent='';}
            $menu = DB::table('master_menu')
            // ->where('id_kategori', '=', $cat->id)
            ->select('*')
            ->orderBy('id', 'desc')
            ->get();
            foreach($menu as $men){?>
                <option <?php if($men->id==$parent){?> selected<?php }?>value="<?=$men->id?>">
                    <?=$men->id?> | 
                    <?=$men->menu?>
                </option>

            <?php }?>
    </select>
    <!-- <input class="form-control" rows="5" name="parent" type="textarea" id="parent" value="{{ isset($master_menu->parent) ? $master_menu->parent : ''}}"> -->
    {!! $errors->first('parent', '<p class="help-block">:message</p>') !!}
</div>

<br>
<div style="float:right" class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
