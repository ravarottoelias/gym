@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">{{ @trans('custom.enter_details_subscription') }}</div>
                        </div>

                        {!! Form::model($subscription, ['method' => 'POST','action' => ['SubscriptionsController@update',$subscription->id],'id'=>'subscriptionsEditform']) !!}
                        <div class="panel-body">

                            @include('_validation-errors')

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {{-- @php $member_code = App\Member::where('status', '=', '1')->array_pluck($array, 'value')('member_code', 'id'); @endphp --}}
                                        {!! Form::label('member_id','Member Code') !!}

                                        {!! Form::text('member_display', $subscription->member->member_code . ' - ' . $subscription->member->name ,['class'=> 'form-control', 'id' => 'member_display','readonly' => 'readonly']) !!}
                                        {!! Form::hidden('member_id', $subscription->member_id) !!}

                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <?php $plans = App\Plan::where('status', '=', '1')->get(); ?>
                                        {!! Form::label('plan_id','Plan Name') !!}
                                        {!! Form::text('plan_display', $subscription->plan->plan_display,['class'=> 'form-control plan-data', 'id' => 'plan_display','readonly' => 'readonly','data-days' => $subscription->plan->days]) !!}
                                        {!! Form::hidden('plan_id', $subscription->plan_id) !!}
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {!! Form::label('start_date','Start Date') !!}
                                        {!! Form::text('start_date',$subscription->start_date->format('Y-m-d'),['class'=> 'form-control', 'id' => 'start_date','readonly']) !!}
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {!! Form::label('end_date','End Date') !!}
                                        {!! Form::text('end_date',$subscription->end_date->format('Y-m-d'),['class'=>'form-control datepicker-default', 'id' => 'end_date']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2 pull-right">
                    <div class="form-group">
                        {!! Form::submit(@trans('custom.update'), ['class' => 'btn btn-primary pull-right']) !!}
                    </div>
                </div>
            </div>

            {!! Form::Close() !!}


        </div>
    </div>


@stop
@section('footer_scripts')
    
@stop
@section('footer_script_init')
    <script type="text/javascript">
        $(document).ready(function () {
            gymie.loaddatepickerend();
        });
    </script>
@stop

