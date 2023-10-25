@foreach($value as $key => $data)
    @if(!empty($data) && is_array($data))
        {{ucfirst(str_replace('_', ' ', $key))}} : &nbsp;
        @includeIf('admin.leads.partials.event_details.show_nested_data', ['value' => $data])
    @else
        @if(!empty($data))
            {{ucfirst(str_replace('_', ' ', $key))}} : 
            @if(is_array($data))
                {!!implode(', ', $data)!!}
            @else
                {!!nl2br(ucfirst(str_replace('_', ' ', $data)))!!}
            @endif
            <br>
        @endif
    @endif
@endforeach