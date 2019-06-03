@extends('layouts.app')

@section('content')
    <v-container fill-height>
        <v-layout
            align-center
            justify-center
        >
            <v-flex md8>
                <forgot-password-form></forgot-password-form>
                {{--<v-card card>


                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="form-group row">

                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <v-btn type="submit" round slot="activator" color="#65D6B5" depressed dark>
                                                {{ __('Send Password Reset Link') }}
                                            </v-btn>
                                        </div>
                                    </div>
                                </form>
                </v-card-text>
            </v-card>--}}
        </v-flex>
    </v-layout>
</v-container>
@endsection
<script>
import ForgotPasswordForm from '../../../js/components/form/ForgotPasswordForm';
export default {
    components: { ForgotPasswordForm },
};
</script>
