<div class="form-group {{ $errors->has('name_emergency_type') ? 'has-error' : ''}}">
    <label for="name_emergency_type" class="control-label">{{ 'Name Emergency Type' }}</label>
    <input class="form-control" name="name_emergency_type" type="text" id="name_emergency_type" value="{{ isset($aims_emergency_type->name_emergency_type) ? $aims_emergency_type->name_emergency_type : ''}}" >
    {!! $errors->first('name_emergency_type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('aims_partner_id') ? 'has-error' : ''}}">
    <label for="aims_partner_id" class="control-label">{{ 'Aims Partner Id' }}</label>
    <input class="form-control" name="aims_partner_id" type="text" id="aims_partner_id" value="{{ isset($aims_emergency_type->aims_partner_id) ? $aims_emergency_type->aims_partner_id : ''}}" >
    {!! $errors->first('aims_partner_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('aims_area_id') ? 'has-error' : ''}}">
    <label for="aims_area_id" class="control-label">{{ 'Aims Area Id' }}</label>
    <input class="form-control" name="aims_area_id" type="text" id="aims_area_id" value="{{ isset($aims_emergency_type->aims_area_id) ? $aims_emergency_type->aims_area_id : ''}}" >
    {!! $errors->first('aims_area_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <input class="form-control" name="status" type="text" id="status" value="{{ isset($aims_emergency_type->status) ? $aims_emergency_type->status : ''}}" >
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
