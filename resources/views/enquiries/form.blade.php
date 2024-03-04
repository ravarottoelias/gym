<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('name', @trans('custom.fullname'),['class'=>'control-label']) !!}
            {!! Form::text('name',null,['class'=>'form-control', 'id' => 'name']) !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('contact', @trans('custom.contact')) !!}
            {!! Form::text('contact',null,['class'=>'form-control', 'id' => 'contact']) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('email', @trans('custom.email')) !!}
            {!! Form::text('email',null,['class'=>'form-control', 'id' => 'email']) !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('DOB', @trans('custom.dob')) !!}
            {!! Form::text('DOB',null,['class'=>'form-control datepicker-default', 'id' => 'DOB']) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('gender', @trans('custom.gender')) !!}
            {!! Form::select('gender',array('m' => 'Male', 'f' => 'Female'),null,['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'gender']) !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <?php  $ocupations = Utilities::getOcupations() ?>
            {!! Form::label('occupation', @trans('custom.occupation')) !!}
            {!! Form::select('occupation',$ocupations,null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'occupation']) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('start_by', @trans('custom.start_by')) !!}
            {!! Form::text('start_by',null,['class'=>'form-control datepicker-default', 'id' => 'start_by']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <?php $services = App\Service::lists('name', 'id'); ?>
            {!! Form::label('interested_in', @trans('custom.interested_in')) !!}
            {!! Form::select('interested_in[]',$services,1,['class'=>'form-control selectpicker show-tick show-menu-arrow','multiple' => 'multiple','id' => 'interested_in']) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <?php $reasonsToJoin = Utilities::getReasonsForJoin() ?>
            {!! Form::label('aim', @trans('custom.why_do_you_plan_to_join'),['class'=>'control-label']) !!}
            {!! Form::select('aim', $reasonsToJoin, null, ['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'aim']) !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <?php $medios = Utilities::getMedios() ?>
                    {!! Form::label('source', @trans('custom.how_do_you_came_to_know_about_us'),['class'=>'control-label']) !!}
                    {!! Form::select('source', $medios, null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'source']) !!}
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    {!! Form::label('pin_code','Pin Code',['class'=>'control-label']) !!}
                    {!! Form::text('pin_code',null,['class'=>'form-control', 'id' => 'pin_code']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('address', @trans('custom.address')) !!}
            {!! Form::textarea('address',null,['class'=>'form-control', 'id' => 'address', 'rows' => 5]) !!}
        </div>
    </div>
</div>
