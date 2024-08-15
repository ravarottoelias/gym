@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <!-- BEGIN PAGE HEADING -->
        <div class="page-head bg-grey-100 padding-top-15 no-padding-bottom">
            @include('flash::message')
            <h1 class="page-title no-line-height">{{ @trans('custom.expenses') }}
                @permission(['manage-gymie','manage-expenses','add-expense'])
                <a href="{{ action('ExpensesController@create') }}" class="page-head-btn btn-sm btn-primary active" role="button">Add New</a>
                <small>Details of all gym expenses</small>
            </h1>
            @permission(['manage-gymie','pagehead-stats'])
            <h1 class="font-size-30 text-right color-blue-grey-600 animated fadeInDown total-count pull-right"><span data-toggle="counter" data-start="0"
                                                                                                                     data-from="0" data-to="{{ $count }}"
                                                                                                                     data-speed="600"
                                                                                                                     data-refresh-interval="10"></span>
                <small class="color-blue-grey-600 display-block margin-top-5 font-size-14">{{ @trans('custom.total_expenses') }}</small>
            </h1>
            @endpermission
            @endpermission
        </div><!-- / PageHead -->

        <div class="container-fluid">
            <div class="row"><!-- Main row -->
                <div class="col-lg-12"><!-- Main col -->
                    <div class="panel no-border ">
                        <div class="panel-title bg-blue-grey-50">
                            <!-- <div class="panel-head font-size-15"> -->

                            <div class="row">
                                <div class="col-sm-12 no-padding">
                                    {!! Form::Open(['method' => 'GET']) !!}

                                    <div class="col-sm-3">

                                        {!! Form::label('expense-daterangepicker',@trans('custom.date_range')) !!}

                                        <div id="expense-daterangepicker"
                                             class="gymie-daterangepicker btn bg-grey-50 daterange-padding no-border color-grey-600 hidden-xs no-shadow">
                                            <i class="ion-calendar margin-right-10"></i>
                                            <span>{{$drp_placeholder}}</span>
                                            <i class="ion-ios-arrow-down margin-left-5"></i>
                                        </div>

                                        {!! Form::text('drp_start',null,['class'=>'hidden', 'id' => 'drp_start']) !!}
                                        {!! Form::text('drp_end',null,['class'=>'hidden', 'id' => 'drp_end']) !!}
                                    </div>

                                    <div class="col-sm-2">
                                        <?php $expenseCategories = App\ExpenseCategory::where('status', '=', '1')->get(); ?>
                                        {!! Form::label('category_id',@trans('custom.category')) !!}

                                        <?php
                                        $client_catid = isset($_GET['category_id']) ? $_GET['category_id'] : '0';
                                        ?>

                                        <select id="category_id" name="category_id" class="form-control selectpicker show-tick show-menu-arrow">
                                            <option value="0" <?php echo $client_catid == 0 ? 'selected="selected" ' : '' ?>>All</option>
                                            @foreach($expenseCategories as $expenseCategory)
                                                <option value="{{ $expenseCategory->id }}" <?php echo $client_catid == $expenseCategory->id ? 'selected="selected" ' : '' ?>>{{ $expenseCategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-2">
                                        {!! Form::label('sort_field',@trans('custom.sort_by')) !!}
                                        {!! Form::select('sort_field',array('created_at' => 'Date','name' => 'Name','amount' => 'Amount','due_date' => 'Due Date','category_name' => 'Category name'),old('sort_field'),['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'sort_field']) !!}
                                    </div>

                                    <div class="col-sm-2">
                                        {!! Form::label('sort_direction',@trans('custom.order')) !!}
                                        {!! Form::select('sort_direction',array('desc' => 'Descending','asc' => 'Ascending'),old('sort_direction'),['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'sort_direction']) !!}</span>
                                    </div>

                                    <div class="col-xs-2">
                                        {!! Form::label('search',@trans('custom.keyword')) !!}
                                        <input value="{{ old('search') }}" name="search" id="search" type="text" class="form-control padding-right-35"
                                               placeholder="Search...">
                                    </div>

                                    <div class="col-xs-1">
                                        {!! Form::label('&nbsp;') !!} <br/>
                                        <button type="submit" class="btn btn-primary active no-border">GO</button>
                                    </div>

                                    {!! Form::Close() !!}
                                </div>
                            </div>

                            <!-- </div> -->
                        </div>
                        <div class="panel-body bg-white">
                            @if($expenseCategories->count() == 0)
                                <h4 class="text-center padding-top-15">Sorry! No records found</h4>
                            @else
                            <div class="">
                                <table id="expenses" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-center">{{ @trans('custom.expense_name') }}</th>
                                        <th class="text-center visible-lg-inline-block">{{ @trans('custom.expense_category') }}</th>
                                        <th class="text-center visible-lg">{{ @trans('custom.amount') }}</th>
                                        <th class="text-center visible-lg-inline-block">{{ @trans('custom.repeat') }}</th>
                                        <th class="text-center visible-lg">{{ @trans('custom.payment_date') }}</th>
                                        <th class="text-center visible-lg">{{ @trans('custom.on') }}</th>
                                        <th class="text-center">{{ @trans('custom.status') }}</th>
                                        <th class="text-center">{{ @trans('custom.actions') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($expenses as $expense)
                                        <tr>
                                            <td class="text-center">{{ $expense->name }}</td>
                                            <td class="text-center visible-lg">{{ $expense->category->name }}</td>
                                            <td class="text-center visible-lg"> @money($expense->amount)</td>
                                            <td class="text-center visible-lg-inline-block">{{ Utilities::expenseRepeatIntervel ($expense->repeat) }}</td>
                                            <td class="text-center visible-lg">{{ $expense->due_date->format('Y-m-d') }}</td>
                                            <td class="text-center visible-lg">{{ $expense->created_at->toDayDateTimeString() }}</td>
                                            <td class="text-center"><span
                                                        class="{{ Utilities::getPaidUnpaid ($expense->paid) }}">{{ Utilities::getInvoiceStatus ($expense->paid) }}
                                            </td>
                                            <td class="text-center">
                                                @permission(['manage-gymie','manage-expenses','edit-expense'])
                                                <div class="btn-group">
                                                        @permission(['manage-gymie','manage-expenses','edit-expense'])
                                                            <a class="btn btn-default" href="{{ action('ExpensesController@edit',['id' => $expense->id]) }}">
                                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                            </a>
                                                        @endpermission
                                                        @permission(['manage-gymie','manage-expenses','delete-expense'])
                                                            <a href="#" class="delete-record btn btn-default" data-csrf-token="{{ csrf_token() }}" data-delete-url="{{ url('expenses/'.$expense->id.'/delete') }}"
                                                               data-record-id="{{$expense->id}}">
                                                               <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                            </a>
                                                        @endpermission
                                                </div>
                                                @endpermission
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="gymie_paging_info">
                                            Showing page {{ $expenses->currentPage() }} of {{ $expenses->lastPage() }}
                                        </div>
                                    </div>

                                    <div class="col-xs-6">
                                        <div class="gymie_paging pull-right">
                                            {!! str_replace('/?', '?', $expenses->appends(Input::Only('search'))->render()) !!}
                                        </div>
                                    </div>
                                </div>
                            </div><!-- / Panel-Body -->
                        </div><!-- / Panel-Body -->
                        @endif
                    </div><!-- / Panel-no-border -->
                </div><!-- / Main-Col -->
            </div><!-- / Main-row -->
        </div><!-- / Container -->
    </div><!-- / Rightside -->
@stop
@section('footer_script_init')
    <script type="text/javascript">
        $(document).ready(function () {
            gymie.deleterecord();
        });
    </script>
@stop 