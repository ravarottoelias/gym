@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">{{ @trans('custom.enter_details_payment') }}</div>
                        </div>

                        {!! Form::model($payment_detail, ['method' => 'POST','action' => ['PaymentsController@update',$payment_detail->id],'id' => 'paymentsform']) !!}

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php  
                                            $disabled =  isset($invoice);
                                        ?>
                                        {!! Form::label('invoice_id', @trans('custom.invoice_number')) !!}
                                        {!! Form::select('invoice_id',$invoiceList,(isset($invoice) ? $invoice->id : null),['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'invoice_id', 'data-live-search'=> 'true', 'disabled='.$disabled]) !!}
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('payment_amount',@trans('custom.amount')) !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-usd"></i></div>
                                            {!! Form::text('payment_amount',(isset($invoice) ? $invoice->pending_amount : null),['class'=>'form-control', 'id' => 'payment_amount']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php $modes = Utilities::getAllPaymentModes() ?>
                                        {!! Form::label('mode', @trans('custom.mode')) !!}
                                        {!! Form::select('mode', $modes,(isset($payment_detail) ? $payment_detail->mode : null),['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'mode']) !!}
                                    </div>
                                </div>
                            </div>

                            @if($payment_detail->mode == 0)
                                <div id="chequeDetails">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                {!! Form::label('number', @trans('custom.cheque_number')) !!}
                                                {!! Form::text('number',(isset($cheque_detail) ? $cheque_detail->number : null),['class'=>'form-control', 'id' => 'number']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                {!! Form::label('date', @trans('custom.cheque_date')) !!}
                                                {!! Form::text('date',(isset($cheque_detail) ? $cheque_detail->date : null),['class'=>'form-control datepicker-default', 'id' => 'date']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::submit('Update', ['class' => 'btn btn-primary pull-right']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {!! Form::Close() !!}

                    </div>
                </div>
            </div>
        </div>


        @stop
        @section('footer_scripts')
            <script src="{{ URL::asset('assets/js/payment.js') }}" type="text/javascript"></script>
@stop