<?php
use Carbon\Carbon;
?>

<div class="row">
    <div class="col-sm-5">
        <div class="form-group">
            <?php
            $members = App\Member::where('status', '=', '1')->get();

            $memberArray = [];
            foreach ($members as $member) {
                $memberArray[$member['id']] = $member['member_code'].' - '.$member['name'];
            }
            ?>
            {!! Form::label('member_id',@trans('custom.member_code')) !!}
            {!! Form::select('member_id',$memberArray,null,['class'=>'form-control selectpicker show-tick show-menu-arrow','id'=>'member_id','data-live-search' => 'true']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-5">
        {!! Form::label('plan_0',@trans('custom.plan')) !!}
    </div>

    <div class="col-sm-3">
        {!! Form::label('start_date_0',@trans('custom.start_date')) !!}
    </div>

    <div class="col-sm-3">
        {!! Form::label('end_date_0',@trans('custom.end_date')) !!}
    </div>

    <div class="col-sm-1">
        <label>&nbsp;</label><br/>
    </div>
</div> <!-- / Row -->
<div id="servicesContainer">
    <div class="row">
        <div class="col-sm-5">
            <div class="form-group plan-id">
                <?php $plans = App\Plan::where('status', '=', '1')->get(); ?>

                <select id="plan_0" name="plan[0][id]" class="form-control selectpicker show-tick show-menu-arrow childPlan" data-live-search="true"
                        data-row-id="0">
                    @foreach($plans as $plan)
                        <option value="{{ $plan->id }}" data-price="{{ $plan->amount }}" data-days="{{ $plan->days }}"
                                data-row-id="0">{{ $plan->plan_display }} </option>
                    @endforeach
                </select>
                <div class="plan-price">
                    {!! Form::hidden('plan[0][price]','', array('id' => 'price_0')) !!}
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group plan-start-date">
                {!! Form::text('plan[0][start_date]',Carbon::today()->format('Y-m-d'),['class'=>'form-control datepicker-startdate childStartDate', 'id' => 'start_date_0', 'data-row-id' => '0']) !!}
            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group plan-end-date">
                {!! Form::text('plan[0][end_date]',null,['class'=>'form-control childEndDate', 'id' => 'end_date_0', 'readonly' => 'readonly','data-row-id' => '0']) !!}
            </div>
        </div>

        <div class="col-sm-1">
            <div class="form-group">
                    <span class="btn btn-sm btn-danger pull-right hide remove-service">
                      <i class="fa fa-times"></i>
                    </span>
            </div>
        </div>

    </div> <!-- / Row -->
</div>

<!-- 
<div class="row">
    <div class="col-sm-6">
        {!! Form::label('horario_0','Horario') !!}
    </div>
</div> 
 
<div id="horarioContainer">
    <div class="row">
        <div class="col-sm-12 col-md-5">
            <div class="form-group shift-id">
                <?php $shifts = App\Shift::where('status', '=', '1')->get(); ?>

                <select id="shift_0" name="shift_id" class="form-control selectpicker show-tick show-menu-arrow childPlan" data-live-search="true"
                        data-row-id="0">
                    @foreach($shifts as $shift)
                        <option value="{{ $shift->id }}">{{ $shift->name }} </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
-->

<div class="row">
    <div class="col-sm-2 pull-right">
        <div class="form-group">
            <span class="btn btn-sm btn-primary pull-right" id="addSubscription">Add</span>
        </div>
    </div>
</div>
