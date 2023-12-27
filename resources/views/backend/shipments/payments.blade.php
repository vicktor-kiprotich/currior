@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar mb-3 mt-2 text-left">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">{{ translate('All Customers') }}</h1>
            </div>
            <div class="col-md-6 text-md-right">
                <a href="{{ route('admin.clients.create') }}" class="btn btn-circle btn-info">
                    <span>{{ translate('Add New Customers') }}</span>
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="h6 mb-0">{{ translate('Customers') }}</h5>
        </div>
        <div class="card-body">
            <table class="aiz-table mb-0 table">
                <thead>
                    <tr>
                        <th width="3%">#</th>
                        <th>{{ translate('Name') }}</th>
                        <th>{{ translate('Email') }}</th>
                        <th>{{ translate('Phone') }}</th>

                        <th width="10%" class="text-center">{{ translate('Options') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $key => $client)
                        <tr>
                            <td width="3%">{{ $key + 1 + ($clients->currentPage() - 1) * $clients->perPage() }}</td>
                            <td width="20%">{{ $client->name }}</td>
                            <td width="20%">{{ $client->email }}</td>
                            <td width="20%">{{ $client->responsible_mobile }}</td>

                            <td class="text-center">
                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                    href="{{ route('admin.clients.show', $client->id) }}" title="{{ translate('Show') }}">
                                    <i class="las la-eye"></i>
                                </a>
                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                    href="{{ route('admin.clients.edit', $client->id) }}" title="{{ translate('Edit') }}">
                                    <i class="las la-edit"></i>
                                </a>
                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                    data-href="{{ route('admin.clients.delete-client', ['client' => $client->id]) }}"
                                    title="{{ translate('Delete') }}">
                                    <i class="las la-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
                {{ $clients->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
    {!! hookView('spot-cargo-shipment-client-addon', $currentView) !!}
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
