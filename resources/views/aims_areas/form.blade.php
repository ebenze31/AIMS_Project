<div class="form-group {{ $errors->has('name_area') ? 'has-error' : ''}}">
    <label for="name_area" class="control-label">{{ 'Name Area' }}</label>
    <input class="form-control" name="name_area" type="text" id="name_area" value="{{ isset($aims_area->name_area) ? $aims_area->name_area : ''}}" >
    {!! $errors->first('name_area', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('polygon') ? 'has-error' : ''}}">
    <label for="polygon" class="control-label">{{ 'Polygon' }}</label>
    <textarea class="form-control" rows="5" name="polygon" type="textarea" id="polygon" >{{ isset($aims_area->polygon) ? $aims_area->polygon : ''}}</textarea>
    {!! $errors->first('polygon', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <input class="form-control" name="status" type="text" id="status" value="{{ isset($aims_area->status) ? $aims_area->status : ''}}" >
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('check_time_command') ? 'has-error' : ''}}">
    <label for="check_time_command" class="control-label">{{ 'Check Time Command' }}</label>
    <input class="form-control" name="check_time_command" type="text" id="check_time_command" value="{{ isset($aims_area->check_time_command) ? $aims_area->check_time_command : ''}}" >
    {!! $errors->first('check_time_command', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('time_start_command') ? 'has-error' : ''}}">
    <label for="time_start_command" class="control-label">{{ 'Time Start Command' }}</label>
    <input class="form-control" name="time_start_command" type="datetime-local" id="time_start_command" value="{{ isset($aims_area->time_start_command) ? $aims_area->time_start_command : ''}}" >
    {!! $errors->first('time_start_command', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('time_end_command') ? 'has-error' : ''}}">
    <label for="time_end_command" class="control-label">{{ 'Time End Command' }}</label>
    <input class="form-control" name="time_end_command" type="datetime-local" id="time_end_command" value="{{ isset($aims_area->time_end_command) ? $aims_area->time_end_command : ''}}" >
    {!! $errors->first('time_end_command', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('aims_partner_id') ? 'has-error' : ''}}">
    <label for="aims_partner_id" class="control-label">{{ 'Aims Partner Id' }}</label>
    <input class="form-control" name="aims_partner_id" type="text" id="aims_partner_id" value="{{ isset($aims_area->aims_partner_id) ? $aims_area->aims_partner_id : ''}}" >
    {!! $errors->first('aims_partner_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
