@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Ver usuário</h3>

        @php $formDelete = FormBuilder::plain([
            'route'=>['user.destroy','user'=>$user->id],
            'method'=>'DELETE',
            'id'=>'formDelete',
            'style'=>'display:none'
            ]) @endphp

        {!! form($formDelete) !!}
        <div class="row">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th scope="row">#</th>
                    <td>{{$user->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{$user->name}}</td>
                </tr>
                <tr>
                    <th scope="row">E-mail</th>
                    <td>{{$user->email}}</td>
                </tr>
                <tr>
                    <th scope="row">Papel</th>
                    <td>{{$user->role==1 ? "Administrador" : "Cliente"}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            @php $iconEdit = Icon::create('edit') @endphp
            {!! Button::normal($iconEdit)->asLinkTo(route('user.edit',['user'=>$user->id])) !!}
            @php $iconDestroy = Icon::create('remove') @endphp
            {!! Button::danger($iconDestroy)
             ->addAttributes(['onclick'=> "sendDelete()"])!!}
        </div>
    </div>
    <script>

            function sendDelete(){
                document.getElementById('formDelete').submit();
            }

    </script>
@endsection