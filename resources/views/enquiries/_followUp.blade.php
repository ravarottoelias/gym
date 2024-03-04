<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('followup_by', @trans('custom.followup_by')) !!}
            {!! Form::select('followup_by',array('0' => 'Call', '1' => 'SMS', '2' => 'Personal'),null,['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'followup_by']) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('due_date', @trans('custom.due_date')) !!}
            {!! Form::text('due_date',null,['class'=>'form-control datepicker-default', 'id' => 'due_date']) !!}
        </div>
    </div>
</div>