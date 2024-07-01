@extends('layouts.admin')
@section('content')
    
<div class="form-group">
    <div class="form-group">
        <a class="btn btn-default" href="{{ route('admin.workstations.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
        @can('workstation_edit')
            <a class="btn btn-info" href="{{ route('admin.workstations.edit', $workstation->id) }}">
                {{ trans('global.edit') }}
            </a>
        @endcan

        @can('workstation_delete')
            <form action="{{ route('admin.workstations.destroy', $workstation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="btn btn-danger" value="{{ trans('global.delete') }}">
            </form>
        @endcan
    </div>

<div class="card">
    <!---------------------------------------------------------------------------------------------------->
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.workstation.title') }}
    </div>
    <!---------------------------------------------------------------------------------------------------->
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <dt>{{ trans('cruds.workstation.fields.name') }}</dt>
                {{ $workstation->name }}
            </div>
            <div class="col-md-6">
                <dt>{{ trans('cruds.workstation.fields.type') }}</dt>
                {{ $workstation->type }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <dt>{{ trans('cruds.workstation.fields.description') }}</dt>
                {!! $workstation->description !!}
            </div>
        </div>
    </div>
    <!---------------------------------------------------------------------------------------------------->
    <div class="card-header">
        {{ trans("cruds.menu.application.title_short") }}
    </div>
    <!---------------------------------------------------------------------------------------------------->
    <div class="card-body">
        <div class="row">
            <div class="col-sm">
                <dt>{{ trans('cruds.workstation.fields.applications') }}</dt>
                @foreach($workstation->applications as $application)
                    <a href="{{ route('admin.applications.show', $application->id) }}">
                        {{ $application->name }}
                    </a>
                    @if(!$loop->last)
                    ,
                    @endif                                
                @endforeach
            </div>
        </div>
    </div>
    <!---------------------------------------------------------------------------------------------------->
    <div class="card-header">
        {{ trans("cruds.menu.logical_infrastructure.title_short") }}
    </div>
    <!---------------------------------------------------------------------------------------------------->
    <div class="card-body">
        <div class="row">
            <div class="col-sm-2">
                <b>{{ trans('cruds.workstation.fields.cpu') }}</b>
                {{ $workstation->cpu }}
            </div>
            <div class="col-sm-2">
                <b>{{ trans('cruds.workstation.fields.memory') }}</b>
                {{ $workstation->memory }}
            </div>
            <div class="col-sm-2">
                <b>{{ trans('cruds.workstation.fields.disk') }}</b>
                {{ $workstation->disk }}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">      
                <dt>{{ trans('cruds.workstation.fields.operating_system') }}</dt>
                {!! $workstation->operating_system !!}
            </div>
            <div class="col-sm-4">      
                <dt>{{ trans('cruds.workstation.fields.address_ip') }}</dt>
                {!! $workstation->address_ip !!}
            </div>
        </div>
    </div>
    <!---------------------------------------------------------------------------------------------------->
    <div class="card-header">
        {{ trans("cruds.menu.physical_infrastructure.title_short") }}
    </div>
    <!---------------------------------------------------------------------------------------------------->
    <div class="card-body">
        <div class="row">
            <div class="col-lg">
                <b>{{ trans('cruds.workstation.fields.site') }}</b>
                {{ $workstation->site->name ?? '' }}
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <b>{{ trans('cruds.workstation.fields.building') }}</b>
                {{ $workstation->building->name ?? '' }}
            </div>
        </div>
    </div>
    <div class="card-footer">
        {{ trans('global.created_at') }} {{ $workstation->created_at ? $workstation->created_at->format(trans('global.timestamp')) : '' }} |
        {{ trans('global.updated_at') }} {{ $workstation->updated_at ? $workstation->updated_at->format(trans('global.timestamp')) : '' }} 
    </div>
    <tr>
        <th width="10%">
            {{ trans('cruds.maturity.maturity') }}
        </th>
        <td>
            {{ $workstation->maturity }}
        </td>
    </tr>
</div>
<div class="form-group">
    <a class="btn btn-default" href="{{ route('admin.workstations.index') }}">
        {{ trans('global.back_to_list') }}
    </a>

@endsection