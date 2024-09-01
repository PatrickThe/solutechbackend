@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.ride.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("rides.update", $ride->id) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="destination_id">Destination</label>
                <select class="form-control select2 {{ $errors->has('bus') ? 'is-invalid' : '' }}" name="destination_id" id="destination_id" required>
                    @foreach($buses as $id => $bus)
                        <option value="{{ $id }}" {{ ($ride->bus ? $ride->bus->id : old('destination_id')) == $id ? 'selected' : '' }}>{{ $bus }}</option>
                    @endforeach
                </select>
                @if($errors->has('bus'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bus') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ride.fields.bus_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $ride->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ride.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="description">Description</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $ride->description) }}" required>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ride.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price">Price</label>
                <input class="form-control datetime {{ $errors->has('price') ? 'is-invalid' : '' }}" type="text" name="price" id="price" value="{{ old('price', $ride->price) }}" required>
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ride.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="arrival_time">Slots</label>
                <input class="form-control  {{ $errors->has('slots') ? 'is-invalid' : '' }}" type="text" name="slots" id="slots" value="{{ old('slots', $ride->slots) }}" required>
                @if($errors->has('arrival_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('slots') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ride.fields.arrival_time_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_booking_open') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="is_booking_open" id="is_booking_open" value="1" {{ $ride->is_booking_open || old('is_booking_open', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_booking_open">{{ trans('cruds.ride.fields.is_booking_open') }}</label>
                </div>
                @if($errors->has('is_booking_open'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_booking_open') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ride.fields.is_booking_open_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
