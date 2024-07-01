@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.database.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.databases.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>

                <a class="btn btn-success" href="{{ route('admin.report.explore') }}?node=DATABASE_{{$database->id}}">
                    {{ trans('global.explore') }}
                </a>

                @can('database_edit')
                    <a class="btn btn-info" href="{{ route('admin.databases.edit', $database->id) }}">
                        {{ trans('global.edit') }}
                    </a>
                @endcan

                @can('entity_delete')
                    <form action="{{ route('admin.databases.destroy', $database->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-danger" value="{{ trans('global.delete') }}">
                    </form>
                @endcan
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th width="10%">
                            {{ trans('cruds.database.fields.name') }}
                        </th>
                        <td>
                            {{ $database->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.database.fields.description') }}
                        </th>
                        <td>
                            {!! $database->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.database.fields.entities') }}
                        </th>
                        <td>
                            @foreach($database->entities as $key => $entities)
                                <span class="label label-info">{{ $entities->name }}</span>
                                @if (!$loop->last)
                                ,
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.database.fields.entity_resp') }}
                        </th>
                        <td>
                            {{ $database->entity_resp->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.database.fields.responsible') }}
                        </th>
                        <td>
                            {{ $database->responsible }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.database.fields.informations') }}
                        </th>
                        <td>
                            @foreach($database->informations as $information)
                                <a href="{{ route('admin.information.show', $information->id) }}">
                                    {{ $information->name }}
                                </a>
                                @if (!$loop->last)
                                ,
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.database.fields.applications') }}
                        </th>
                        <td>
                            @foreach($database->applications as $application)
                                <a href="{{ route('admin.applications.show', $application->id) }}">
                                    {{ $application->name }}
                                </a>
                                @if (!$loop->last)
                                ,
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.database.fields.logical_servers') }}
                        </th>
                        <td>
                            @foreach($database->logicalServers as $logicalServer)
                                <a href="{{ route('admin.logical-servers.show', $logicalServer->id) }}">
                                    {{ $logicalServer->name }}
                                </a>
                                @if (!$loop->last)
                                ,
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.database.fields.type') }}
                        </th>
                        <td>
                            {{ $database->type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.database.fields.security_need') }}
                        </th>
                        <td>
                        {{ trans('global.confidentiality') }} :
                            @if ($database->security_need_c==0){{ trans('global.none') }}@endif
                            @if ($database->security_need_c==1)<span class="veryLowRisk">{{ trans('global.low') }}</span>@endif
                            @if ($database->security_need_c==2)<span class="lowRisk">{{ trans('global.medium') }}</span>@endif
                            @if ($database->security_need_c==3)<span class="mediumRisk">{{ trans('global.strong') }}</span>@endif
                            @if ($database->security_need_c==4)<span class="highRisk">{{ trans('global.very_strong') }}</span>@endif
                        &nbsp;
                        {{ trans('global.integrity') }} :
                            @if ($database->security_need_i==0){{ trans('global.none') }}@endif
                            @if ($database->security_need_i==1)<span class="veryLowRisk">{{ trans('global.low') }}</span>@endif
                            @if ($database->security_need_i==2)<span class="lowRisk">{{ trans('global.medium') }}</span>@endif
                            @if ($database->security_need_i==3)<span class="mediumRisk">{{ trans('global.strong') }}</span>@endif
                            @if ($database->security_need_i==4)<span class="highRisk">{{ trans('global.very_strong') }}</span>@endif
                        &nbsp;
                        {{ trans('global.availability') }} :
                            @if ($database->security_need_a==0){{ trans('global.none') }}@endif
                            @if ($database->security_need_a==1)<span class="veryLowRisk">{{ trans('global.low') }}</span>@endif
                            @if ($database->security_need_a==2)<span class="lowRisk">{{ trans('global.medium') }}</span>@endif
                            @if ($database->security_need_a==3)<span class="mediumRisk">{{ trans('global.strong') }}</span>@endif
                            @if ($database->security_need_a==4)<span class="highRisk">{{ trans('global.very_strong') }}</span>@endif
                        &nbsp;
                        {{ trans('global.tracability') }} :
                            @if ($database->security_need_t==0){{ trans('global.none') }}@endif
                            @if ($database->security_need_t==1)<span class="veryLowRisk">{{ trans('global.low') }}</span>@endif
                            @if ($database->security_need_t==2)<span class="lowRisk">{{ trans('global.medium') }}</span>@endif
                            @if ($database->security_need_t==3)<span class="mediumRisk">{{ trans('global.strong') }}</span>@endif
                            @if ($database->security_need_t==4)<span class="highRisk">{{ trans('global.very_strong') }}</span>@endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.database.fields.external') }}
                        </th>
                        <td>
                            {{ $database->external }}
                        </td>
                    </tr>
                    <tr>
                        <th width="10%">
                            {{ trans('cruds.maturity.maturity') }}
                        </th>
                        <td>
                            {{ $database->maturity }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.databases.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
    <div class="card-footer">
        {{ trans('global.created_at') }} {{ $database->created_at ? $database->created_at->format(trans('global.timestamp')) : '' }} |
        {{ trans('global.updated_at') }} {{ $database->updated_at ? $database->updated_at->format(trans('global.timestamp')) : '' }} 
    </div>
</div>

@endsection