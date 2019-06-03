@extends('voyager::master')

@section('page_title', __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->display_name_singular)

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->display_name_singular }}
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <form class="form-edit-add" role="form"
              action="{{ (isset($dataTypeContent->id)) ? route('voyager.'.$dataType->slug.'.update', $dataTypeContent->id) : route('voyager.'.$dataType->slug.'.store') }}"
              method="POST" enctype="multipart/form-data" autocomplete="off">
            <!-- PUT Method if we are editing -->
            @if(isset($dataTypeContent->id))
                {{ method_field("PUT") }}
            @endif
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-bordered">
                        {{-- <div class="panel"> --}}
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="username">{{ __('Username') }}</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="{{ __('Username') }}"
                                       value="@if(isset($dataTypeContent->username)){{ $dataTypeContent->username }}@endif">
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('voyager::generic.email') }}</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('voyager::generic.email') }}"
                                       value="@if(isset($dataTypeContent->email)){{ $dataTypeContent->email }}@endif">
                            </div>

                            <div class="form-group">
                                @php
                                if (isset($dataTypeContent->genre)) {
                                    $selected_civilite = $dataTypeContent->genre;
                                } else {
                                    $selected_civilite = '';
                                }

                                $civilites = array('Mademoiselle', 'Madame', 'Monsieur');

                                @endphp
                                <div class="form-group">
                                    <label for="genre">{{ __('Civilité') }}</label>
                                    <select class="form-control select2" id="genre" name="genre">
                                        @foreach ($civilites as $civ)
                                            <option value="{{ $civ }}"
                                                    {{ ($civ == $selected_civilite ? 'selected' : '') }}>{{ $civ }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="firstname">{{ __('Firstname') }}</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="{{ __('Firstname') }}"
                                       value="@if(isset($dataTypeContent->firstname)){{ $dataTypeContent->firstname }}@endif">
                            </div>

                            <div class="form-group">
                                <label for="lastname">{{ __('Lastname') }}</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="{{ __('Lastname') }}"
                                       value="@if(isset($dataTypeContent->lastname)){{ $dataTypeContent->lastname }}@endif">
                            </div>

                            <div class="form-group">
                                <label for="phone">{{ __('Phone') }}</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="{{ __('Phone') }}"
                                       value="@if(isset($dataTypeContent->phone)){{ $dataTypeContent->phone }}@endif">
                            </div>

                            <div class="form-group">
                                <label for="address">{{ __('Address') }}</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="{{ __('Address') }}"
                                       value="@if(isset($dataTypeContent->address)){{ $dataTypeContent->address }}@endif">
                            </div>

                            <div class="form-group">
                                <label for="zipcode">{{ __('Zipcode') }}</label>
                                <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="{{ __('Zipcode') }}"
                                       value="@if(isset($dataTypeContent->zipcode)){{ $dataTypeContent->zipcode }}@endif">
                            </div>

                            <div class="form-group">
                                <label for="city">{{ __('City') }}</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="{{ __('City') }}"
                                       value="@if(isset($dataTypeContent->city)){{ $dataTypeContent->city }}@endif">
                            </div>

                            <div class="form-group">
                                <label for="company">{{ __('Company') }}</label>
                                <input type="text" class="form-control" id="company" name="company" placeholder="{{ __('Company') }}"
                                       value="@if(isset($dataTypeContent->company)){{ $dataTypeContent->company }}@endif">
                            </div>

                            <div class="form-group">
                                <label for="holder">{{ __('Holder') }}</label>
                                <input type="text" class="form-control" id="holder" name="holder" placeholder="{{ __('Holder') }}"
                                       value="@if(isset($dataTypeContent->holder)){{ $dataTypeContent->holder }}@endif">
                            </div>

                            <div class="form-group">
                                <label for="card">{{ __('Card') }}</label>
                                <input type="text" class="form-control" id="card" name="card" placeholder="{{ __('Card') }}"
                                       value="@if(isset($dataTypeContent->card)){{ $dataTypeContent->card }}@endif">
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('voyager::generic.password') }}</label>
                                @if(isset($dataTypeContent->password))
                                    <br>
                                    <small>{{ __('voyager::profile.password_hint') }}</small>
                                @endif
                                <input type="password" class="form-control" id="password" name="password" value="" autocomplete="new-password">
                            </div>

                                {{--<div class="form-group">
                                    <label for="default_role">{{ __('voyager::profile.role_default') }}</label>
                                    @php
                                        $dataTypeRows = $dataType->{(isset($dataTypeContent->id) ? 'editRows' : 'addRows' )};

                                        $row     = $dataTypeRows->where('field', 'user_belongsto_role_relationship')->first();
                                        /*print('<pre>');
                                        print_r($row);
                                        print('</pre>');*/
                                        $options = $row->details;
                                    @endphp
                                    @include('voyager::formfields.relationship')
                                </div>
                                <div class="form-group">
                                    <label for="additional_roles">{{ __('voyager::profile.roles_additional') }}</label>
                                    @php
                                        $row     = $dataTypeRows->where('field', 'user_belongstomany_role_relationship')->first();
                                        $options = $row->details;
                                    @endphp
                                    @include('voyager::formfields.relationship')
                                </div>--}}
                            @php
                                if (isset($dataTypeContent->locale)) {
                                    $selected_locale = $dataTypeContent->locale;
                                } else {
                                    $selected_locale = config('app.locale', 'fr');
                                }
                            @endphp
                            <div class="form-group">
                                <label for="locale">{{ __('voyager::generic.locale') }}</label>
                                <select class="form-control select2" id="locale" name="locale">
                                    @foreach (Voyager::getLocales() as $locale)
                                        <option value="{{ $locale }}"
                                                {{ ($locale == $selected_locale ? 'selected' : '') }}>{{ $locale }}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-body">
                            <div class="form-group">
                                @if(isset($dataTypeContent->avatar))
                                    <img src="{{ filter_var($dataTypeContent->avatar, FILTER_VALIDATE_URL) ? $dataTypeContent->avatar : Voyager::image( $dataTypeContent->avatar ) }}" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;" />
                                @endif
                                <input type="file" data-name="avatar" name="avatar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary pull-right save">
                {{ __('voyager::generic.save') }}
            </button>
        </form>

        <iframe id="form_target" name="form_target" style="display:none"></iframe>
        <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
            {{ csrf_field() }}
            <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
            <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
        </form>
    </div>
@stop

@section('javascript')
    <script>
        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();
        });
    </script>
@stop
