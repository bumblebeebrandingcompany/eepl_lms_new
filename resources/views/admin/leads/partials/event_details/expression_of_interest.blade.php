@php
    $webhook_data = $event->webhook_data ?? [];
    if(!empty($webhook_data['source_id'])) {
        $source = \App\Models\Source::find($webhook_data['source_id']);
        $webhook_data['source'] = !empty($source) ? $source->name : '';
        unset($webhook_data['source_id']);
    }
    $webhook_data['sub source'] = $webhook_data['sub_source'] ?? '';
    unset($webhook_data['sub_source']);
    if(!empty($webhook_data['campaign_id'])) {
        $campaign = \App\Models\Campaign::find($webhook_data['campaign_id']);
        $webhook_data['campaign'] = !empty($campaign) ? $campaign->campaign_name : '';
        unset($webhook_data['campaign_id']);
    }
@endphp
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered">
                @if(isset($enable_header) && $enable_header)
                    <thead>
                        <tr>
                            <th>
                                @lang('messages.key')
                            </th>
                            <th>
                                @lang('messages.value')
                            </th>
                        </tr>
                    </thead>
                @endif
                <tbody>
                    @forelse($webhook_data as $label => $value)
                        @if(
                            !empty($label) && 
                            !empty($value)
                        )
                            <tr>
                                <td>
                                    <strong>
                                        {{ucfirst(str_replace('_', ' ', $label))}}
                                    </strong>
                                </td>
                                <td>
                                    @if(!empty($value) && is_array($value))
                                        @foreach($value as $key => $data)
                                            @if(
                                                !empty($key) && 
                                                !empty($data)
                                            )
                                                {{ucfirst(str_replace('_', ' ', $key))}}
                                                :
                                                {!!nl2br($data)!!}
                                                <br>
                                            @endif
                                        @endforeach
                                    @else
                                        {!!nl2br($value ?? '')!!}
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="2" class="text-center">
                                No data found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>