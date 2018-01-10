@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Ver vídeos</h3>

        @php $formDelete = FormBuilder::plain([
            'route'=>['videos.destroy','category'=>$video->id],
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
                    <td>{{$video->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Título</th>
                    <td>{{$video->title}}</td>
                </tr>
                <tr>
                    <th scope="row">Thumbnail</th>
                    <td><img class="img-responsive img-thumbnail" src="{{$video->thumb_asset}}"></td>
                </tr>
                <tr>
                    <th scope="row">Download</th>
                    <td><a href="{{$video->file_asset}}">Clique aqui</a></td>
                </tr>
                <tr>
                    <th scope="row">Descrição</th>
                    <td>{{$video->description}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            @php $iconEdit = Icon::create('edit') @endphp
            {!! Button::normal($iconEdit)->asLinkTo(route('videos.edit',['video'=>$video->id])) !!}
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