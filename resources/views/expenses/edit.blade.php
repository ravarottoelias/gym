@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">{{ @trans('custom.enter_details_expense') }}</div>
                        </div>
                        <div class="panel-body">
                            <div class="row margin-bottom-20">
                                <div class="col-md-12">
                                    @permission(['manage-gymie','manage-expenses','edit-expense'])
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default">{{ @trans('custom.actions') }}</button>
                                                @if($expense->paid == 0)
                                                    <a class="btn btn-default" href="{{ action('ExpensesController@paid',['id' => $expense->id]) }}">
                                                        <i class="fa fa-check-square-o" aria-hidden="true"></i> Marcar como pagado
                                                    </a>
                                                @endif
                                                @permission(['manage-gymie','manage-expenses','delete-expense'])
                                                    <a href="#" class="delete-record btn btn-default" data-csrf-token="{{ csrf_token() }}" data-delete-url="{{ url('expenses/'.$expense->id.'/delete') }}"
                                                        data-record-id="{{$expense->id}}">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar
                                                    </a>
                                                @endpermission
                                        </div>
                                        @endpermission
                                </div>
                            </div>
                            {!! Form::model($expense, ['method' => 'POST','action' => ['ExpensesController@update',$expense->id], 'id' => 'expensesform']) !!}

                            @include('expenses.form',['submitButtonText' => 'Update'])

                            {!! Form::Close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('footer_scripts')
    <script src="{{ URL::asset('assets/js/expense.js') }}" type="text/javascript"></script>
@stop