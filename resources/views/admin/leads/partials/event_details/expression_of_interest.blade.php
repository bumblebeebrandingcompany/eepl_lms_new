@php
    $payload = $event->webhook_data ?? [];
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
                    @forelse($payload as $label => $value)
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