<div class="form-group {{ $errors->has('name_officer') ? 'has-error' : ''}}">
    <label for="name_officer" class="control-label">{{ 'Name Officer' }}</label>
    <input class="form-control" name="name_officer" type="text" id="name_officer" value="{{ isset($aims_operating_officer->name_officer) ? $aims_operating_officer->name_officer : ''}}" >
    {!! $errors->first('name_officer', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    <label for="type" class="control-label">{{ 'Type' }}</label>
    <input class="form-control" name="type" type="text" id="type" value="{{ isset($aims_operating_officer->type) ? $aims_operating_officer->type : ''}}" >
    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('level') ? 'has-error' : ''}}">
    <label for="level" class="control-label">{{ 'Level' }}</label>
    <input class="form-control" name="level" type="text" id="level" value="{{ isset($aims_operating_officer->level) ? $aims_operating_officer->level : ''}}" >
    {!! $errors->first('level', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('amount_help') ? 'has-error' : ''}}">
    <label for="amount_help" class="control-label">{{ 'Amount Help' }}</label>
    <input class="form-control" name="amount_help" type="text" id="amount_help" value="{{ isset($aims_operating_officer->amount_help) ? $aims_operating_officer->amount_help : ''}}" >
    {!! $errors->first('amount_help', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <input class="form-control" name="status" type="text" id="status" value="{{ isset($aims_operating_officer->status) ? $aims_operating_officer->status : ''}}" >
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('lat') ? 'has-error' : ''}}">
    <label for="lat" class="control-label">{{ 'Lat' }}</label>
    <input class="form-control" name="lat" type="text" id="lat" value="{{ isset($aims_operating_officer->lat) ? $aims_operating_officer->lat : ''}}" >
    {!! $errors->first('lat', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('lng') ? 'has-error' : ''}}">
    <label for="lng" class="control-label">{{ 'Lng' }}</label>
    <input class="form-control" name="lng" type="text" id="lng" value="{{ isset($aims_operating_officer->lng) ? $aims_operating_officer->lng : ''}}" >
    {!! $errors->first('lng', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'User Id' }}</label>
    <input class="form-control" name="user_id" type="text" id="user_id" value="{{ isset($aims_operating_officer->user_id) ? $aims_operating_officer->user_id : ''}}" >
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('aims_operating_unit_id') ? 'has-error' : ''}}">
    <label for="aims_operating_unit_id" class="control-label">{{ 'Aims Operating Unit Id' }}</label>
    <input class="form-control" name="aims_operating_unit_id" type="text" id="aims_operating_unit_id" value="{{ isset($aims_operating_officer->aims_operating_unit_id) ? $aims_operating_officer->aims_operating_unit_id : ''}}" >
    {!! $errors->first('aims_operating_unit_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('aims_partner_id') ? 'has-error' : ''}}">
    <label for="aims_partner_id" class="control-label">{{ 'Aims Partner Id' }}</label>
    <input class="form-control" name="aims_partner_id" type="text" id="aims_partner_id" value="{{ isset($aims_operating_officer->aims_partner_id) ? $aims_operating_officer->aims_partner_id : ''}}" >
    {!! $errors->first('aims_partner_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('aims_area_id') ? 'has-error' : ''}}">
    <label for="aims_area_id" class="control-label">{{ 'Aims Area Id' }}</label>
    <input class="form-control" name="aims_area_id" type="text" id="aims_area_id" value="{{ isset($aims_operating_officer->aims_area_id) ? $aims_operating_officer->aims_area_id : ''}}" >
    {!! $errors->first('aims_area_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
