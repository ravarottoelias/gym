<?php
    use Carbon\Carbon;
?>
<div class="table-responsive panel-scroll" style="width: auto; height: 320px;">
    <table class="table table-hover table-condensed">
        @forelse($expirings as $expiring)
            <tr>
                <td>
                    <a href="{{ action('MembersController@show',['id' => $expiring->member->id]) }}">
                        <img src="{{ $expiring->member->getImageUrl('profile', 'thumb') }}" width="40" height="40"/>
                </td>

                <td>
                    <a href="{{ action('MembersController@show',['id' => $expiring->member->id]) }}">
                        <span class="table-sub-data">{{ $expiring->member->member_code }}</span></a>
                    <a href="{{ action('MembersController@show',['id' => $expiring->member->id]) }}">
                        <span class="table-sub-data">{{ $expiring->member->name }}</span></a>
                </td>
                <?php
                $daysLeft = Carbon::today()->diffInDays($expiring->end_date->addDays(1));
                ?>
                <td>
                    <span class="table-sub-data">{{ $expiring->end_date->format('Y-m-d') }}<br></span>
                    <span class="table-sub-data">{{ Carbon::today()->addDays($daysLeft)->diffForHumans() }}</span>
                </td>

                @permission(['manage-gymie','manage-subscriptions','renew-subscription'])
                <td>
                    <a class="btn btn-info btn-xs btn pull-right"
                       href="{{ action('SubscriptionsController@renew',['id' => $expiring->invoice_id]) }}">{{ @trans('custom.renew') }}</a>
                </td>
                @endpermission
            </tr>
        @empty
            <div class="tab-empty-panel font-size-24 color-grey-300">
                {{ @trans('custom.no_data') }}
            </div>
        @endforelse
    </table>
</div>
@if(!$expirings->isEmpty())
    <a class="btn btn-color btn-xs palette-concrete pull-right margin-right-10 margin-top-10"
       href="{{ action('SubscriptionsController@expiring') }}">{{ @trans('custom.view_all') }}</a>
@endif