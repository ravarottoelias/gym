@extends('app')

@section('content')
    <div class="rightside bg-grey-100">

        <!-- BEGIN PAGE HEADING -->
        <div class="page-head bg-grey-100 padding-top-15 no-padding-bottom">
            @include('flash::message')
            <h1 class="page-title no-line-height">
                Pagos <small>Listado de pagos realizados</small>
            </h1>
            <h1 class="font-size-30 text-right color-blue-grey-600 animated fadeInDown total-count pull-right">
                $<span data-toggle="counter" data-start="0"
                      data-from="0" data-to="{{ $balance }}"
                      data-speed="600"
                      data-refresh-interval="10"></span>
                <small class="color-blue-grey-600 display-block margin-top-5 font-size-14">Saldo</small>
            </h1>
        </div><!-- / PageHead -->

        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel no-border ">
                        <div class="panel-body padding-top-15 padding-bottom-15 bg-white">
                            <div class="row d-flex justify-content-center">
                                @if ($balance == 0)
                                    <div class="col-12">
                                        <h1 class="d-flex justify-content-center no-margin-bottom no-margin-top text-success font-size-60"><i class="fa fa-check-square-o" aria-hidden="true"></i></h1>
                                        <h3 class="d-flex justify-content-center no-margin-bottom margin-top-15 margin-bottom-15">Estás al día</h3>
                                        <p class="d-flex justify-content-center no-margin-bottom no-margin-top ">No tenés pagos pendientes.</p>
                                    </div>
                                @else
                                    <div class="col-12">
                                        <h1 class="d-flex justify-content-center no-margin-bottom no-margin-top text-warning font-size-60"><i class="fa fa-credit-card" aria-hidden="true"></i></h1>
                                        <h3 class="d-flex justify-content-center no-margin-bottom margin-top-15 margin-bottom-15">Pago pendiente</h3>
                                        <p class="d-flex justify-content-center no-margin-bottom no-margin-top ">Realizá el pago correspondiente al período <b class="margin-left-5">{{ $pastPeriod }}</b></p>
                                        <div class="col-12 d-flex justify-content-center">
                                            <div class="btn-payment margin-top-15"></div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel no-border ">
                        <div class="panel-title">
                            <div class="panel-head"> <i class="fa fa-credit-card" aria-hidden="true"></i> Historial de pagos </div>
                        </div>
                        <div class="panel-body no-padding-top bg-white">
                            <div class="row margin-top-15 margin-bottom-15">
                                <table id="plans" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#Payment Identifier</th>
                                        <th>Período</th>
                                        <th>Status</th>
                                        <th>Gateway</th>
                                        <th>Payload</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($gymiePayments as $payment)
                                            <tr>
                                                <td>{{ $payment->payment_identifier }}</td>
                                                <td>{{ $payment->period }}</td>
                                                <td>{{ $payment->status }}</td>
                                                <td>{{ $payment->gateway }}</td>
                                                <td>
                                                    <a href="#" data-toggle="modal" data-target="#{{ $payment->payment_identifier }}">
                                                        <code>{{ str_limit($payment->payload, $limit = 35, $end = '...') }}</code>
                                                    </a>
                                                    <!-- Modal payload -->
                                                    <div class="modal fade" id="{{ $payment->payment_identifier }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel">Payload #{{ $payment->payment_identifier }}</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <pre>
                                                                        {{ Helpers::json_beautify($payment->payload) }}
                                                                        </pre>
                                                                    </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach     
                                    </tbody>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@stop
@section('footer_script_init')
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            const mp = new MercadoPago(mpPublicKey, {
                locale: "es-AR",
            });
            mp.checkout({
				preference: {
				    id: preferenceMPID,
				},
				render: {
                    container: ".btn-payment",
                    label: "Abonar cuota",
				},
				autoOpen: false
			});
        });
    </script>
@stop 