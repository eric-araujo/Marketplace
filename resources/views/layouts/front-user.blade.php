<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        .front.row {
            margin-bottom: 40px;
        }
    </style>
    @yield('stylessheets')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 40px;">
        <a class="navbar-brand" href="{{route('home')}}">Marketplace</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item @if(request()->is('/')) active @endif">
                    <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                </li>

                @foreach ($categories as $category)
                    <li class="nav-item @if(request()->is('category/' . $category->slug)) active @endif">
                        <a class="nav-link" href="{{route('category.sigle', ['slug' => $category->slug])}}">{{$category->name}}</a>
                    </li>
                @endforeach
            </ul>
            <div class="my-2 my-lg-0">
                <ul class="navbar-nav mr-auto">
                    @auth
                        <li class="nav-item @if(request()->is('my-orders')) active @endif">
                            <a href="{{route('user.orders')}}" class="nav-link">Meus Pedidos</a>
                        </li>
                    @endauth
                    <li class="nav-item">
                        <a href="{{route('cart.index')}}" class="nav-link">
                            @if (session()->has('cart'))
                                <span class="badge badge-danger">{{count(session()->get('cart'))}}</span>
                            @endif
                            <i class="fa fa-shopping-cart fa-2x"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>
    @yield('scripts')
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>