{{-- @extends('layouts.admin')
@section('content')
<div class="row mb-2">
   <div class="col-sm-12">
        <h2>
           Booking List
        </h2>
   </div>
</div>
<div class="card card-primary card-outline">
        <div class="card-header">
            <a class="btn btn-success float-right" href="{{ route('admin.bookings.create') }}">
                {{ trans('global.add') }}
            </a>
        </div>
    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-bookings">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('messages.lead') }}
                    </th>
                    <th>
                        {{ trans('messages.project') }}
                    </th>
                    <th>
                        {{ trans('messages.added_on') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        @if(auth()->user()->checkPermission('eoi_delete'))
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.bookings.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                    return entry.id
                });

                if (ids.length === 0) {
                    alert('{{ trans('global.datatables.zero_selected') }}')

                    return
                }

                if (confirm('{{ trans('global.areYouSure') }}')) {
                    $.ajax({
                    headers: {'x-csrf-token': _token},
                    method: 'POST',
                    url: config.url,
                    data: { ids: ids, _method: 'DELETE' }})
                    .done(function () { location.reload() })
                }
                }
            }
            dtButtons.push(deleteButton)
        @endif

        let dtOverrideGlobals = {
            buttons: dtButtons,
            processing: true,
            serverSide: true,
            retrieve: true,
            aaSorting: [],
            ajax: "{{ route('admin.bookings.index') }}",
            columns: [
            { data: 'placeholder', name: 'placeholder' },
            { data: 'lead_name', name: 'leads.name'},
            { data: 'project_name', name: 'projects.name'},
            { data: 'created_at', name: 'lead_events.created_at' },
            { data: 'actions', name: '{{ trans('global.actions') }}' }
            ],
            orderCellsTop: true,
            order: [[ 3, 'desc' ]],
            pageLength: 100,
        };

        let table = $('.datatable-bookings').DataTable(dtOverrideGlobals);

    });
</script>
@endsection --}}
