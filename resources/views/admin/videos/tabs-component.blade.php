<?php
$tabs = [
    [
        'title'=>'Informações',
        'link'=> isset($video) ? route('videos.edit',['video'=>$video->id]) : route('videos.create'),
    ],
    [
        'title'=>'Série e Categorias',
        'link'=>  isset($video) ? route('videos.relations.create',['video'=>$video->id]) : '#',
        'disable' => isset($video) ? false : true,
    ],
    [
        'title'=> 'Vídeo e Thumbnail',
        'link'=> isset($video) ? route('videos.uploads.create',['video'=>$video->id]) : '#',
        'disable' =>  isset($video) ? false : true,
    ],
];
?>
<h3>Gerenciar Vídeo</h3>
<div class="text-right">
    {!! Button::link('Listar vídeos')->asLinkTo(route('videos.index')) !!}
</div>
{!! Navigation::tabs($tabs) !!}
<div>
    {!! $slot !!}
</div>
