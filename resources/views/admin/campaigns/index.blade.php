@extends('layouts.admin')

@section('content')
    <div class="row mb-2">
        <div class="col-sm-12">
            <h2>{{ $project->name }}</h2>
            <!-- Display project details -->
            <p>Project ID: {{ $project->id }}</p>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-sm-6">
            <h2>{{ trans('cruds.campaign.title_singular') }} {{ trans('global.list') }}</h2>
        </div>
    </div>

    <div class="card card-primary card-outline">
        @if (auth()->user()->checkPermission('campaign_create'))
            <div class="card-header">
                <a class="btn btn-success float-right" href="{{ route('admin.campaigns.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.campaign.title_singular') }}
                </a>
            </div>
        @endif
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-Campaign">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>{{ trans('cruds.campaign.fields.campaign_name') }}</th>
                        <th>{{ trans('cruds.campaign.fields.start_date') }}</th>
                        <th>{{ trans('cruds.campaign.fields.end_date') }}</th>
                        <th>{{ trans('cruds.campaign.fields.project') }}</th>
                        <th>{{ trans('cruds.campaign.fields.agency') }}</th>
                        <th>{{ trans('cruds.campaign.fields.created_at') }}</th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                            @if (empty($__global_clients_filter))
                                <select class="search">
                                    <option value>{{ trans('global.all') }}</option>
                                    @foreach ($campaigns as $key => $item)
                                        <option value="{{ $item->campaign_name }}">{{ $item->campaign_name }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif


                        </td>
                        <td>

                            @if (empty($__global_clients_filter))
                                <select class="search">
                                    <option value>{{ trans('global.all') }}</option>
                                    @foreach ($projects as $key => $items)
                                        <option value="{{ $items->name }}">{{ $items->name }}</option>
                                    @endforeach
                                </select>
                            @endif


                        </td>
                        <td>
                            @if (auth()->user()->is_superadmin)
                                <select class="search">
                                    <option value>{{ trans('global.all') }}</option>
                                    @foreach ($agencies as $key => $item)
                                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($campaigns as $campaign)
                        <tr>
                            <td></td>
                            <td>{{ $campaign->campaign_name }}</td>
                            <td>{{ $campaign->start_date }}</td>
                            <td>{{ $campaign->end_date }}</td>
                            <td>{{ $project->name }}</td> 
                            <td>{{ $campaign->agency->name }}</td>
                            <td>{{ $campaign->created_at }}</td>
                            <td>
                                <div class="d-flex flex-wrap">
                                    <div class="form-group mr-1 mb-1">
                                        <a href="{{ route('admin.campaigns.show', $campaign->id) }}"
                                            class="btn btn-primary btn-sm mb-1">
                                            View
                                        </a>
                                    </div>

                                    @if (!auth()->user()->is_client)
                                        <div class="form-group mr-1 mb-1">
                                            <a href="{{ route('admin.campaigns.edit', $campaign->id) }}"
                                                class="btn btn-info btn-sm mb-1">
                                                Edit
                                            </a>
                                        </div>

                                        <div class="form-group mr-1 mb-1">
                                            <button type="button" class="btn btn-danger btn-sm mb-1" data-toggle="modal"
                                                data-target="#deleteModal_{{ $campaign->id }}">
                                                Delete
                                            </button>
                                            <!-- Delete Confirmation Modal -->
                                            <div class="modal fade" id="deleteModal_{{ $campaign->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="deleteModalLabel_{{ $campaign->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="deleteModalLabel_{{ $campaign->id }}">Confirm Deletion
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this item?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel</button>
                                                            <form method="POST" action={{ route('admin.campaigns.destroy', $campaign->id) }}>
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
