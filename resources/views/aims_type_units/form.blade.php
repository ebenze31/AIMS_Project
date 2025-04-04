<div class="form-group {{ $errors->has('name_type_unit') ? 'has-error' : ''}}">
    <label for="name_type_unit" class="control-label">{{ 'Name Type Unit' }}</label>
    <input class="form-control" name="name_type_unit" type="text" id="name_type_unit" value="{{ isset($aims_type_unit->name_type_unit) ? $aims_type_unit->name_type_unit : ''}}" >
    {!! $errors->first('name_type_unit', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('aims_partner_id') ? 'has-error' : ''}}">
    <label for="aims_partner_id" class="control-label">{{ 'Aims Partner Id' }}</label>
    <input class="form-control" name="aims_partner_id" type="text" id="aims_partner_id" value="{{ isset($aims_type_unit->aims_partner_id) ? $aims_type_unit->aims_partner_id : ''}}" >
    {!! $errors->first('aims_partner_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('aims_area_id') ? 'has-error' : ''}}">
    <label for="aims_area_id" class="control-label">{{ 'Aims Area Id' }}</label>
    <input class="form-control" name="aims_area_id" type="text" id="aims_area_id" value="{{ isset($aims_type_unit->aims_area_id) ? $aims_type_unit->aims_area_id : ''}}" >
    {!! $errors->first('aims_area_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
