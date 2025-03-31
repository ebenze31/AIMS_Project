<div class="form-group {{ $errors->has('name_unit') ? 'has-error' : ''}}">
    <label for="name_unit" class="control-label">{{ 'Name Unit' }}</label>
    <input class="form-control" name="name_unit" type="text" id="name_unit" value="{{ isset($aims_operating_unit->name_unit) ? $aims_operating_unit->name_unit : ''}}" >
    {!! $errors->first('name_unit', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('type_unit') ? 'has-error' : ''}}">
    <label for="type_unit" class="control-label">{{ 'Type Unit' }}</label>
    <input class="form-control" name="type_unit" type="text" id="type_unit" value="{{ isset($aims_operating_unit->type_unit) ? $aims_operating_unit->type_unit : ''}}" >
    {!! $errors->first('type_unit', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <input class="form-control" name="status" type="text" id="status" value="{{ isset($aims_operating_unit->status) ? $aims_operating_unit->status : ''}}" >
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('creator') ? 'has-error' : ''}}">
    <label for="creator" class="control-label">{{ 'Creator' }}</label>
    <input class="form-control" name="creator" type="text" id="creator" value="{{ isset($aims_operating_unit->creator) ? $aims_operating_unit->creator : ''}}" >
    {!! $errors->first('creator', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('aims_partner_id') ? 'has-error' : ''}}">
    <label for="aims_partner_id" class="control-label">{{ 'Aims Partner Id' }}</label>
    <input class="form-control" name="aims_partner_id" type="text" id="aims_partner_id" value="{{ isset($aims_operating_unit->aims_partner_id) ? $aims_operating_unit->aims_partner_id : ''}}" >
    {!! $errors->first('aims_partner_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('aims_area_id') ? 'has-error' : ''}}">
    <label for="aims_area_id" class="control-label">{{ 'Aims Area Id' }}</label>
    <input class="form-control" name="aims_area_id" type="text" id="aims_area_id" value="{{ isset($aims_operating_unit->aims_area_id) ? $aims_operating_unit->aims_area_id : ''}}" >
    {!! $errors->first('aims_area_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
