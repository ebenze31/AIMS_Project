<div class="form-group {{ $errors->has('name_officer_command') ? 'has-error' : ''}}">
    <label for="name_officer_command" class="control-label">{{ 'Name Officer Command' }}</label>
    <input class="form-control" name="name_officer_command" type="text" id="name_officer_command" value="{{ isset($aims_command->name_officer_command) ? $aims_command->name_officer_command : ''}}" >
    {!! $errors->first('name_officer_command', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('officer_role') ? 'has-error' : ''}}">
    <label for="officer_role" class="control-label">{{ 'Officer Role' }}</label>
    <input class="form-control" name="officer_role" type="text" id="officer_role" value="{{ isset($aims_command->officer_role) ? $aims_command->officer_role : ''}}" >
    {!! $errors->first('officer_role', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('number') ? 'has-error' : ''}}">
    <label for="number" class="control-label">{{ 'Number' }}</label>
    <input class="form-control" name="number" type="text" id="number" value="{{ isset($aims_command->number) ? $aims_command->number : ''}}" >
    {!! $errors->first('number', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <input class="form-control" name="status" type="text" id="status" value="{{ isset($aims_command->status) ? $aims_command->status : ''}}" >
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('creator') ? 'has-error' : ''}}">
    <label for="creator" class="control-label">{{ 'Creator' }}</label>
    <input class="form-control" name="creator" type="text" id="creator" value="{{ isset($aims_command->creator) ? $aims_command->creator : ''}}" >
    {!! $errors->first('creator', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'User Id' }}</label>
    <input class="form-control" name="user_id" type="text" id="user_id" value="{{ isset($aims_command->user_id) ? $aims_command->user_id : ''}}" >
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('aims_partner_id') ? 'has-error' : ''}}">
    <label for="aims_partner_id" class="control-label">{{ 'Aims Partner Id' }}</label>
    <input class="form-control" name="aims_partner_id" type="text" id="aims_partner_id" value="{{ isset($aims_command->aims_partner_id) ? $aims_command->aims_partner_id : ''}}" >
    {!! $errors->first('aims_partner_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('aims_area_id') ? 'has-error' : ''}}">
    <label for="aims_area_id" class="control-label">{{ 'Aims Area Id' }}</label>
    <input class="form-control" name="aims_area_id" type="text" id="aims_area_id" value="{{ isset($aims_command->aims_area_id) ? $aims_command->aims_area_id : ''}}" >
    {!! $errors->first('aims_area_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
