<?php

namespace App\Http\Controllers\Admin;

use App\Bus;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRideRequest;
use App\Http\Requests\StoreRideRequest;
use App\Http\Requests\UpdateRideRequest;
use App\Ride;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RidesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ride_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rides = Ride::all();
        
        return view('admin.rides.index', compact('rides'));
    }

    public function create()
    {
       
        abort_if(Gate::denies('ride_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $buses = Bus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        
        $destinations = Bus::get();

        return view('admin.rides.create', compact('destinations'));
    }

    public function store(Request $request)
    {
        $ride = Ride::create($request->all());

        return redirect()->route('admin.rides.index');
    }

    public function edit(Ride $ride)
    {
        
        abort_if(Gate::denies('ride_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $buses = Bus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ride->load('bus');

        return view('admin.rides.edit', compact('buses', 'ride'));
    }

    public function update(Request $request, Ride $ride)
    {
       
        $ride->update($request->all());

        return redirect()->route('admin.rides.index');
    }

    public function show(Ride $ride)
    {
        abort_if(Gate::denies('ride_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ride->load('bus');

        return view('admin.rides.show', compact('ride'));
    }

    public function destroy(Ride $ride)
    {
        abort_if(Gate::denies('ride_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ride->delete();

        return back();
    }

    public function massDestroy(MassDestroyRideRequest $request)
    {
        Ride::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
