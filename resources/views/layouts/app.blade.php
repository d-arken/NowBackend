<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PecegeNow') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
@php $formLogout = FormBuilder::plain([
            'route'=>['logout'],
            'method'=>'POST',
            'id'=>'formLogout',
            'style'=>'display:none'
            ]) @endphp
<div id="app">
    <?php $nav = Navbar::withBrand(config('app.name', url('home')))->inverse();
    if(Auth::check()){
        $links = [
            ['link'=>route('user.index'),'title'=>'Usuário'],
            ['link'=>route('categories.index'),'title'=>'Categoria'],
            ['link'=>route('series.index'),'title'=>'Séries'],
            ['link'=>route('videos.index'),'title'=>'Vídeos'],
        ];
        $linksRight = [
            [
                Auth::user()->name,
                [
                    ['link'=>route('logout'),
                        'title'=>'Sair',
                        'linkAttributes'=> [
                            'onclick'=>'logout();'
                        ]],
                ]
            ]
        ];
        $menu = Navigation::links($links);
        $menuRight = Navigation::links($linksRight)->right();
        $nav->withContent($menu)->withContent($menuRight);
    }else{
        $links = [
            ['link'=>route('login'),'title'=>'Entrar'],
        ];
        $menu = Navigation::links($links)->right();
        $nav->withContent($menu);
    }
    ?>



    {!! form($formLogout) !!}
    {!! $nav !!}

    @if(Session::has('message'))
        <div class="container">
            {!! Alert::success(Session::get('message'))->close() !!}
        </div>
    @endif

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script>
    function logout(){
        event.preventDefault();
        document.getElementById('formLogout').submit();
    }
</script>
</body>
</html>
