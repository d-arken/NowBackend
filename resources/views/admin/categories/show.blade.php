@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Ver Categoria</h3>

        @php $formDelete = FormBuilder::plain([
            'route'=>['categories.destroy','category'=>$category->id],
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
                    <td>{{$category->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{$category->name}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            @php $iconEdit = Icon::create('edit') @endphp
            {!! Button::normal($iconEdit)->asLinkTo(route('categories.edit',['categories'=>$category->id])) !!}
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