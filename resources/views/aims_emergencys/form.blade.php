<div class="form-group {{ $errors->has('aims_partner_id') ? 'has-error' : ''}}">
    <label for="aims_partner_id" class="control-label">{{ 'Aims Partner Id' }}</label>
    <input class="form-control" name="aims_partner_id" type="text" id="aims_partner_id" value="{{ isset($aims_emergency->aims_partner_id) ? $aims_emergency->aims_partner_id : ''}}" >
    {!! $errors->first('aims_partner_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('aims_area_id') ? 'has-error' : ''}}">
    <label for="aims_area_id" class="control-label">{{ 'Aims Area Id' }}</label>
    <input class="form-control" name="aims_area_id" type="text" id="aims_area_id" value="{{ isset($aims_emergency->aims_area_id) ? $aims_emergency->aims_area_id : ''}}" >
    {!! $errors->first('aims_area_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('report_platform') ? 'has-error' : ''}}">
    <label for="report_platform" class="control-label">{{ 'Report Platform' }}</label>
    <input class="form-control" name="report_platform" type="text" id="report_platform" value="{{ isset($aims_emergency->report_platform) ? $aims_emergency->report_platform : ''}}" >
    {!! $errors->first('report_platform', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('name_reporter') ? 'has-error' : ''}}">
    <label for="name_reporter" class="control-label">{{ 'Name Reporter' }}</label>
    <input class="form-control" name="name_reporter" type="text" id="name_reporter" value="{{ isset($aims_emergency->name_reporter) ? $aims_emergency->name_reporter : ''}}" >
    {!! $errors->first('name_reporter', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('type_reporter') ? 'has-error' : ''}}">
    <label for="type_reporter" class="control-label">{{ 'Type Reporter' }}</label>
    <input class="form-control" name="type_reporter" type="text" id="type_reporter" value="{{ isset($aims_emergency->type_reporter) ? $aims_emergency->type_reporter : ''}}" >
    {!! $errors->first('type_reporter', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('phone_reporter') ? 'has-error' : ''}}">
    <label for="phone_reporter" class="control-label">{{ 'Phone Reporter' }}</label>
    <input class="form-control" name="phone_reporter" type="text" id="phone_reporter" value="{{ isset($aims_emergency->phone_reporter) ? $aims_emergency->phone_reporter : ''}}" >
    {!! $errors->first('phone_reporter', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('emergency_type') ? 'has-error' : ''}}">
    <label for="emergency_type" class="control-label">{{ 'Emergency Type' }}</label>
    <input class="form-control" name="emergency_type" type="text" id="emergency_type" value="{{ isset($aims_emergency->emergency_type) ? $aims_emergency->emergency_type : ''}}" >
    {!! $errors->first('emergency_type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('emergency_detail') ? 'has-error' : ''}}">
    <label for="emergency_detail" class="control-label">{{ 'Emergency Detail' }}</label>
    <textarea class="form-control" rows="5" name="emergency_detail" type="textarea" id="emergency_detail" >{{ isset($aims_emergency->emergency_detail) ? $aims_emergency->emergency_detail : ''}}</textarea>
    {!! $errors->first('emergency_detail', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('emergency_lat') ? 'has-error' : ''}}">
    <label for="emergency_lat" class="control-label">{{ 'Emergency Lat' }}</label>
    <input class="form-control" name="emergency_lat" type="text" id="emergency_lat" value="{{ isset($aims_emergency->emergency_lat) ? $aims_emergency->emergency_lat : ''}}" >
    {!! $errors->first('emergency_lat', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('emergency_lng') ? 'has-error' : ''}}">
    <label for="emergency_lng" class="control-label">{{ 'Emergency Lng' }}</label>
    <input class="form-control" name="emergency_lng" type="text" id="emergency_lng" value="{{ isset($aims_emergency->emergency_lng) ? $aims_emergency->emergency_lng : ''}}" >
    {!! $errors->first('emergency_lng', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('emergency_location') ? 'has-error' : ''}}">
    <label for="emergency_location" class="control-label">{{ 'Emergency Location' }}</label>
    <textarea class="form-control" rows="5" name="emergency_location" type="textarea" id="emergency_location" >{{ isset($aims_emergency->emergency_location) ? $aims_emergency->emergency_location : ''}}</textarea>
    {!! $errors->first('emergency_location', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('emergency_photo') ? 'has-error' : ''}}">
    <label for="emergency_photo" class="control-label">{{ 'Emergency Photo' }}</label>
    <input class="form-control" name="emergency_photo" type="text" id="emergency_photo" value="{{ isset($aims_emergency->emergency_photo) ? $aims_emergency->emergency_photo : ''}}" >
    {!! $errors->first('emergency_photo', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('score_impression') ? 'has-error' : ''}}">
    <label for="score_impression" class="control-label">{{ 'Score Impression' }}</label>
    <input class="form-control" name="score_impression" type="number" id="score_impression" value="{{ isset($aims_emergency->score_impression) ? $aims_emergency->score_impression : ''}}" >
    {!! $errors->first('score_impression', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('score_period') ? 'has-error' : ''}}">
    <label for="score_period" class="control-label">{{ 'Score Period' }}</label>
    <input class="form-control" name="score_period" type="number" id="score_period" value="{{ isset($aims_emergency->score_period) ? $aims_emergency->score_period : ''}}" >
    {!! $errors->first('score_period', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('score_total') ? 'has-error' : ''}}">
    <label for="score_total" class="control-label">{{ 'Score Total' }}</label>
    <input class="form-control" name="score_total" type="number" id="score_total" value="{{ isset($aims_emergency->score_total) ? $aims_emergency->score_total : ''}}" >
    {!! $errors->first('score_total', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('comment_help') ? 'has-error' : ''}}">
    <label for="comment_help" class="control-label">{{ 'Comment Help' }}</label>
    <textarea class="form-control" rows="5" name="comment_help" type="textarea" id="comment_help" >{{ isset($aims_emergency->comment_help) ? $aims_emergency->comment_help : ''}}</textarea>
    {!! $errors->first('comment_help', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('patient_name') ? 'has-error' : ''}}">
    <label for="patient_name" class="control-label">{{ 'Patient Name' }}</label>
    <input class="form-control" name="patient_name" type="text" id="patient_name" value="{{ isset($aims_emergency->patient_name) ? $aims_emergency->patient_name : ''}}" >
    {!! $errors->first('patient_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('patient_birth') ? 'has-error' : ''}}">
    <label for="patient_birth" class="control-label">{{ 'Patient Birth' }}</label>
    <input class="form-control" name="patient_birth" type="date" id="patient_birth" value="{{ isset($aims_emergency->patient_birth) ? $aims_emergency->patient_birth : ''}}" >
    {!! $errors->first('patient_birth', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('patient_identification') ? 'has-error' : ''}}">
    <label for="patient_identification" class="control-label">{{ 'Patient Identification' }}</label>
    <input class="form-control" name="patient_identification" type="text" id="patient_identification" value="{{ isset($aims_emergency->patient_identification) ? $aims_emergency->patient_identification : ''}}" >
    {!! $errors->first('patient_identification', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('patient_gender') ? 'has-error' : ''}}">
    <label for="patient_gender" class="control-label">{{ 'Patient Gender' }}</label>
    <input class="form-control" name="patient_gender" type="text" id="patient_gender" value="{{ isset($aims_emergency->patient_gender) ? $aims_emergency->patient_gender : ''}}" >
    {!! $errors->first('patient_gender', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('patient_blood_type') ? 'has-error' : ''}}">
    <label for="patient_blood_type" class="control-label">{{ 'Patient Blood Type' }}</label>
    <input class="form-control" name="patient_blood_type" type="text" id="patient_blood_type" value="{{ isset($aims_emergency->patient_blood_type) ? $aims_emergency->patient_blood_type : ''}}" >
    {!! $errors->first('patient_blood_type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('patient_phone') ? 'has-error' : ''}}">
    <label for="patient_phone" class="control-label">{{ 'Patient Phone' }}</label>
    <input class="form-control" name="patient_phone" type="text" id="patient_phone" value="{{ isset($aims_emergency->patient_phone) ? $aims_emergency->patient_phone : ''}}" >
    {!! $errors->first('patient_phone', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('patient_address') ? 'has-error' : ''}}">
    <label for="patient_address" class="control-label">{{ 'Patient Address' }}</label>
    <textarea class="form-control" rows="5" name="patient_address" type="textarea" id="patient_address" >{{ isset($aims_emergency->patient_address) ? $aims_emergency->patient_address : ''}}</textarea>
    {!! $errors->first('patient_address', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('patient_congenital_disease') ? 'has-error' : ''}}">
    <label for="patient_congenital_disease" class="control-label">{{ 'Patient Congenital Disease' }}</label>
    <input class="form-control" name="patient_congenital_disease" type="text" id="patient_congenital_disease" value="{{ isset($aims_emergency->patient_congenital_disease) ? $aims_emergency->patient_congenital_disease : ''}}" >
    {!! $errors->first('patient_congenital_disease', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('patient_allergic_drugs') ? 'has-error' : ''}}">
    <label for="patient_allergic_drugs" class="control-label">{{ 'Patient Allergic Drugs' }}</label>
    <input class="form-control" name="patient_allergic_drugs" type="text" id="patient_allergic_drugs" value="{{ isset($aims_emergency->patient_allergic_drugs) ? $aims_emergency->patient_allergic_drugs : ''}}" >
    {!! $errors->first('patient_allergic_drugs', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('patient_regularly_medications') ? 'has-error' : ''}}">
    <label for="patient_regularly_medications" class="control-label">{{ 'Patient Regularly Medications' }}</label>
    <input class="form-control" name="patient_regularly_medications" type="text" id="patient_regularly_medications" value="{{ isset($aims_emergency->patient_regularly_medications) ? $aims_emergency->patient_regularly_medications : ''}}" >
    {!! $errors->first('patient_regularly_medications', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('symptom') ? 'has-error' : ''}}">
    <label for="symptom" class="control-label">{{ 'Symptom' }}</label>
    <textarea class="form-control" rows="5" name="symptom" type="textarea" id="symptom" >{{ isset($aims_emergency->symptom) ? $aims_emergency->symptom : ''}}</textarea>
    {!! $errors->first('symptom', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('symptom_other') ? 'has-error' : ''}}">
    <label for="symptom_other" class="control-label">{{ 'Symptom Other' }}</label>
    <textarea class="form-control" rows="5" name="symptom_other" type="textarea" id="symptom_other" >{{ isset($aims_emergency->symptom_other) ? $aims_emergency->symptom_other : ''}}</textarea>
    {!! $errors->first('symptom_other', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('idc') ? 'has-error' : ''}}">
    <label for="idc" class="control-label">{{ 'Idc' }}</label>
    <input class="form-control" name="idc" type="text" id="idc" value="{{ isset($aims_emergency->idc) ? $aims_emergency->idc : ''}}" >
    {!! $errors->first('idc', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('rc') ? 'has-error' : ''}}">
    <label for="rc" class="control-label">{{ 'Rc' }}</label>
    <input class="form-control" name="rc" type="text" id="rc" value="{{ isset($aims_emergency->rc) ? $aims_emergency->rc : ''}}" >
    {!! $errors->first('rc', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('rc_black_text') ? 'has-error' : ''}}">
    <label for="rc_black_text" class="control-label">{{ 'Rc Black Text' }}</label>
    <input class="form-control" name="rc_black_text" type="text" id="rc_black_text" value="{{ isset($aims_emergency->rc_black_text) ? $aims_emergency->rc_black_text : ''}}" >
    {!! $errors->first('rc_black_text', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
