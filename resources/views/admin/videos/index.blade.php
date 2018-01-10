@extends('layouts.app')
@section('content')
    <div class="container">
        <h3 style="  display: inline-block;">Vídeos </h3>
        {!! Button::primary('Novo')->asLinkTo(route('videos.create')) !!}
        <div class="row">
            {!! Table::withContents($videos->items())
            ->striped()
            ->callback('Descriçao', function($field,$videos){
           return MediaObject::withContents([
            'image'=>$videos->small_asset,
            'link'=>$videos->file_asset,
            'heading'=>$videos->title,
            'body'=>$videos->description,
            ]);
            })
            ->callback('Ações',function($field,$videos){
                $linkEdit = route('videos.edit',['video'=>$videos->id]);
                $linkShow = route('videos.show',['video'=>$videos->id]);
                return  Button::link(Icon::create('edit'))
                ->asLinkTo($linkEdit).''.
                Button::link(Icon::create('remove'))
                ->asLinkTo($linkShow);
            })!!}
        </div>
        {!! $videos->links() !!}
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