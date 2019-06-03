<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="token" id="token" content="{{ auth()->check() ? auth()->user()->api_token : null }}">

    <title>{{ config('app.name', 'Galileo') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Muli:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/typeit@6.0.3/dist/typeit.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
    </script>

    <!-- This makes the current user's id available in javascript -->
    @if(!auth()->guest())
        <script>
        window.Laravel.userId = <?php echo auth()->user()->id; ?>
        </script>
    @endif
</head>
<body>
<div id="app">
    <v-app id="app">
        @php( $urlPage = url()->current())
        @if($urlPage === 'http://127.0.0.1:8000' || $urlPage === 'http://localhost:8000' || $urlPage === 'http://563af608.ngrok.io')
            <v-toolbar id="main-nav" light fixed flat color="transparent" class="pt-1 pb-1">
                <v-toolbar-title>
                    <a class="navbar-brand light-blue--text text-uppercase font-weight-black" href="{{ url('/') }}">
                        <img class="logo" src="{{ asset('/img/logo/logo-galileo-color-light.png') }}" width="100">
                    </a>
                </v-toolbar-title>
                <!-- Left Side Of Navbar -->

                {{--{{ menu('PrimaryMenu') }}--}}
                <a class="nav-link white--text  font-weight-bold" href="{{ url('/programmes') }}">{{ __('Trouver un bien') }}</a>

                <a class="nav-link white--text  font-weight-bold" href="{{ url('/notre-concept') }}">{{ __('Notre concept') }}</a>

                <a class="nav-link white--text  font-weight-bold" href="{{ url('/programmes') }}">{{ __('Dispositifs fiscaux') }}</a>

                <a class="nav-link white--text  font-weight-bold" href="{{ url('/programmes') }}">{{ __('Contact') }}</a>


                <v-spacer></v-spacer>
                <!-- Authentication Links -->
                @guest
                    <login></login>
                @else
                    <v-toolbar-items style="height: auto;">
                        <li class="nav-item text-center pt-2 pb-2">

                            @if(count(Auth::user()->booksLots) > 0)
                                <v-badge color="#00e094" >
                                    <template v-slot:badge>
                                        <span>{{count(Auth::user()->booksLots)}}</span>
                                    </template>
                                    <v-icon color="#fff" flat>add_shopping_cart</v-icon>
                                </v-badge>
                            @else
                                <v-badge color="#00e094" >
                                    <template v-slot:badge>
                                        <span>{{count(Auth::user()->booksLots)}}</span>
                                    </template>
                                    <v-icon color="#fff">add_shopping_cart</v-icon>
                                </v-badge>
                            @endif

                            <a class="nav-link white--text text--darken-2 font-weight-medium pt-0 pb-0" href="{{ url('books') }}"><span>Réservations</span></a>

                        </li>
                        <v-divider class="mt-2 mb-2" vertical></v-divider>
                        <li class="nav-item text-center pt-2 pb-2">

                            @if(count(Auth::user()->favoritesLots) > 0)
                                <v-badge color="#00e094" >
                                    <template v-slot:badge>
                                        <span>{{count(Auth::user()->favoritesLots)}}</span>
                                    </template>
                                    <v-icon color="#fff" flat>far fa-heart</v-icon>
                                </v-badge>
                            @else
                                <v-badge color="#00e094" >
                                    <template v-slot:badge>
                                        <span>{{count(Auth::user()->favoritesLots)}}</span>
                                    </template>
                                    <v-icon color="#fff" flat>far fa-heart</v-icon>
                                </v-badge>
                            @endif

                            <a class="nav-link white--text text--darken-2 pt-0 pb-0" href="{{ url('favorites') }}"><span>Favoris</span></a>

                        </li>
                        <v-divider class="mt-2 mb-2" vertical></v-divider>
                        @if(Auth::user()->id === 1)
                            <li class="nav-item dropdown text-center pt-2 pb-2">

                                @if(count(Auth::user()->unreadNotifications) > 0)
                                    <v-badge color="#00e094" >
                                        <template v-slot:badge>
                                            <span>{{count(Auth::user()->unreadNotifications)}}</span>
                                        </template>
                                        <v-icon  color="#fff" flat>far fa-bell fa-2x</v-icon>
                                    </v-badge>
                                @else
                                    <v-badge color="#00e094" >
                                        <template v-slot:badge>
                                            <span>{{count(Auth::user()->unreadNotifications)}}</span>
                                        </template>
                                        <v-icon color="#fff">far fa-bell fa-2x</v-icon>
                                    </v-badge>
                                    @endif
                                    </v-badge>
                                    <!--<a class="nav-link grey--text darken-1--text" @click.stop="drawer = !drawer" href="#"><span>Notifications</span></a>-->
                                    <a id="notifDropdown" class="nav-link white--text text--darken-2 dropdown-toggle pt-0 pb-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Notifications <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notifDropdown">
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
                                                    @case('App\Notifications\OptionRequests')
                                                    @php ($type = 'Demande doption')
                                                    @if($notification->data['lot']['id'] === null)
                                                        @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' a fait une demande doption')
                                                    @else
                                                        @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' a fait une demande doption pour le lot ' . addslashes($notification->data['lot']['id']) )
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
                                                        :programme="''"
                                                        :lot="'{{ $notification->data['lot']['numero'] }}'"
                                                        :message="'{{ $msg }}'"
                                                        :inset="'{{ true }}'"
                                                    ></notifications>
                                                    @break
                                                    @case('App\Notifications\LotBooked')
                                                    @php ($type = 'Lot réservé')
                                                    @if($notification->data['lot']['id'] === null)
                                                        @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' a dénoncé un client')
                                                    @else
                                                        @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' a réservé le lot ' . addslashes($notification->data['lot']['id']) )
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
                                                        :programme="''"
                                                        :lot="'{{ $notification->data['lot']['numero'] }}'"
                                                        :message="'{{ $msg }}'"
                                                        :inset="'{{ true }}'"
                                                    ></notifications>
                                                    @break
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
                        @else
                            <li class="nav-item dropdown text-center pt-2 pb-2">

                                @if(count(Auth::user()->unreadNotifications) > 0)
                                    <v-badge color="#00e094" >
                                        <template v-slot:badge>
                                            <span>{{count(Auth::user()->unreadNotifications)}}</span>
                                        </template>
                                        <v-icon  color="#fff" flat>far fa-bell fa-2x</v-icon>
                                    </v-badge>
                                @else
                                    <v-badge color="#00e094" >
                                        <template v-slot:badge>
                                            <span>{{count(Auth::user()->unreadNotifications)}}</span>
                                        </template>
                                        <v-icon color="#fff">far fa-bell fa-2x</v-icon>
                                    </v-badge>
                                @endif
                                    <!--<a class="nav-link grey--text darken-1--text" @click.stop="drawer = !drawer" href="#"><span>Notifications</span></a>-->
                                    <a id="notifDropdown" class="nav-link white--text text--darken-2 dropdown-toggle pt-0 pb-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Notifications <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notifDropdown">
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
                                                    @case('App\Notifications\OptionRequests')
                                                    @php ($type = 'Demande doption')
                                                    @if($notification->data['lot']['id'] === null)
                                                        @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' a fait une demande doption')
                                                    @else
                                                        @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' a fait une demande doption pour le lot ' . addslashes($notification->data['lot']['id']) )
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
                                                        :programme="''"
                                                        :lot="'{{ $notification->data['lot']['numero'] }}'"
                                                        :message="'{{ $msg }}'"
                                                        :inset="'{{ true }}'"
                                                    ></notifications>
                                                    @break
                                                    @case('App\Notifications\OptionRequestsValidated')
                                                    @php ($type = 'Demande doption validée')
                                                    @if($notification->data['lot']['id'] === null)
                                                        @php ($msg = 'Votre demande doption a été validé')
                                                    @else
                                                        @php ($msg = 'Votre demande doption pour le lot ' . addslashes($notification->data['lot']['id'] . ' a été validée') )
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
                                                        :programme="''"
                                                        :lot="'{{ $notification->data['lot']['numero'] }}'"
                                                        :message="'{{ $msg }}'"
                                                        :inset="'{{ true }}'"
                                                    ></notifications>
                                                    @break
                                                    @case('App\Notifications\OptionRequestsRefused')
                                                    @php ($type = 'Demande doption refusée')
                                                    @if($notification->data['lot']['id'] === null)
                                                        @php ($msg = 'Votre demande doption a été refusée')
                                                    @else
                                                        @php ($msg = 'Votre demande doption pour le lot ' . addslashes($notification->data['lot']['id'] . ' a été refusée') )
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
                                                        :programme="''"
                                                        :lot="'{{ $notification->data['lot']['numero'] }}'"
                                                        :message="'{{ $msg }}'"
                                                        :inset="'{{ true }}'"
                                                    ></notifications>
                                                    @break
                                                    @case('App\Notifications\LotBooked')
                                                    @php ($type = 'Lot réservé')
                                                    @if($notification->data['lot']['id'] === null)
                                                        @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' a dénoncé un client')
                                                    @else
                                                        @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' a réservé le lot ' . addslashes($notification->data['lot']['id']) )
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
                                                        :programme="''"
                                                        :lot="'{{ $notification->data['lot']['numero'] }}'"
                                                        :message="'{{ $msg }}'"
                                                        :inset="'{{ true }}'"
                                                    ></notifications>
                                                    @break
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
                        @endif
                        <v-divider class="mt-2 mb-2" vertical></v-divider>
                        <li class="nav-item dropdown text-center pt-2 pb-2">
                            <v-icon  color="#fff" flat>far fa-user</i></v-icon>
                            <a id="navbarDropdown" class="nav-link white--text text--darken-2 dropdown-toggle pt-0 pb-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                {{--<a class="dropdown-item grey--text darken-1--text" href="{{ url('/admin') }}">{{ __('dashboard') }}</a>--}}
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
        @else
            <v-toolbar id="main-nav" fixed color="white" class="pt-1 pb-1" app>
                <v-toolbar-title>
                    <a class="navbar-brand light-blue--text text-uppercase font-weight-black" href="{{ url('/') }}">
                        <img src="{{ asset('/img/logo/logo-galileo-color-dark.png') }}" width="100">
                    </a>
                </v-toolbar-title>
                <!-- Left Side Of Navbar -->
                {{--{{ menu('PrimaryMenu') }}--}}

                <a class="nav-link grey--text font-weight-bold" href="{{ url('/programmes') }}">{{ __('Trouver un bien') }}</a>

                <a class="nav-link grey--text font-weight-bold" href="{{ url('/notre-concept') }}">{{ __('Notre concept') }}</a>

                <a class="nav-link grey--text font-weight-bold" href="{{ url('/programmes') }}">{{ __('Dispositifs fiscaux') }}</a>

                <a class="nav-link grey--text font-weight-bold" href="{{ url('/programmes') }}">{{ __('Contact') }}</a>
                <v-spacer></v-spacer>
                <!-- Authentication Links -->
                @guest
                    <login></login>
                @else
                    <v-toolbar-items style="height: auto;">
                        <li class="nav-item text-center pt-2 pb-2">

                            @if(count(Auth::user()->booksLots) > 0)
                                <v-badge color="#00e094" >
                                    <template v-slot:badge>
                                        <span>{{count(Auth::user()->booksLots)}}</span>
                                    </template>
                                    <v-icon flat>add_shopping_cart</v-icon>
                                </v-badge>
                            @else
                                <v-badge color="#00e094" >
                                    <template v-slot:badge>
                                        <span>{{count(Auth::user()->booksLots)}}</span>
                                    </template>
                                    <v-icon>add_shopping_cart</v-icon>
                                </v-badge>
                            @endif

                            <a class="nav-link grey--text text--darken-2 font-weight-medium pt-0 pb-0" href="{{ url('books') }}"><span>Réservations</span></a>

                        </li>
                        <v-divider class="mt-2 mb-2" vertical></v-divider>
                        <li class="nav-item text-center pt-2 pb-2">

                            @if(count(Auth::user()->favoritesLots) > 0)
                                <v-badge color="#00e094" >
                                    <template v-slot:badge>
                                        <span>{{count(Auth::user()->favoritesLots)}}</span>
                                    </template>
                                    <v-icon flat>far fa-heart</v-icon>
                                </v-badge>
                            @else
                                <v-badge color="#00e094" >
                                    <template v-slot:badge>
                                        <span>{{count(Auth::user()->favoritesLots)}}</span>
                                    </template>
                                    <v-icon>far fa-heart</v-icon>
                                </v-badge>
                            @endif

                            <a class="nav-link grey--text text--darken-2 font-weight-medium pt-0 pb-0" href="{{ url('favorites') }}"><span>Favoris</span></a>

                        </li>
                        <v-divider class="mt-2 mb-2" vertical></v-divider>
                        @if(Auth::user()->id === 1)
                            <li class="nav-item dropdown text-center pt-2 pb-2">
                                @if(count(Auth::user()->unreadNotifications) > 0)
                                    <v-badge color="#00e094" >
                                        <template v-slot:badge>
                                            <span>{{count(Auth::user()->unreadNotifications)}}</span>
                                        </template>
                                        <v-icon  flat>far fa-bell fa-2x</v-icon>
                                    </v-badge>
                                @else
                                    <v-badge color="#00e094" >
                                        <template v-slot:badge>
                                            <span>{{count(Auth::user()->unreadNotifications)}}</span>
                                        </template>
                                        <v-icon >far fa-bell fa-2x</v-icon>
                                    </v-badge>
                                @endif
                            <!--<a class="nav-link grey--text darken-1--text" @click.stop="drawer = !drawer" href="#"><span>Notifications</span></a>-->
                                <a id="notifDropdown" class="nav-link grey--text text--darken-2 dropdown-toggle pt-0 pb-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Notifications <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right"  aria-labelledby="navbarDropdown">
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
                                                @case('App\Notifications\OptionRequests')
                                                @php ($type = 'Demande doption')
                                                @if($notification->data['lot']['id'] === null)
                                                    @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' a fait une demande doption')
                                                @else
                                                    @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' a fait une demande doption pour le lot ' . addslashes($notification->data['lot']['id']) )
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
                                                    :programme="''"
                                                    :lot="'{{ $notification->data['lot']['numero'] }}'"
                                                    :message="'{{ $msg }}'"
                                                    :inset="'{{ true }}'"
                                                ></notifications>
                                                @break
                                                @case('App\Notifications\OptionRequestsPending')
                                                @php ($type = 'Demande doption en attente')
                                                @if($notification->data['lot']['id'] === null)
                                                    @php ($msg = 'Votre demande doption est en attente')
                                                @else
                                                    @php ($msg = 'Votre demande doption pour le lot ' . addslashes($notification->data['lot']['id'] . ' est en attente') )
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
                                                    :programme="''"
                                                    :lot="'{{ $notification->data['lot']['numero'] }}'"
                                                    :message="'{{ $msg }}'"
                                                    :inset="'{{ true }}'"
                                                ></notifications>
                                                @break
                                                @case('App\Notifications\LotBooked')
                                                @php ($type = 'Lot réservé')
                                                @if($notification->data['lot']['id'] === null)
                                                    @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' a dénoncé un client')
                                                @else
                                                    @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' a réservé le lot ' . addslashes($notification->data['lot']['id']) )
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
                                                    :programme="''"
                                                    :lot="'{{ $notification->data['lot']['numero'] }}'"
                                                    :message="'{{ $msg }}'"
                                                    :inset="'{{ true }}'"
                                                ></notifications>
                                                @break
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
                        @else
                            <li class="nav-item dropdown text-center pt-2 pb-2">

                                @if(count(Auth::user()->unreadNotifications) > 0)
                                    <v-badge color="#00e094" >
                                        <template v-slot:badge>
                                            <span>{{count(Auth::user()->unreadNotifications)}}</span>
                                        </template>
                                        <v-icon flat>far fa-bell fa-2x</v-icon>
                                    </v-badge>
                                @else
                                    <v-badge color="#00e094" >
                                        <template v-slot:badge>
                                            <span>{{count(Auth::user()->unreadNotifications)}}</span>
                                        </template>
                                        <v-icon>far fa-bell fa-2x</v-icon>
                                    </v-badge>
                                @endif
                            <!--<a class="nav-link grey--text darken-1--text" @click.stop="drawer = !drawer" href="#"><span>Notifications</span></a>-->
                                <a id="notifDropdown" class="nav-link grey--text text--darken-2 dropdown-toggle pt-0 pb-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Notifications <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notifDropdown">
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
                                                @case('App\Notifications\OptionRequests')
                                                @php ($type = 'Demande doption')
                                                @if($notification->data['lot']['id'] === null)
                                                    @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' a fait une demande doption')
                                                @else
                                                    @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' a fait une demande doption pour le lot ' . addslashes($notification->data['lot']['id']) )
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
                                                    :programme="''"
                                                    :lot="'{{ $notification->data['lot']['numero'] }}'"
                                                    :message="'{{ $msg }}'"
                                                    :inset="'{{ true }}'"
                                                ></notifications>
                                                @break
                                                @case('App\Notifications\OptionRequestsPending')
                                                @php ($type = 'Demande doption en attente')
                                                @if($notification->data['lot']['id'] === null)
                                                    @php ($msg = 'Votre demande doption est en attente')
                                                @else
                                                    @php ($msg = 'Votre demande doption pour le lot ' . addslashes($notification->data['lot']['id'] . ' est en attente') )
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
                                                    :programme="''"
                                                    :lot="'{{ $notification->data['lot']['numero'] }}'"
                                                    :message="'{{ $msg }}'"
                                                    :inset="'{{ true }}'"
                                                ></notifications>
                                                @break
                                                @case('App\Notifications\OptionRequestsValidated')
                                                @php ($type = 'Demande doption validée')
                                                @if($notification->data['lot']['id'] === null)
                                                    @php ($msg = 'Votre demande doption a été validé')
                                                @else
                                                    @php ($msg = 'Votre demande doption pour le lot ' . addslashes($notification->data['lot']['id'] . ' a été validée') )
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
                                                    :programme="''"
                                                    :lot="'{{ $notification->data['lot']['numero'] }}'"
                                                    :message="'{{ $msg }}'"
                                                    :inset="'{{ true }}'"
                                                ></notifications>
                                                @break
                                                @case('App\Notifications\OptionRequestsRefused')
                                                @php ($type = 'Demande doption refusée')
                                                @if($notification->data['lot']['id'] === null)
                                                    @php ($msg = 'Votre demande doption a été refusée')
                                                @else
                                                    @php ($msg = 'Votre demande doption pour le lot ' . addslashes($notification->data['lot']['id'] . ' a été refusée') )
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
                                                    :programme="''"
                                                    :lot="'{{ $notification->data['lot']['numero'] }}'"
                                                    :message="'{{ $msg }}'"
                                                    :inset="'{{ true }}'"
                                                ></notifications>
                                                @break
                                                @case('App\Notifications\LotBooked')
                                                @php ($type = 'Lot réservé')
                                                @if($notification->data['lot']['id'] === null)
                                                    @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' a dénoncé un client')
                                                @else
                                                    @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' a réservé le lot ' . addslashes($notification->data['lot']['id']) )
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
                                                    :programme="''"
                                                    :lot="'{{ $notification->data['lot']['numero'] }}'"
                                                    :message="'{{ $msg }}'"
                                                    :inset="'{{ true }}'"
                                                ></notifications>
                                                @break
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
                        @endif
                        <v-divider class="mt-2 mb-2" vertical></v-divider>
                        <li class="nav-item dropdown text-center pt-2 pb-2">
                            <v-icon  flat>far fa-user</i></v-icon>
                            <a id="navbarDropdown" class="nav-link grey--text text--darken-2 dropdown-toggle pt-0 pb-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                {{--<a class="dropdown-item grey--text darken-1--text" href="{{ url('/admin') }}">{{ __('dashboard') }}</a>--}}
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
        @endif
        <flash message=""></flash>
        <v-content fill-height>
            @yield('content')
        </v-content>
        <footer-white></footer-white>

    </v-app>
</div>
<script type="text/javascript">

$(document).ready(function(){

    new TypeIt('#simpleUsage', {
        strings: ["AGENT IMMOBILIER", "EXPERT COMPTABLE", "NOTAIRE", "COURTIER EN PRÊT"],
        speed: 150,
        html: true,
        cursorSpeed: 1000,
        cursor: true,
        nextStringDelay: 750,
        breakLines: false,
        lifeLike: false,
        startDelay: 100,
        loopDelay: 750,
        waitUntilVisible: true,
        loop: true,
    }).go();

    $(window).scroll(function(){
        var pageURL = window.location.pathname;
        var scroll = $(window).scrollTop();
        if (scroll > 120 && pageURL === '/') {
            $("#transparent-footer .v-card__text").hide();
        }else if (scroll < 120 && pageURL === '/'){
            $("#transparent-footer .v-card__text").show();
        }
        if (scroll > 150 && pageURL === '/') {
            $("#transparent-footer .group").hide();
        }else if (scroll < 150 && pageURL === '/'){
            $("#transparent-footer .group").show();
        }
        if (scroll > 680 && pageURL === '/') {
            $("#main-nav").removeClass('transparent');
            $(".logo").attr('src', "{{ asset('/img/logo/logo-galileo-color-dark.png') }}");
            //$("#main-nav").css('background', 'white');
            $(".nav-item .v-icon").css('color', '#424242');
            $("#main-nav").css('background', 'white');
            $("#main-nav").addClass('toolbar-shadow');
            $(".nav-link").removeClass('white--text').addClass('grey--text text--darken-3');
        }else if (scroll < 680 && pageURL === '/'){
            $("#main-nav").addClass('transparent');
            $(".logo").attr('src', "{{ asset('/img/logo/logo-galileo-color-light.png') }}");
            $("#main-nav").removeClass('toolbar-shadow');
            //$("#main-nav").css('background', 'transparent');
            $(".nav-item .v-icon").css('color', '#fff');
            $(".nav-link").removeClass('grey--text text--darken-3').addClass('white--text');
        }
    });

});
</script>
</body>
</html>
