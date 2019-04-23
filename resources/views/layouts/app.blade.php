<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Galileo') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <v-app>
            <flash message=""></flash>
            <v-toolbar id="main-nav" fixed color="white" light class="pt-1 pb-1" app>
                <v-toolbar-title>
                    <a class="navbar-brand light-blue--text text-uppercase font-weight-black" href="{{ url('/') }}">
                        <img src="{{ asset('/img/logo/logo-galileo-color-dark.png') }}" width="100">
                    </a>
                </v-toolbar-title>
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link grey--text darken-1--text" href="{{ url('/programmes') }}">{{ __('Acheter') }}</a>
                    </li>
                </ul>
                <v-spacer></v-spacer>

                    <!-- Authentication Links -->
                    @guest
                        <login></login>


                        {{--<li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            @if (Route::has('register'))
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                <v-btn round color="primary" dark href="{{ route('register') }}">Rounded Button</v-btn>
                            @endif
                        </li>--}}
                    @else
                    <v-toolbar-items style="height: auto;">
                        <v-divider class="mt-2 mb-2" vertical></v-divider>
                        <li class="nav-item text-center pt-2 pb-2">

                            @if(count(Auth::user()->favoritesLots) > 0)
                                <v-badge color="red" >
                                    <template v-slot:badge>
                                        <span>{{count(Auth::user()->favoritesLots)}}</span>
                                    </template>
                                    <v-icon flat>favorite</v-icon>
                                </v-badge>
                            @else
                                <v-badge color="red" >
                                    <template v-slot:badge>
                                        <span>{{count(Auth::user()->favoritesLots)}}</span>
                                    </template>
                                    <v-icon>favorite_border</v-icon>
                                </v-badge>
                            @endif

                            <a class="nav-link grey--text darken-1--text pt-0 pb-0" @click.stop="drawer = !drawer" href="{{ url('my_favorites') }}"><span>Mes Favoris</span></a>

                        </li>
                        <v-divider class="mt-2 mb-2" vertical></v-divider>

                        <li class="nav-item dropdown text-center pt-2 pb-2">
                            @if(count(Auth::user()->unreadNotifications) > 0)
                                <v-badge color="red" >
                                    <template v-slot:badge>
                                        <span>{{count(Auth::user()->unreadNotifications)}}</span>
                                    </template>
                                    <v-icon flat>notifications</v-icon>
                                </v-badge>
                            @else
                                <v-badge color="red" >
                                    <template v-slot:badge>
                                        <span>{{count(Auth::user()->unreadNotifications)}}</span>
                                    </template>
                                    <v-icon>notifications_none</v-icon>
                                </v-badge>
                            @endif
                            </v-badge>
                            <!--<a class="nav-link grey--text darken-1--text" @click.stop="drawer = !drawer" href="#"><span>Notifications</span></a>-->
                            <a id="notifDropdown" class="nav-link grey--text darken-1--text dropdown-toggle pt-0 pb-0" href="#" x-placement="bottom-end" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Notifications <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <v-list two-line>
                                    <v-subheader>
                                        <a href="{{ route('notifications.index') }}">Voir toutes les notifications</a>
                                    </v-subheader>
                                    <v-divider class="mt-0 mb-0"></v-divider>
                                    {{--<li>
                                        <a href="{{ route('notification.index') }}">Voir toutes les notifications</a>
                                    </li>--}}

                                    @foreach (Auth::user()->unreadNotifications as $notification)
                                        @switch( $notification->type )
                                            @case('App\Notifications\NewDenonce')
                                            @php ($type = 'Dénonce')
                                            @if($notification->data['programme']['name'] === null)
                                                @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' a dénoncé un client')
                                            @else
                                                @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' a dénoncé un client pour le programme ' . addslashes($notification->data['programme']['name']) )
                                            @endif
                                            <notifications
                                                    :id="'{{ $notification->id }}'"
                                                    :type="'{{ $type }}'"
                                                    :avatar="'{{ $notification->data['user']['avatar'] }}'"
                                                    :firstname="'{{ $notification->data['user']['firstname'] }}'"
                                                    :lastname="'{{ $notification->data['user']['lastname'] }}'"
                                                    :email="'{{ $notification->data['user']['email'] }}'"
                                                    :phone="'{{ $notification->data['user']['phone'] }}'"
                                                    :zipcode="'{{ $notification->data['user']['zipcode'] }}'"
                                                    :city="'{{ $notification->data['user']['city'] }}'"
                                                    :programme="'{!! addslashes($notification->data['programme']['name']) !!}'"
                                                    :lot="'{{ $notification->data['lot']['numero'] }}'"
                                                    :message="'{{ $msg }}'"
                                                    :inset="'{{ true }}'"
                                            ></notifications>
                                            @break
                                            @case('App\Notifications\ContactNotification')
                                            @php ($type = 'Contact')
                                            @if($notification->data['programme']['name'] === null)
                                                @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' vous a contacté')
                                            @else
                                                @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' vous a contacté pour le programme ' . addslashes($notification->data['programme']['name']) )
                                            @endif
                                            <notifications
                                                    :id="'{{ $notification->id }}'"
                                                    :type="'{{ $type }}'"
                                                    :avatar="'{{ $notification->data['user']['avatar'] }}'"
                                                    :firstname="'{{ $notification->data['user']['firstname'] }}'"
                                                    :lastname="'{{ $notification->data['user']['lastname'] }}'"
                                                    :email="'{{ $notification->data['user']['email'] }}'"
                                                    :phone="'{{ $notification->data['user']['phone'] }}'"
                                                    :zipcode="'{{ $notification->data['user']['zipcode'] }}'"
                                                    :city="'{{ $notification->data['user']['city'] }}'"
                                                    :programme="'{!! addslashes($notification->data['programme']['name']) !!}'"
                                                    :lot="'{{ $notification->data['lot']['numero'] }}'"
                                                    :message="'{{ $msg }}'"
                                                    :inset="'{{ true }}'"
                                            ></notifications>
                                            @break
                                            @case('App\Notifications\NewCall')
                                            @php ($type = 'Call')
                                            @if($notification->data['programme']['name'] === null)
                                                @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' souhaite être rappelé')
                                            @else
                                                @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' souhaite être rappelé pour le programme ' . addslashes($notification->data['programme']['name']) )
                                            @endif
                                            <notifications
                                                    :id="'{{ $notification->id }}'"
                                                    :type="'{{ $type }}'"
                                                    :avatar="'{{ $notification->data['user']['avatar'] }}'"
                                                    :firstname="'{{ $notification->data['user']['firstname'] }}'"
                                                    :lastname="'{{ $notification->data['user']['lastname'] }}'"
                                                    :email="'{{ $notification->data['user']['email'] }}'"
                                                    :phone="'{{ $notification->data['user']['phone'] }}'"
                                                    :address="'{{ $notification->data['user']['address'] }}'"
                                                    :zipcode="'{{ $notification->data['user']['zipcode'] }}'"
                                                    :city="'{{ $notification->data['user']['city'] }}'"
                                                    :programme="'{!! addslashes($notification->data['programme']['name']) !!}'"
                                                    :lot="'{{ $notification->data['lot']['numero'] }}'"
                                                    :message="'{{ $msg }}'"
                                                    :inset="'{{ true }}'"
                                            ></notifications>
                                            @break
                                        @endswitch

                                    @endforeach
                                </v-list>

                            </div>
                        </li>
                        <v-divider class="mt-2 mb-2" vertical></v-divider>
                        <li class="nav-item dropdown text-center pt-2 pb-2">
                            <v-icon>perm_identity</v-icon>
                            <a id="navbarDropdown" class="nav-link grey--text darken-1--text dropdown-toggle pt-0 pb-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item grey--text darken-1--text" href="{{ url('/admin') }}">{{ __('dashboard') }}</a>
                                <a class="dropdown-item grey--text darken-1--text" href="{{ url('/programmes') }}">{{ __('programmes') }}</a>
                                <a class="dropdown-item grey--text darken-1--text" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    @endguest
                </v-toolbar-items>
            </v-toolbar>
            {{--<nav class="white navbar navbar-expand-md navbar-dark navbar-laravel navbar-fixed-top fixed" >
                <div class="container-fluid">
                    <a class="navbar-brand light-blue--text text-uppercase font-weight-black" href="{{ url('/') }}">
                        <img src="{{ asset('/img/logo/logo-galileo-color-dark.png') }}" width="100">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link grey--text darken-1--text" href="{{ url('/programmes') }}">{{ __('Acheter') }}</a>
                            </li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Authentication Links -->
                            @guest
                                <login></login>

                                --}}{{--<li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                <li class="nav-item">
                                    @if (Route::has('register'))
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        <v-btn round color="primary" dark href="{{ route('register') }}">Rounded Button</v-btn>
                                    @endif
                                </li>--}}{{--
                            @else
                                <v-divider class="mt-2 mb-2" vertical></v-divider>
                                <li class="nav-item text-center">
                                    @if(count(Auth::user()->favoritesLots) > 0)
                                        <v-badge color="red">
                                            <template v-slot:badge>
                                                <span>{{count(Auth::user()->favoritesLots)}}</span>
                                            </template>
                                            <v-icon flat>favorite</v-icon>
                                        </v-badge>
                                    @else
                                        <v-badge color="red">
                                            <template v-slot:badge>
                                                <span>{{count(Auth::user()->favoritesLots)}}</span>
                                            </template>
                                            <v-icon>favorite_border</v-icon>
                                        </v-badge>
                                    @endif

                                    <a class="nav-link grey--text darken-1--text" @click.stop="drawer = !drawer" href="{{ url('my_favorites') }}"><span>Mes Favoris</span></a>
                                </li>
                                <v-divider class="mt-2 mb-2" vertical></v-divider>

                                <li class="nav-item dropdown text-center">

                                    <v-badge color="red">
                                        <template v-slot:badge>
                                            <span>{{count(Auth::user()->unreadNotifications)}}</span>
                                        </template>
                                        <v-icon
                                        >
                                            notifications_none
                                        </v-icon>
                                    </v-badge>
                                    <!--<a class="nav-link grey--text darken-1--text" @click.stop="drawer = !drawer" href="#"><span>Notifications</span></a>-->
                                    <a id="notifDropdown" class="nav-link grey--text darken-1--text dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Notifications <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <v-list two-line>
                                            <v-subheader>
                                                <a href="{{ route('notifications.index') }}">Voir toutes les notifications</a>
                                            </v-subheader>
                                            <v-divider class="mt-0 mb-0"></v-divider>
                                            --}}{{--<li>
                                                <a href="{{ route('notification.index') }}">Voir toutes les notifications</a>
                                            </li>--}}{{--

                                            @foreach (Auth::user()->unreadNotifications as $notification)
                                                @switch( $notification->type )
                                                    @case('App\Notifications\NewDenonce')
                                                    @php ($type = 'Dénonce')
                                                    @if($notification->data['programme']['name'] === null)
                                                        @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' a dénoncé un client')
                                                    @else
                                                        @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' a dénoncé un client pour le programme ' . addslashes($notification->data['programme']['name']) )
                                                    @endif
                                                    <notifications
                                                            :id="'{{ $notification->id }}'"
                                                            :type="'{{ $type }}'"
                                                            :avatar="'{{ $notification->data['user']['avatar'] }}'"
                                                            :firstname="'{{ $notification->data['user']['firstname'] }}'"
                                                            :lastname="'{{ $notification->data['user']['lastname'] }}'"
                                                            :email="'{{ $notification->data['user']['email'] }}'"
                                                            :phone="'{{ $notification->data['user']['phone'] }}'"
                                                            :zipcode="'{{ $notification->data['user']['zipcode'] }}'"
                                                            :city="'{{ $notification->data['user']['city'] }}'"
                                                            :programme="'{!! addslashes($notification->data['programme']['name']) !!}'"
                                                            :lot="'{{ $notification->data['lot']['numero'] }}'"
                                                            :message="'{{ $msg }}'"
                                                            :inset="'{{ true }}'"
                                                    ></notifications>
                                                    @break
                                                    @case('App\Notifications\ContactNotification')
                                                    @php ($type = 'Contact')
                                                    @if($notification->data['programme']['name'] === null)
                                                        @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' vous a contacté')
                                                    @else
                                                        @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' vous a contacté pour le programme ' . addslashes($notification->data['programme']['name']) )
                                                    @endif
                                                    <notifications
                                                            :id="'{{ $notification->id }}'"
                                                            :type="'{{ $type }}'"
                                                            :avatar="'{{ $notification->data['user']['avatar'] }}'"
                                                            :firstname="'{{ $notification->data['user']['firstname'] }}'"
                                                            :lastname="'{{ $notification->data['user']['lastname'] }}'"
                                                            :email="'{{ $notification->data['user']['email'] }}'"
                                                            :phone="'{{ $notification->data['user']['phone'] }}'"
                                                            :zipcode="'{{ $notification->data['user']['zipcode'] }}'"
                                                            :city="'{{ $notification->data['user']['city'] }}'"
                                                            :programme="'{!! addslashes($notification->data['programme']['name']) !!}'"
                                                            :lot="'{{ $notification->data['lot']['numero'] }}'"
                                                            :message="'{{ $msg }}'"
                                                            :inset="'{{ true }}'"
                                                    ></notifications>
                                                    @break
                                                    @case('App\Notifications\NewCall')
                                                    @php ($type = 'Call')
                                                    @if($notification->data['programme']['name'] === null)
                                                        @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' souhaite être rappelé')
                                                    @else
                                                        @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' souhaite être rappelé pour le programme ' . addslashes($notification->data['programme']['name']) )
                                                    @endif
                                                    <notifications
                                                            :id="'{{ $notification->id }}'"
                                                            :type="'{{ $type }}'"
                                                            :avatar="'{{ $notification->data['user']['avatar'] }}'"
                                                            :firstname="'{{ $notification->data['user']['firstname'] }}'"
                                                            :lastname="'{{ $notification->data['user']['lastname'] }}'"
                                                            :email="'{{ $notification->data['user']['email'] }}'"
                                                            :phone="'{{ $notification->data['user']['phone'] }}'"
                                                            :address="'{{ $notification->data['user']['address'] }}'"
                                                            :zipcode="'{{ $notification->data['user']['zipcode'] }}'"
                                                            :city="'{{ $notification->data['user']['city'] }}'"
                                                            :programme="'{!! addslashes($notification->data['programme']['name']) !!}'"
                                                            :lot="'{{ $notification->data['lot']['numero'] }}'"
                                                            :message="'{{ $msg }}'"
                                                            :inset="'{{ true }}'"
                                                    ></notifications>
                                                    @break
                                                @endswitch

                                            @endforeach
                                        </v-list>
                                    </ul>
                                </li>
                                <v-divider class="mt-2 mb-2" vertical></v-divider>
                                <li class="nav-item dropdown text-center">
                                    <v-icon>perm_identity</v-icon>
                                    <a id="navbarDropdown" class="nav-link grey--text darken-1--text dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->firstname }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item grey--text darken-1--text" href="{{ url('/admin') }}">{{ __('dashboard') }}</a>
                                        <a class="dropdown-item grey--text darken-1--text" href="{{ url('/programmes') }}">{{ __('programmes') }}</a>
                                        <a class="dropdown-item grey--text darken-1--text" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>

                    </div>

                </div>
            </nav>--}}
            <v-content>
                <v-container fluid>
                            @yield('content')
                </v-container>
            </v-content>

            <myfooter app></myfooter>
        </v-app>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.js"></script>

</body>
</html>