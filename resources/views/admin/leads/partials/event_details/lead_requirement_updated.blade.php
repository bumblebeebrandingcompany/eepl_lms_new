@php
    $payload = $event->webhook_data['payload'] ?? [];
@endphp
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered">
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
                <tbody>
                    @forelse($payload as $label => $value)
                        @if(
                            !empty($label) && 
                            !empty($value)
                        )
                            <tr>
                                <td>
                                    {{ucfirst(str_replace('_', ' ', $label))}}
                                </td>
                                <td>
                                    @if(!empty($value) && is_array($value))
                                        @includeIf('admin.leads.partials.event_details.show_nested_data', ['value' => $value])
                                    @else
                                        {!!ucfirst(str_replace('_', ' ', $value))!!}
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