<div class="table-responsive panel-scroll" style="width: auto; height: 320px;">
    <table class="table table-hover">
        @forelse($reminders as $reminder)
            <tr>
                <td>
                    <a href="{{ action('EnquiriesController@show',['id' => $reminder->enquiry->id]) }}">{{ $reminder->enquiry->name }}</a>
                </td>
                <td>
                    <a href="{{ action('EnquiriesController@show',['id' => $reminder->enquiry->id]) }}">{{ $reminder->enquiry->contact }}</a>
                </td>
                <td>
                    <a href="{{ action('EnquiriesController@show',['id' => $reminder->enquiry->id]) }}">{{ $reminder->due_date->format('Y-m-d') }}</a>
                </td>
                <td>
                    <a href="{{ action('EnquiriesController@show',['id' => $reminder->enquiry->id]) }}">{{ Utilities::getFollowupBy ($reminder->followup_by) }}</a>
                </td>
            </tr>
        @empty
            <div class="tab-empty-panel font-size-24 color-grey-300">
                {{ @trans('custom.no_data') }}
            </div>
        @endforelse
    </table>
</div>
                                