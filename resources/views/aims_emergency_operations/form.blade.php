<div class="form-group {{ $errors->has('aims_emergency_id') ? 'has-error' : ''}}">
    <label for="aims_emergency_id" class="control-label">{{ 'Aims Emergency Id' }}</label>
    <input class="form-control" name="aims_emergency_id" type="text" id="aims_emergency_id" value="{{ isset($aims_emergency_operation->aims_emergency_id) ? $aims_emergency_operation->aims_emergency_id : ''}}" >
    {!! $errors->first('aims_emergency_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('notify') ? 'has-error' : ''}}">
    <label for="notify" class="control-label">{{ 'Notify' }}</label>
    <input class="form-control" name="notify" type="text" id="notify" value="{{ isset($aims_emergency_operation->notify) ? $aims_emergency_operation->notify : ''}}" >
    {!! $errors->first('notify', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('command_by') ? 'has-error' : ''}}">
    <label for="command_by" class="control-label">{{ 'Command By' }}</label>
    <input class="form-control" name="command_by" type="text" id="command_by" value="{{ isset($aims_emergency_operation->command_by) ? $aims_emergency_operation->command_by : ''}}" >
    {!! $errors->first('command_by', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('operating_code') ? 'has-error' : ''}}">
    <label for="operating_code" class="control-label">{{ 'Operating Code' }}</label>
    <input class="form-control" name="operating_code" type="text" id="operating_code" value="{{ isset($aims_emergency_operation->operating_code) ? $aims_emergency_operation->operating_code : ''}}" >
    {!! $errors->first('operating_code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('waiting_reply') ? 'has-error' : ''}}">
    <label for="waiting_reply" class="control-label">{{ 'Waiting Reply' }}</label>
    <input class="form-control" name="waiting_reply" type="text" id="waiting_reply" value="{{ isset($aims_emergency_operation->waiting_reply) ? $aims_emergency_operation->waiting_reply : ''}}" >
    {!! $errors->first('waiting_reply', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('officer_refuse') ? 'has-error' : ''}}">
    <label for="officer_refuse" class="control-label">{{ 'Officer Refuse' }}</label>
    <input class="form-control" name="officer_refuse" type="text" id="officer_refuse" value="{{ isset($aims_emergency_operation->officer_refuse) ? $aims_emergency_operation->officer_refuse : ''}}" >
    {!! $errors->first('officer_refuse', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <input class="form-control" name="status" type="text" id="status" value="{{ isset($aims_emergency_operation->status) ? $aims_emergency_operation->status : ''}}" >
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('remark_status') ? 'has-error' : ''}}">
    <label for="remark_status" class="control-label">{{ 'Remark Status' }}</label>
    <input class="form-control" name="remark_status" type="text" id="remark_status" value="{{ isset($aims_emergency_operation->remark_status) ? $aims_emergency_operation->remark_status : ''}}" >
    {!! $errors->first('remark_status', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('treatment') ? 'has-error' : ''}}">
    <label for="treatment" class="control-label">{{ 'Treatment' }}</label>
    <input class="form-control" name="treatment" type="text" id="treatment" value="{{ isset($aims_emergency_operation->treatment) ? $aims_emergency_operation->treatment : ''}}" >
    {!! $errors->first('treatment', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('sub_treatment') ? 'has-error' : ''}}">
    <label for="sub_treatment" class="control-label">{{ 'Sub Treatment' }}</label>
    <input class="form-control" name="sub_treatment" type="text" id="sub_treatment" value="{{ isset($aims_emergency_operation->sub_treatment) ? $aims_emergency_operation->sub_treatment : ''}}" >
    {!! $errors->first('sub_treatment', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('aims_operating_unit_id') ? 'has-error' : ''}}">
    <label for="aims_operating_unit_id" class="control-label">{{ 'Aims Operating Unit Id' }}</label>
    <input class="form-control" name="aims_operating_unit_id" type="text" id="aims_operating_unit_id" value="{{ isset($aims_emergency_operation->aims_operating_unit_id) ? $aims_emergency_operation->aims_operating_unit_id : ''}}" >
    {!! $errors->first('aims_operating_unit_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('aims_operating_officers') ? 'has-error' : ''}}">
    <label for="aims_operating_officers" class="control-label">{{ 'Aims Operating Officers' }}</label>
    <input class="form-control" name="aims_operating_officers" type="text" id="aims_operating_officers" value="{{ isset($aims_emergency_operation->aims_operating_officers) ? $aims_emergency_operation->aims_operating_officers : ''}}" >
    {!! $errors->first('aims_operating_officers', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('time_create_sos') ? 'has-error' : ''}}">
    <label for="time_create_sos" class="control-label">{{ 'Time Create Sos' }}</label>
    <input class="form-control" name="time_create_sos" type="datetime-local" id="time_create_sos" value="{{ isset($aims_emergency_operation->time_create_sos) ? $aims_emergency_operation->time_create_sos : ''}}" >
    {!! $errors->first('time_create_sos', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('time_command') ? 'has-error' : ''}}">
    <label for="time_command" class="control-label">{{ 'Time Command' }}</label>
    <input class="form-control" name="time_command" type="datetime-local" id="time_command" value="{{ isset($aims_emergency_operation->time_command) ? $aims_emergency_operation->time_command : ''}}" >
    {!! $errors->first('time_command', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('time_go_to_help') ? 'has-error' : ''}}">
    <label for="time_go_to_help" class="control-label">{{ 'Time Go To Help' }}</label>
    <input class="form-control" name="time_go_to_help" type="datetime-local" id="time_go_to_help" value="{{ isset($aims_emergency_operation->time_go_to_help) ? $aims_emergency_operation->time_go_to_help : ''}}" >
    {!! $errors->first('time_go_to_help', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('time_to_the_scene') ? 'has-error' : ''}}">
    <label for="time_to_the_scene" class="control-label">{{ 'Time To The Scene' }}</label>
    <input class="form-control" name="time_to_the_scene" type="datetime-local" id="time_to_the_scene" value="{{ isset($aims_emergency_operation->time_to_the_scene) ? $aims_emergency_operation->time_to_the_scene : ''}}" >
    {!! $errors->first('time_to_the_scene', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('time_leave_the_scene') ? 'has-error' : ''}}">
    <label for="time_leave_the_scene" class="control-label">{{ 'Time Leave The Scene' }}</label>
    <input class="form-control" name="time_leave_the_scene" type="datetime-local" id="time_leave_the_scene" value="{{ isset($aims_emergency_operation->time_leave_the_scene) ? $aims_emergency_operation->time_leave_the_scene : ''}}" >
    {!! $errors->first('time_leave_the_scene', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('time_hospital') ? 'has-error' : ''}}">
    <label for="time_hospital" class="control-label">{{ 'Time Hospital' }}</label>
    <input class="form-control" name="time_hospital" type="datetime-local" id="time_hospital" value="{{ isset($aims_emergency_operation->time_hospital) ? $aims_emergency_operation->time_hospital : ''}}" >
    {!! $errors->first('time_hospital', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('time_to_the_operating_base') ? 'has-error' : ''}}">
    <label for="time_to_the_operating_base" class="control-label">{{ 'Time To The Operating Base' }}</label>
    <input class="form-control" name="time_to_the_operating_base" type="datetime-local" id="time_to_the_operating_base" value="{{ isset($aims_emergency_operation->time_to_the_operating_base) ? $aims_emergency_operation->time_to_the_operating_base : ''}}" >
    {!! $errors->first('time_to_the_operating_base', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('time_sos_success') ? 'has-error' : ''}}">
    <label for="time_sos_success" class="control-label">{{ 'Time Sos Success' }}</label>
    <input class="form-control" name="time_sos_success" type="datetime-local" id="time_sos_success" value="{{ isset($aims_emergency_operation->time_sos_success) ? $aims_emergency_operation->time_sos_success : ''}}" >
    {!! $errors->first('time_sos_success', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('time_sum_sos') ? 'has-error' : ''}}">
    <label for="time_sum_sos" class="control-label">{{ 'Time Sum Sos' }}</label>
    <input class="form-control" name="time_sum_sos" type="text" id="time_sum_sos" value="{{ isset($aims_emergency_operation->time_sum_sos) ? $aims_emergency_operation->time_sum_sos : ''}}" >
    {!! $errors->first('time_sum_sos', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('time_sum_to_base') ? 'has-error' : ''}}">
    <label for="time_sum_to_base" class="control-label">{{ 'Time Sum To Base' }}</label>
    <input class="form-control" name="time_sum_to_base" type="text" id="time_sum_to_base" value="{{ isset($aims_emergency_operation->time_sum_to_base) ? $aims_emergency_operation->time_sum_to_base : ''}}" >
    {!! $errors->first('time_sum_to_base', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('km_before') ? 'has-error' : ''}}">
    <label for="km_before" class="control-label">{{ 'Km Before' }}</label>
    <input class="form-control" name="km_before" type="text" id="km_before" value="{{ isset($aims_emergency_operation->km_before) ? $aims_emergency_operation->km_before : ''}}" >
    {!! $errors->first('km_before', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('km_to_the_scene') ? 'has-error' : ''}}">
    <label for="km_to_the_scene" class="control-label">{{ 'Km To The Scene' }}</label>
    <input class="form-control" name="km_to_the_scene" type="text" id="km_to_the_scene" value="{{ isset($aims_emergency_operation->km_to_the_scene) ? $aims_emergency_operation->km_to_the_scene : ''}}" >
    {!! $errors->first('km_to_the_scene', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('km_hospital') ? 'has-error' : ''}}">
    <label for="km_hospital" class="control-label">{{ 'Km Hospital' }}</label>
    <input class="form-control" name="km_hospital" type="text" id="km_hospital" value="{{ isset($aims_emergency_operation->km_hospital) ? $aims_emergency_operation->km_hospital : ''}}" >
    {!! $errors->first('km_hospital', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('km_operating_base') ? 'has-error' : ''}}">
    <label for="km_operating_base" class="control-label">{{ 'Km Operating Base' }}</label>
    <input class="form-control" name="km_operating_base" type="text" id="km_operating_base" value="{{ isset($aims_emergency_operation->km_operating_base) ? $aims_emergency_operation->km_operating_base : ''}}" >
    {!! $errors->first('km_operating_base', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('km_sum') ? 'has-error' : ''}}">
    <label for="km_sum" class="control-label">{{ 'Km Sum' }}</label>
    <input class="form-control" name="km_sum" type="text" id="km_sum" value="{{ isset($aims_emergency_operation->km_sum) ? $aims_emergency_operation->km_sum : ''}}" >
    {!! $errors->first('km_sum', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('photo_by_officer') ? 'has-error' : ''}}">
    <label for="photo_by_officer" class="control-label">{{ 'Photo By Officer' }}</label>
    <input class="form-control" name="photo_by_officer" type="text" id="photo_by_officer" value="{{ isset($aims_emergency_operation->photo_by_officer) ? $aims_emergency_operation->photo_by_officer : ''}}" >
    {!! $errors->first('photo_by_officer', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('remark_photo_by_officer') ? 'has-error' : ''}}">
    <label for="remark_photo_by_officer" class="control-label">{{ 'Remark Photo By Officer' }}</label>
    <input class="form-control" name="remark_photo_by_officer" type="text" id="remark_photo_by_officer" value="{{ isset($aims_emergency_operation->remark_photo_by_officer) ? $aims_emergency_operation->remark_photo_by_officer : ''}}" >
    {!! $errors->first('remark_photo_by_officer', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('photo_succeed') ? 'has-error' : ''}}">
    <label for="photo_succeed" class="control-label">{{ 'Photo Succeed' }}</label>
    <input class="form-control" name="photo_succeed" type="text" id="photo_succeed" value="{{ isset($aims_emergency_operation->photo_succeed) ? $aims_emergency_operation->photo_succeed : ''}}" >
    {!! $errors->first('photo_succeed', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('remark_by_helper') ? 'has-error' : ''}}">
    <label for="remark_by_helper" class="control-label">{{ 'Remark By Helper' }}</label>
    <input class="form-control" name="remark_by_helper" type="text" id="remark_by_helper" value="{{ isset($aims_emergency_operation->remark_by_helper) ? $aims_emergency_operation->remark_by_helper : ''}}" >
    {!! $errors->first('remark_by_helper', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
