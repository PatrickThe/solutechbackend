@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ride.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.rides.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ride.fields.id') }}
                        </th>
                        <td>
                            {{ $ride->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ride.fields.bus') }}
                        </th>
                        <td>
                            {{ $ride->bus->select_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ride.fields.name') }}
                        </th>
                        <td>
                            {{ $ride->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ride.fields.description') }}
                        </th>
                        <td>
                            {{ $ride->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ride.fields.price') }}
                        </th>
                        <td>
                            {{ $ride->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ride.fields.arrival_time') }}
                        </th>
                        <td>
                            {{ $ride->arrival_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ride.fields.is_booking_open') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $ride->is_booking_open ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.rides.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
