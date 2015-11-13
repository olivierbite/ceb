@extends('layouts.default')
    @section('content_title')
        {{ trans('items.item') }}
    @endsection
@section('content')
<div class="col-sm-12">
    @if( isset( $items ) & !empty( $items ) )

    {!! $items->render() !!}

    <div class="col-sm-12">
        {!! link_to(route('items.add'), trans('item.add'), $attributes = array('class' => 'btn btn-success')) !!}
    </div>

    <table class="table table-bordered table-striped table-hover ">
        <thead>
        <th>{{ trans('item.id') }}</th>
        <th>{{ trans('item.name') }}</th>
        <th>{{ trans('item.price') }}</th>
        <th>{{ trans('item.quantity') }}</th>
        <th>{{ trans('item.description') }}</th>
        <th>{{ trans('general.action') }}</th>

        </thead>
        <tbody>
          @each ('items.item', $items, 'item', 'partials.no-item')
        </tbody>
    </table>
    @endif
</div>
<div class="col-sm-12">
    {!! link_to(route('items.add'), trans('item.add'), $attributes = array('class' => 'btn btn-success')) !!}
</div>

@endsection