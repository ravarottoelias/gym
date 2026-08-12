<?php use Carbon\Carbon; ?>

<!-- Hidden Fields -->
@if(Request::is('members/create'))
    {!! Form::hidden('invoiceCounter',$invoiceCounter) !!}
    {!! Form::hidden('memberCounter',$memberCounter) !!}
@endif

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('member_code', @trans('custom.member_code')) !!}
            {!! Form::text('member_code',$member_code,['class'=>'form-control', 'id' => 'member_code', ($member_number_mode == \constNumberingMode::Auto ? 'readonly' : '')]) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('name',@trans('custom.name'),['class'=>'control-label']) !!}
            {!! Form::text('name',null,['class'=>'form-control', 'id' => 'name']) !!}
        </div>
    </div>
</div>

<div class="row">

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('DOB', @trans('custom.dob')) !!}
            {!! Form::text('DOB',null,['class'=>'form-control _datepicker-default', 'id' => 'DOB']) !!}
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
            {!! Form::label('contact', @trans('custom.phone')) !!}
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
<hr>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('emergency_contact', @trans('custom.emergency_contact')) !!}
            {!! Form::text('emergency_contact',null,['class'=>'form-control', 'id' => 'emergency_contact']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('health_issues', @trans('custom.health_issues')) !!}
            {!! Form::text('health_issues',null,['class'=>'form-control', 'id' => 'health_issues']) !!}
        </div>
    </div>
</div>

{{-- <div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('proof_name', @trans('custom.proof_name')) !!}
            {!! Form::text('proof_name',null,['class'=>'form-control', 'id' => 'proof_name']) !!}
        </div>
    </div>

    
</div> --}}

<div class="row">
    @if(isset($member))
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('photo', @trans('custom.photo')) !!}
                {!! Form::file('photo',['class'=>'form-control', 'id' => 'photo']) !!}
            </div>
        </div>
        <div class="col-sm-2">
            <img alt="profile Pic" class="pull-right" src="{{ $member->getImageUrl('profile', 'form') }}" height="40" width="40"/>
        </div>
    @else
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('photo', @trans('custom.photo')) !!}
                {!! Form::file('photo',['class'=>'form-control', 'id' => 'photo']) !!}
            </div>
        </div>
    @endif

    <div class="col-sm-6">
        <div class="form-group">
        {!! Form::label('status', @trans('custom.status')) !!}
        <!--0 for inactive , 1 for active-->
            {!! Form::select('status',array('1' => 'Active', '0' => 'InActive'),null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'status']) !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <?php $reasonsToJoin = Utilities::getReasonsForJoin() ?>
            {!! Form::label('aim', @trans('custom.why_do_you_plan_to_join'),['class'=>'control-label']) !!}
            {!! Form::select('aim', $reasonsToJoin, null, ['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'aim']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <?php $medios = Utilities::getMedios() ?>
            {!! Form::label('source', @trans('custom.how_do_you_came_to_know_about_us'),['class'=>'control-label']) !!}
            {!! Form::select('source', $medios,null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'source']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <?php  $ocupations = Utilities::getOcupations() ?>
                    {!! Form::label('occupation', @trans('custom.occupation')) !!}
                    {!! Form::select('occupation', $ocupations,null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'occupation']) !!}
                </div>
            </div>


            {{-- <div class="col-sm-12">
                <div class="form-group">
                    {!! Form::label('pin_code', @trans('custom.pin_code'),['class'=>'control-label']) !!}
                    {!! Form::text('pin_code',null,['class'=>'form-control', 'id' => 'pin_code']) !!}
                </div>
            </div> --}}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('address', @trans('custom.address')) !!}
            {!! Form::textarea('address',null,['class'=>'form-control', 'id' => 'address', 'rows' => 5]) !!}
        </div>
    </div>
</div>