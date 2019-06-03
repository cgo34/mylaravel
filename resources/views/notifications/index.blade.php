@extends('layouts.app')
@section('content')
    @php ($countCall = 0)
    @php ($countDenonce = 0)
    @php ($countContact = 0)
    @foreach ($user->unreadNotifications as $notification)
        @switch( $notification->type )
            @case('App\Notifications\NewDenonce')
                @php ($countDenonce++)
                @break
            @case('App\Notifications\ContactNotification')
                @php ($countContact++)
                @break
            @case('App\Notifications\NewCall')
                @php ($countCall++)
                @break
        @endswitch

    @endforeach
    <main class="container-fluid">

            <v-container
                    fluid
                    grid-list-lg
            >
                <v-layout row wrap>

                    <v-flex xs12 sd4 sm4 text-md-center>
                        <v-card color="#71C0FC" class="white--text">
                            <v-card-title primary-title>
                                <div class="full-width">
                                    <div class="headline"><v-icon x-large dark>call</v-icon></div>
                                    <div class="headline">{{ $countCall }} Demande de rappelle</div>
                                </div>
                            </v-card-title>
                        </v-card>
                    </v-flex>
                    <v-flex xs12 sd4 sm4 md4 text-md-center>
                        <v-card class="primary-gradient white--text">
                            <v-card-title primary-title>
                                <div class="full-width">
                                    <div class="headline"><v-icon x-large dark>person</v-icon></div>
                                    <div class="headline">{{ $countContact }} Demande de contact</div>
                                </div>
                            </v-card-title>
                        </v-card>
                    </v-flex>
                    <v-flex xs12 sd4 sm4 md4 text-md-center>
                        <v-card color="#42DCA3" class="white--text">
                            <v-card-title primary-title>
                                <div class="full-width">
                                    <div class="headline"><v-icon x-large dark>location_searching</v-icon></div>
                                    <div class="headline">{{ $countDenonce }} Client dénoncé</div>
                                </div>
                            </v-card-title>
                        </v-card>
                    </v-flex>

                </v-layout>
            </v-container>
            <v-container
                    fluid
                    grid-list-lg
            >
                <v-flex xs12 sd12 sm12>
                    <h1>@lang('Notifications')</h1>
                </v-flex>
            @foreach ($user->unreadNotifications as $notification)
                @switch( $notification->type )
                        @case('App\Notifications\LotBooked')
                        @php ($type = 'Lot réservé')
                        @if($notification->data['lot']['id'] === null)
                            @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' a dénoncé un client')
                        @else
                            @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' a réservé le lot ' . $notification->data['lot']['numero'] )
                        @endif
                        <v-list two-line class="pt-0 pb-0  mt-0 mt-0">
                            <v-list-tile
                                avatar
                                @click=""

                            >
                                <v-list-tile-avatar>
                                    <img src="/storage/{{ $notification->data['user']['avatar'] }}">
                                </v-list-tile-avatar>
                                <v-list-tile-content>

                                    <v-list-tile-title :v-html="type">{{ $type }}</v-list-tile-title>
                                    <v-list-tile-sub-title :v-html="message">{{ $msg }}</v-list-tile-sub-title>
                                </v-list-tile-content>
                                <v-list-tile-action>
                                    <form action="{{ route('notifications.update',  [$notification->id] ) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <input type="submit" class="btn-box-shadow-primary primary-plain white--text pl-2 pr-2 v-btn v-btn--depressed v-btn--round" value="@lang('Marqué comme lu')">
                                    </form>
                                </v-list-tile-action>
                            </v-list-tile>
                            <v-divider
                                class="mt-0 mb-0"
                            ></v-divider>
                        </v-list>
                        @break
                    @case('App\Notifications\NewDenonce')
                    @php ($type = 'Dénonce')
                    @if($notification->data['programme']['name'] === null)
                        @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' a dénoncé un client')
                    @else
                        @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' a dénoncé un client pour le programme ' . $notification->data['programme']['name'] )
                    @endif
                        <v-list two-line class="pt-0 pb-0  mt-0 mt-0">
                            <v-list-tile
                                avatar
                                @click=""

                            >
                                <v-list-tile-avatar>
                                    <img src="/storage/{{ $notification->data['user']['avatar'] }}">
                                </v-list-tile-avatar>
                                <v-list-tile-content>

                                    <v-list-tile-title :v-html="type">{{ $type }}</v-list-tile-title>
                                    <v-list-tile-sub-title :v-html="message">{{ $msg }}</v-list-tile-sub-title>
                                </v-list-tile-content>
                                <v-list-tile-action>
                                    <form action="{{ route('notifications.update',  [$notification->id] ) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <input type="submit" class="btn-box-shadow-primary primary-plain white--text pl-2 pr-2 v-btn v-btn--depressed v-btn--round" value="@lang('Marqué comme lu')">
                                    </form>
                                </v-list-tile-action>
                            </v-list-tile>
                            <v-divider
                                class="mt-0 mb-0"
                            ></v-divider>
                        </v-list>
                    @break
                    @case('App\Notifications\ContactNotification')
                    @php ($type = 'Contact')
                    @if($notification->data['programme']['name'] === null)
                        @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' vous a contacté')
                    @else
                        @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' vous a contacté pour le programme ' . $notification->data['programme']['name'] )
                    @endif
                        <v-list two-line class="pt-0 pb-0 mt-0 mt-0">
                            <v-list-tile
                                avatar
                                @click=""
                            >
                                <v-list-tile-avatar>
                                    <img src="/storage/{{ $notification->data['user']['avatar'] }}">
                                </v-list-tile-avatar>
                                <v-list-tile-content>

                                    <v-list-tile-title :v-html="type">{{ $type }}</v-list-tile-title>
                                    <v-list-tile-sub-title :v-html="message">{{ $msg }}</v-list-tile-sub-title>
                                </v-list-tile-content>
                                <v-list-tile-action>
                                    <form action="{{ route('notifications.update',  [$notification->id] ) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <input type="submit" class="btn-box-shadow-primary primary-plain white--text pl-2 pr-2 v-btn v-btn--depressed v-btn--round" value="@lang('Marqué comme lu')">
                                    </form>
                                </v-list-tile-action>
                            </v-list-tile>
                            <v-divider
                                class="mt-0 mb-0"
                            ></v-divider>
                        </v-list>
                    @break
                    @case('App\Notifications\NewCall')
                    @php ($type = 'Call')
                    @if($notification->data['programme']['name'] === null)
                        @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' souhaite être rappelé')
                    @else
                        @php ($msg = $notification->data['user']['firstname'] . '.' . substr($notification->data['user']['lastname'], 0, 1) . ' souhaite être rappelé pour le programme ' . $notification->data['programme']['name'] )
                    @endif
                        <v-list two-line class="pt-0 pb-0 mt-0 mt-0">
                            <v-list-tile
                                avatar
                                @click=""
                            >
                                <v-list-tile-avatar>
                                    <img src="/storage/{{ $notification->data['user']['avatar'] }}">
                                </v-list-tile-avatar>
                                <v-list-tile-content>

                                    <v-list-tile-title :v-html="type">{{ $type }}</v-list-tile-title>
                                    <v-list-tile-sub-title :v-html="message">{{ $msg }}</v-list-tile-sub-title>
                                </v-list-tile-content>
                                <v-list-tile-action>
                                    <form action="{{ route('notifications.update',  [$notification->id] ) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <input type="submit" class="btn-box-shadow-primary primary-plain white--text pl-2 pr-2 v-btn v-btn--depressed v-btn--round" value="@lang('Marqué comme lu')">
                                    </form>
                                </v-list-tile-action>
                            </v-list-tile>
                            <v-divider
                                class="mt-0 mb-0"
                            ></v-divider>
                        </v-list>
                    {{--<notifications
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
                            :name="'{!! addslashes($notification->data['programme']['name']) !!}'"
                            :lot="'{{ $notification->data['lot']['numero'] }}'"
                            :message="'{!! addslashes($msg) !!}'"
                            :inset="'{{ true }}'"
                    ></notifications>--}}
                    @break
                @endswitch

            @endforeach
            </v-container>
    </main>
@endsection
