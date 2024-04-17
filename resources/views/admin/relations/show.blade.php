@extends('layouts.admin')
@section('content')

<div class="form-group">
    <a class="btn btn-default" href="{{ route('admin.relations.index') }}">
        {{ trans('global.back_to_list') }}
    </a>

    <a class="btn btn-success" href="{{ route('admin.report.explore') }}?node=REL_{{$relation->id}}">
        {{ trans('global.explore') }}
    </a>

    @can('entity_edit')
        <a class="btn btn-info" href="{{ route('admin.relations.edit', $relation->id) }}">
            {{ trans('global.edit') }}
        </a>
    @endcan

    @can('entity_delete')
        <form action="{{ route('admin.relations.destroy', $relation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" class="btn btn-danger" value="{{ trans('global.delete') }}">
        </form>
    @endcan

    </div>
    <div class="card">
    <!--------------------------------------------------------------------------->
    <div class="card-header">
        {{ trans('cruds.relation.title_singular') }}
    </div>
    <!--------------------------------------------------------------------------->
    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th width="10%">
                            {{ trans('cruds.relation.fields.name') }}
                        </th>
                        <td>
                            {{ $relation->name }}
                        </td>
                        <th>
                            {{ trans('cruds.relation.fields.type') }}
                        </th>
                        <td>
                            {{ $relation->type }}
                        </td>
                        <th>
                            {{ trans('cruds.relation.fields.attributes') }}
                        </th>
                        <td>
                            @foreach(explode(" ",$relation->attributes) as $attribute)
                            <span class="badge badge-info">{{ $attribute }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.relation.fields.reference') }}
                        </th>
                        <td>
                            {{ $relation->reference }}
                        </td>
                        <th>
                            {{ trans('cruds.relation.fields.order_number') }}
                        </th>
                        <td>
                            {{ $relation->order_number }}
                        </td>
                        <th>
                            {{ trans('cruds.relation.fields.responsible') }}
                        </th>
                        <td>
                            {{ $relation->responsible }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.relation.fields.source') }}
                        </th>
                        <td>
                            <a href="{{ route('admin.entities.show', $relation->source_id) }}">
                            {{ $relation->source->name ?? '' }}
                            </a>
                        </td>
                        <th>
                            {{ trans('cruds.relation.fields.destination') }}
                        </th>
                        <td colspan='4'>
                            <a href="{{ route('admin.entities.show', $relation->destination_id) }}">
                            {{ $relation->destination->name ?? '' }}
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.relation.fields.description') }}
                        </th>
                        <td colspan="5">
                            {!! $relation->description !!}
                        </td>
                    </tr>


                </table>
            </div>
        </div>
        <!--------------------------------------------------------------------------->
        <div class="card-header">
            Termes du contrat
        </div>
        <!--------------------------------------------------------------------------->
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    {{ trans('cruds.relation.fields.start_date') }}
                                </th>
                                <td>
                                    {{ $relation->start_date }}
                                </td>
                                <th>
                                    {{ trans('cruds.relation.fields.end_date') }}
                                </th>
                                <td>
                                    {{ $relation->end_date }}
                                </td>
                                <td>
                                    @if ($relation->active)
                                        {{ trans('cruds.relation.fields.active') }}
                                    @endif
                                </td>
                                <th>
                                    {{ trans('cruds.relation.fields.importance') }}
                                    &nbsp;
                                      @if ($relation->importance==1)
                                          <span id=1 class="veryLowRisk">
                                          {{ trans('cruds.relation.fields.importance_level.low') }}
                                      </span>
                                      @elseif ($relation->importance==2)
                                          <span id=2 class="lowRisk">
                                          {{ trans('cruds.relation.fields.importance_level.medium') }}
                                      </span>
                                      @elseif ($relation->importance==3)
                                        <span id=3 class="mediumRisk">
                                          {{ trans('cruds.relation.fields.importance_level.high') }}
                                        </span>
                                      @elseif ($relation->importance==4)
                                        <span id=4 class="highRisk">
                                        {{ trans('cruds.relation.fields.importance_level.critical') }}
                                        </span>
                                      @endif
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($relation->values()->count()>0)
            <div class="row">
                <div class="col-4">

                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>Date</th>
                                <th>Valeur</th>
                            </tr>
                            @foreach($relation->values()->get() as $value)
                            <tr>
                                <td>{{ $value->date_price }}</td>
                                <td>
                                    {{ Illuminate\Support\Number::currency($value->price, 'EUR', 'fr') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-8">
                    <canvas id="chart_value_canvas"></canvas>
                </div>
            </div>
            @endif
        </div>
        <!--------------------------------------------------------------------------->
        <div class="card-header">
            Commentaire / Documentation
        </div>
        <!--------------------------------------------------------------------------->
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th width='10%'>
                            {{ trans('cruds.relation.fields.comments') }}
                        </th>
                        <td>
                            {!! $relation->comments !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.relation.fields.documents') }}
                        </th>
                        <td>
                            @foreach($relation->documents as $document)
                                <a href="{{ route('admin.documents.show', $document->id) }}">{{ $document->filename }}</a>
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <div class="card-footer">
        {{ trans('global.created_at') }} {{ $relation->created_at ? $relation->created_at->format(trans('global.timestamp')) : '' }} |
        {{ trans('global.updated_at') }} {{ $relation->updated_at ? $relation->updated_at->format(trans('global.timestamp')) : '' }}
    </div>
</div>

<div class="form-group">
    <a class="btn btn-default" href="{{ route('admin.relations.index') }}">
        {{ trans('global.back_to_list') }}
    </a>
</div>
@endsection

@section('scripts')
@if ($relation->values()->count()>1)
<script src="/js/Chart.bundle.js"></script>
<script>
    window.onload = function() {

      var ctx = document.getElementById('chart_value_canvas').getContext('2d');

      const data = [
        @foreach($relation->values()->get() as $value)
        { x: new Date('{{ Carbon\Carbon::createFromFormat(config("panel.date_format"), $value->date_price)->format("Y-m-d") }}'), y: {{ $value->price }} },
        @endforeach
      ];

      var chart = new Chart(ctx, {
            type: 'line',
            data: {

              datasets: [{
                data: data,
                }]
            },

            options: {
                responsive: true,
                 legend: {
                    display: false,
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                   xAxes: [{
                        type: 'time',
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Date'
                        },
                        ticks: {
                            major: {
                                fontStyle: 'bold',
                                fontColor: '#FF0000'
                            }
                        }
                    }],
                },
            }
        });
    }
</script>
@endif
@endsection
