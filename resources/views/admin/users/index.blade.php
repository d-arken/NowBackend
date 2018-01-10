@extends('layouts.app')
@section('content')
    <div class="container">
        <h3 style="  display: inline-block;">Usuários </h3>
        {!! Button::primary('Novo')->asLinkTo(route('user.create')) !!}
        <div class="row">
            {!! Table::withContents($users->items())
            ->striped()
            ->callback('Ações',function($field,$user){
                $linkEdit = route('user.edit',['user'=>$user->id]);
                $linkShow = route('user.show',['user'=>$user->id]);
                return  Button::link(Icon::create('edit'))
                ->asLinkTo($linkEdit).''

                .Button::link(Icon::create('remove'))
                ->asLinkTo($linkShow);
            })!!}
        </div>
        {!! $users->links() !!}
    </div>
@endsection