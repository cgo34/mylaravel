@extends('layouts.app')

@section('content')
<v-container fill-height>
    <v-layout
        align-center
        justify-center
    >
        <v-flex md6>
            <login-form></login-form>
            {{--<v-card card>
                <v-card-title class="pt-4" style="display:block; text-align: center;">
                    <h2 class="primary-color text-uppercase font-weight-bold">Connexion</h2>
                </v-card-title>
                <v-card-text class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <v-btn type="submit" round slot="activator" color="#42DCA3" depressed dark>{{ __('Login') }}</v-btn>
                                <v-btn href="{{ route('password.request') }}" round color="#42DCA3" slot="activator" dark outline>{{ __('Forgot Your Password?') }}</v-btn>
                                <a class="btn btn-link round dark outline" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </v-card-text>
            </v-card>--}}
        </v-flex>
    </v-layout>
</v-container>
@endsection
