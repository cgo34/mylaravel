@extends('layouts.app')
@section('content')
    <main class="container-fluid">
        <h1>@lang('Notifications')</h1>
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
                            <notification
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
                            ></notification>
                                @break
                            @case('App\Notifications\ContactNotification')
                                @php ($type = 'Contact')
                                @if($notif['data']['programme']['name'] === null)
                                    @php ($msg = $notif['data']['user']['firstname'] . '.' . substr($notif['data']['user']['lastname'], 0, 1) . ' vous a contacté')
                                @else
                                    @php ($msg = $notif['data']['user']['firstname'] . '.' . substr($notif['data']['user']['lastname'], 0, 1) . ' vous a contacté pour le programme ' . $notif['data']['programme']['name'] )
                                @endif
                                <notification
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
                                ></notification>
                                @break
                        @case('App\Notifications\NewCall')
                            @php ($type = 'call')
                            @if($notif['data']['programme']['name'] === null)
                                @php ($msg = $notif['data']['user']['firstname'] . '.' . substr($notif['data']['user']['lastname'], 0, 1) . ' souhaite être rappelé')
                            @else
                                @php ($msg = $notif['data']['user']['firstname'] . '.' . substr($notif['data']['user']['lastname'], 0, 1) . ' souhaite être rappelé pour le programme ' . $notif['data']['programme']['name'] )
                            @endif
                            <notification
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
                            ></notification>
                            @break
                        @endswitch
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection