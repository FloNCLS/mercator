@extends('layouts.admin')
@section('content')

<div class="form-group">
    <a class="btn btn-default" href="{{ route('admin.peripherals.index') }}">
        {{ trans('global.back_to_list') }}
    </a>
    @can('peripheral_edit')
        <a class="btn btn-info" href="{{ route('admin.peripherals.edit', $peripheral->id) }}">
            {{ trans('global.edit') }}
        </a>
    @endcan

    @can('peripheral_delete')
        <form action="{{ route('admin.peripherals.destroy', $peripheral->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" class="btn btn-danger" value="{{ trans('global.delete') }}">
        </form>
    @endcan
</div>

<div class="card">
    <div class="card-header">
        {{ trans('cruds.peripheral.title_singular') }}
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th width="10%">
                        {{ trans('cruds.peripheral.fields.name') }}
                    </th>
                    <td colspan='3'>
                        {{ $peripheral->name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.peripheral.fields.description') }}
                    </th>
                    <td colspan='3'>
                        {!! $peripheral->description !!}
                    </td>
                </tr>
                <tr>
                    <th width="10%">
                        {{ trans('cruds.peripheral.fields.domain') }}
                    </th>
                    <td  width="20%">
                        {{ $peripheral->domain }}
                    </td>
                    <th width="10%">
                        {{ trans('cruds.peripheral.fields.type') }}
                    </th>
                    <td  width="60%">
                        {{ $peripheral->type }}
                    </td>
                </tr>
                <tr>
                    <th width="10%">
                        {{ trans('cruds.maturity.maturity') }}
                    </th>
                    <td>
                        {{ $peripheral->maturity }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!------------------------------------------------------------------------------------------------------------->
    <div class="card-header">
        {{ trans("cruds.menu.ecosystem.title") }}
    </div>
    <!------------------------------------------------------------------------------------------------------------->
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th width="10%">
                        {{ trans('cruds.peripheral.fields.provider') }}
                    </th>
                    <td>
                        @if($peripheral->provider!=null)
                            <a href="{{ route('admin.entities.show', $peripheral->provider->id) }}">
                                {{ $peripheral->provider->name }}
                            </a>
                        @endif
                    </td>
                    <th width="10%">
                        {{ trans('cruds.peripheral.fields.responsible') }}
                    </th>
                    <td>
                        {{ $peripheral->responsible ?? '' }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!------------------------------------------------------------------------------------------------------------->
    <div class="card-header">
        {{ trans("cruds.menu.application.title") }}
    </div>
    <!------------------------------------------------------------------------------------------------------------->
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th width="10%">
                        {{ trans('cruds.peripheral.fields.applications') }}
                    </th>
                    <td>
                        @foreach($peripheral->applications as $application)
                            <a href="{{ route('admin.applications.show', $application->id) }}">
                            {{ $application->name }}
                            </a>
                            @if(!$loop->last), @endif
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!------------------------------------------------------------------------------------------------------------->
    <div class="card-header">
        Common Plateforme Enumeration (CPE)
    </div>
    <!------------------------------------------------------------------------------------------------------------->
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th width="10%">
                        {{ trans('cruds.peripheral.fields.vendor') }}
                    </th>
                    <td width="23%">
                        {{ $peripheral->vendor }}
                    </td>
                    <th width="10%">
                        {{ trans('cruds.peripheral.fields.product') }}
                    </th>
                    <td width="23%">
                        {{ $peripheral->product }}
                    </td>
                    <th width="10%">
                        {{ trans('cruds.peripheral.fields.version') }}
                    </th>
                    <td width="23%">
                        {{ $peripheral->pversion }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!------------------------------------------------------------------------------------------------------------->
    <div class="card-header">
        {{ trans("cruds.menu.physical_infrastructure.title_short") }}
    </div>
    <!------------------------------------------------------------------------------------------------------------->
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th width="10%">
                        {{ trans('cruds.peripheral.fields.site') }}
                    </th>
                    <td width="23%">
                        @if($peripheral->site!=null)
                            <a href="{{ route('admin.sites.show', $peripheral->site->id) }}">
                            {{ $peripheral->site->name }}
                            </a>
                        @endif
                    </td>
                    <th width="10%">
                        {{ trans('cruds.peripheral.fields.building') }}
                    </th>
                    <td  width="23%">
                        @if($peripheral->building!=null)
                            <a href="{{ route('admin.buildings.show', $peripheral->building->id) }}">
                                {{ $peripheral->building->name }}
                            </a>
                        @endif
                    </td>
                    <th width="10%">
                        {{ trans('cruds.peripheral.fields.bay') }}
                    </th>
                    <td width="23%">
                        @if($peripheral->bays!=null)
                            <a href="{{ route('admin.bays.show', $peripheral->bay->id) }}">
                                {{ $peripheral->bay->name }}
                            </a>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ trans('global.created_at') }} {{ $peripheral->created_at ? $peripheral->created_at->format(trans('global.timestamp')) : '' }} |
        {{ trans('global.updated_at') }} {{ $peripheral->updated_at ? $peripheral->updated_at->format(trans('global.timestamp')) : '' }}
    </div>
</div>
<a class="btn btn-default" href="{{ route('admin.peripherals.index') }}">
    {{ trans('global.back_to_list') }}
</a>
<br><br>
@endsection
