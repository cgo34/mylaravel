@extends('layouts.app')
@section('content')
    <main class="container-fluid">

        <v-container
            fluid
            grid-list-lg
        >
            <v-layout row wrap>
                <v-flex xs12 sd12 sm12>
        <h1>@lang('Notification') - #{{ $notif['id'] }}</h1>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        @switch($notif['type'])
                            @case('App\Notifications\NewDenonce')
                            @php ($type = 'Dénonce')
                            @if($notif['data']['programme']['name'] === null)
                                @php ($msg = $notif['data']['user']['firstname'] . '.' . substr($notif['data']['user']['lastname'], 0, 1) . ' a dénoncé un client')
                            @else
                                @php ($msg = $notif['data']['user']['firstname'] . '.' . substr($notif['data']['user']['lastname'], 0, 1) . ' a dénoncé un client pour le programme ' . $notif['data']['programme']['name'] )
                            @endif
                            <v-list three-line>
                                <v-list-tile
                                    avatar

                                >
                                    <v-list-tile-avatar>
                                        <img src="/storage/{{ $notif['data']['user']['avatar'] }}">
                                    </v-list-tile-avatar>
                                    <v-list-tile-content>

                                        <v-list-tile-title>{{ $type }}</v-list-tile-title>
                                        <v-list-tile-sub-title>{{ $msg }}</v-list-tile-sub-title>
                                        <v-list-tile-sub-title>[
                                            {{ $notif['data']['denonce']['genre'] }}
                                            {{ $notif['data']['denonce']['firstname'] }}
                                            {{ $notif['data']['denonce']['lastname'] }} -
                                            {{ $notif['data']['denonce']['email'] }} -
                                            {{ $notif['data']['denonce']['phone'] }} -
                                            {{ $notif['data']['denonce']['address'] }},
                                            {{ $notif['data']['denonce']['zipcode'] }}
                                            {{ $notif['data']['denonce']['city'] }}
                                            ]
                                        </v-list-tile-sub-title>
                                    </v-list-tile-content>
                                    <v-list-tile-action>
                                        <form action="{{ route('notifications.update', [$notif['id']]) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <input type="submit" class="btn-box-shadow-primary primary-plain white--text pl-2 pr-2 v-btn v-btn--depressed v-btn--round" value="@lang('Marqué comme lu')">
                                        </form>
                                    </v-list-tile-action>
                                </v-list-tile>
                            </v-list>
                            @break
                            @case('App\Notifications\LotBooked')
                            @php ($type = 'Lot réservé')
                            @if($notif['data']['lot']['id'] === null)
                                @php ($msg = $notif['data']['user']['firstname'] . '.' . substr($notif['data']['user']['lastname'], 0, 1) . ' a dénoncé un client')
                            @else
                                @php ($msg = $notif['data']['user']['firstname'] . '.' . substr($notif['data']['user']['lastname'], 0, 1) . ' a réservé le lot ' . $notif['data']['lot']['numero'] )
                            @endif
                            <v-list three-line>
                                <v-list-tile
                                    avatar

                                >
                                    <v-list-tile-avatar>
                                        <img src="/storage/{{ $notif['data']['user']['avatar'] }}">
                                    </v-list-tile-avatar>
                                    <v-list-tile-content>

                                        <v-list-tile-title >{{ $type }}</v-list-tile-title>
                                        <v-list-tile-sub-title >{{ $msg }}</v-list-tile-sub-title>
                                    </v-list-tile-content>
                                    <v-list-tile-action>
                                        <form action="{{ route('notifications.update', [$notif['id']]) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <input type="submit" class="btn-box-shadow-primary primary-plain white--text pl-2 pr-2 v-btn v-btn--depressed v-btn--round" value="@lang('Marqué comme lu')">
                                        </form>
                                    </v-list-tile-action>
                                </v-list-tile>
                            </v-list>
                                @break
                            @case('App\Notifications\ContactNotification')
                                @php ($type = 'Contact')
                                @if($notif['data']['programme']['name'] === null)
                                    @php ($msg = $notif['data']['user']['firstname'] . '.' . substr($notif['data']['user']['lastname'], 0, 1) . ' vous a contacté')
                                @else
                                    @php ($msg = $notif['data']['user']['firstname'] . '.' . substr($notif['data']['user']['lastname'], 0, 1) . ' vous a contacté pour le programme ' . $notif['data']['programme']['name'] )
                                @endif
                                <v-list two-line>
                                    <v-list-tile
                                        avatar

                                    >
                                        <v-list-tile-avatar>
                                            <img src="/storage/{{ $notif['data']['user']['avatar'] }}">
                                        </v-list-tile-avatar>
                                        <v-list-tile-content>

                                            <v-list-tile-title >{{ $type }}</v-list-tile-title>
                                            <v-list-tile-sub-title >{{ $msg }}</v-list-tile-sub-title>
                                        </v-list-tile-content>
                                        <v-list-tile-action>
                                            <form action="{{ route('notifications.update', [$notif['id']]) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('PUT') }}
                                                <input type="submit" class="btn-box-shadow-primary primary-plain white--text pl-2 pr-2 v-btn v-btn--depressed v-btn--round" value="@lang('Marqué comme lu')">
                                            </form>
                                        </v-list-tile-action>
                                    </v-list-tile>
                                </v-list>
                                {{--<notification
                                        id="'{{ $notif['id'] }}'"
                                        :type="'{{ $type }}'"
                                        :avatar="'{{ $notif['data']['user']['avatar'] }}'"
                                        :genre="'{{ $notif['data']['user']['genre'] }}'"
                                        :firstname="'{{ $notif['data']['user']['firstname'] }}'"
                                        :lastname="'{{ $notif['data']['user']['lastname'] }}'"
                                        :email="'{{ $notif['data']['user']['email'] }}'"
                                        :phone="'{{ $notif['data']['user']['phone'] }}'"
                                        :address="'{{ $notif['data']['user']['address'] }}'"
                                        :zipcode="'{{ $notif['data']['user']['zipcode'] }}'"
                                        :city="'{{ $notif['data']['user']['city'] }}'"
                                        :programme="'{{ $notif['data']['programme']['name'] }}'"
                                        :lot="'{{ $notif['data']['lot']['numero'] }}'"
                                        :message="'{{ $msg }}'"
                                ></notification>--}}
                                @break
                        @case('App\Notifications\NewCall')
                            @php ($type = 'call')
                            @if($notif['data']['programme']['name'] === null)
                                @php ($msg = $notif['data']['user']['firstname'] . '.' . substr($notif['data']['user']['lastname'], 0, 1) . ' souhaite être rappelé')
                            @else
                                @php ($msg = $notif['data']['user']['firstname'] . '.' . substr($notif['data']['user']['lastname'], 0, 1) . ' souhaite être rappelé pour le programme ' . $notif['data']['programme']['name'] )
                            @endif
                            <v-list two-line>
                                <v-list-tile
                                    avatar

                                >
                                    <v-list-tile-avatar>
                                        <img src="/storage/{{ $notif['data']['user']['avatar'] }}">
                                    </v-list-tile-avatar>
                                    <v-list-tile-content>

                                        <v-list-tile-title >{{ $type }}</v-list-tile-title>
                                        <v-list-tile-sub-title >{{ $msg }}</v-list-tile-sub-title>
                                    </v-list-tile-content>
                                    <v-list-tile-action>
                                        <form action="{{ route('notifications.update',  $notif['id'] ) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <input type="submit" class="btn-box-shadow-primary primary-plain white--text pl-2 pr-2 v-btn v-btn--depressed v-btn--round" value="@lang('Marqué comme lu')">
                                        </form>
                                    </v-list-tile-action>
                                </v-list-tile>
                            </v-list>
                            @break
                        @endswitch
                    </table>
                </div>
            </div>
        </div>
                </v-flex>
            </v-layout>
        </v-container>
    </main>
@endsection
