@extends('layouts.default')

@section('content_title')
 {{ trans('regularisations.regularisation') }}
@endsection

@section('content')
<div class="row">
    @if (count($regularisations) > 0)
       @forelse ($regularisations as $key => $value)
           <div class="col-sm-4">
            <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ trans($value) }}</h3>
                <p>{{ trans($value.'_descriptions') }}  </p>
            </div>
            <div class="icon"><i class="ion ion-heart"></i></div>
            <a class="small-box-footer" href="{{ route('regularisation.type',['type'=>$key]) }}">
               {{ trans('give_regularisation_'.$value) }}<i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
          </div>
       @empty
           {{-- empty expr --}}
       @endforelse
    @endif

</div>
@endsection