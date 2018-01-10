@extends('layouts.app')
@section('content')
    <div class="container">
        <h3 style="  display: inline-block;">Séries </h3>
        {!! Button::primary('Nova')->asLinkTo(route('series.create')) !!}
        <div class="row">
            {!! Table::withContents($serie->items())
            ->striped()
            ->callback('Descriçao', function($field,$serie){
           return MediaObject::withContents([
            'image'=> $serie->small_asset,
            'link'=>'#',
            'heading'=>$serie->title,
            'body'=>$serie->description,
            ]);
            })
            ->callback('Ações',function($field,$serie){
                $linkEdit = route('series.edit',['video'=>$serie->id]);
                $linkShow = route('series.show',['video'=>$serie->id]);
                return  Button::link(Icon::create('edit'))
                ->asLinkTo($linkEdit).''.
                Button::link(Icon::create('remove'))
                ->asLinkTo($linkShow);
            })!!}
        </div>
        {!! $serie->links() !!}
    </div>
@endsection
@push('styles')
<style type="text/css">
    table > thead > tr > th:nth-child(2){
        width: 80%;
    }
    .media-body{
        width: auto;
    }
</style>
@endpush