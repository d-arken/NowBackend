@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Ver Categoria</h3>

        @php $formDelete = FormBuilder::plain([
            'route'=>['series.destroy','category'=>$series->id],
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
                    <td>{{$series->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Título</th>
                    <td>{{$series->title}}</td>
                </tr>

                <tr>
                    <th scope="row">Descrição</th>
                    <td>{{$series->description}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            @php $iconEdit = Icon::create('edit') @endphp
            {!! Button::normal($iconEdit)->asLinkTo(route('series.edit',['serie'=>$series->id])) !!}
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