@extends('layouts.app')

@section('content')
    <v-parallax id="home-banner" dark src="{{ asset('img/galileo-home-banner.jpg') }}" height="100%">
        <v-layout
            column
            align-center
            justify-center
        >
            <div id="home-filters">
                <h1 id="home-title" class="white--text mt-2 mb-4 display-1 text-md-center text-uppercase">La plateforme N°1 de service dédié à la vente<br>pour les professionnels de l'immobilier{{--<br><span id="simpleUsage" class="display-2 font-weight-bold primary-color text-md-left"></span>--}}</h1>
                <form action="{{ route('search') }}" method="POST">
                    @csrf
                    @method('POST')
                    <v-layout row wrap align-center>
                        <v-flex xs12 md3 offset-md1  pl-3>
                            <v-text-field
                                solo
                                color="#00e094"
                                label="Location"
                                prepend-inner-icon="place"
                                id="city"
                                name="city"
                                value="{{request('city')}}"
                            ></v-text-field>
                        </v-flex>
                        <v-flex xs12 md3  pl-3>
                            <dispositif-filter></dispositif-filter>
                        </v-flex>
                        <v-flex xs12 md3 pl-3>
                            <v-text-field
                                solo
                                color="#00e094"
                                label="Budget"
                                prepend-inner-icon="euro_symbol"
                                id="price"
                                name="price"
                                value="{{ request('price') }}"
                            ></v-text-field>
                        </v-flex>
                        <v-flex xs12 md2 text-md-left>
                            {{--<v-btn color="#00e094" type="submit" fab dark small  icon round depressed dark><v-icon>search</v-icon></v-btn>--}}
                            <v-btn class="btn-box-shadow-primaryy" type="submit" icon color="#00e094" depressed dark ><v-icon>search</v-icon></v-btn>
                        </v-flex>
                        <v-flex md12 text-md-center class="mt-4">
                            <span class="headline text-uppercase">{{ $programmes  }} Programmes - {{ $lots }} Lots</span>
                        </v-flex>
                    </v-layout>
                </form>
            </div>
        </v-layout>
    </v-parallax>
    <v-container fluid grid-list-md pa-0>
        <v-layout row wrap grid-md-list>
            <v-flex md12 class="text-md-center">
                <v-card flat color="#00e094" >
                    {{--<v-responsive>
                        <v-parallax src="{{ asset('img/bg-video-concept.jpg') }}" height="auto">--}}
                    <v-layout row wrap class="pt-5">
                        <v-flex md12>
                            <h2 class="display-1 text-uppercase font-weight-bold white--text pa-2">Retour de lots</h2>
                            <p class="headline text-uppercase white--text">Ne ratez pas les derniers retours de lot</p>
                        </v-flex>
                    </v-layout>
                    <v-container>
                        <v-layout row wrap>
                            <v-flex md3>
                                <v-card>
                                    <v-img src="{{ asset('img/bg-video-concept.jpg') }}" aspect-ratio="1.7"></v-img>
                                    <h3 class="subheading text-uppercase font-weight-bold black--text pa-2">Retour de lots</h3>
                                </v-card>
                            </v-flex>
                            <v-flex md3>
                                <v-card>
                                    <v-img src="{{ asset('img/bg-video-concept.jpg') }}" aspect-ratio="1.7"></v-img>
                                    <h3 class="subheading text-uppercase font-weight-bold black--text pa-2">Retour de lots</h3>
                                </v-card>
                            </v-flex>
                            <v-flex md3>
                                <v-card>
                                    <v-img src="{{ asset('img/bg-video-concept.jpg') }}" aspect-ratio="1.7"></v-img>
                                    <h3 class="subheading text-uppercase font-weight-bold black--text pa-2">Retour de lots</h3>
                                </v-card>
                            </v-flex>
                            <v-flex md3>
                                <v-card>
                                    <v-img src="{{ asset('img/bg-video-concept.jpg') }}" aspect-ratio="1.7"></v-img>
                                    <h3 class="subheading text-uppercase font-weight-bold black--text pa-2">Retour de lots</h3>
                                </v-card>
                            </v-flex>
                        </v-layout>
                    </v-container>
                    {{--</v-parallax>
                </v-responsive>--}}
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
    <v-container fluid pa-0>
        <v-card flat color="white">
            <v-layout row wrap>
            <v-flex xs12 md6>
                <v-img src="{{ asset('img/galileo-bg-home.png') }}"></v-img>
            </v-flex>

            <v-flex xs12 md5 pt-5 class="text-md-center">
                <v-layout row wrap>
                    <v-flex xs12 md12 class="pb-5">
                        <h2 class="display-1 text-uppercase font-weight-bold grey--text text--darken-4 pa-2">Pourquoi nous choisir</h2>
                        <p class="headline text-uppercase ">Exclusivités, Expertises & conseils</p>
                    </v-flex>
                    <v-flex xs12 md6 class="pt-3 pb-5">
                        <v-icon class="pb-2"
                                color="#00e094"
                        >fas fa-balance-scale</v-icon>
                        <h3 class="subheading text-uppercase">Frais de notaire réduits</h3>
                    </v-flex>
                    <v-flex xs12 md6 class="pt-3 pb-5">
                        <v-icon class="pb-2"
                                color="#00e094"
                        >fas fa-coins</v-icon>
                        <h3 class="subheading text-uppercase">Des aides financières</h3>
                    </v-flex>
                    <v-flex xs12 md6 class="pb-5">
                        <v-icon class="pb-2"
                                color="#00e094"
                        >account_balance</v-icon>
                        <h3 class="subheading text-uppercase">Multiple dispositifs fiscales</h3>
                    </v-flex>
                    <v-flex xs12 md6 class="pb-5">
                        <v-icon class="pb-2"
                                color="#00e094"
                        >fas fa-award</v-icon>
                        <h3 class="subheading text-uppercase">Label de qualité reconnu</h3>
                    </v-flex>
                    <v-flex xs12 md6 class="pb-5">
                        <v-icon class="pb-2"
                                color="#00e094"
                        >fas fa-home</v-icon>
                        <h3 class="subheading text-uppercase">Logement fonctionnel</h3>
                    </v-flex>
                    <v-flex xs12 md6 class="pb-5">
                        <v-icon class="pb-2"
                                color="#00e094"
                        >fas fa-handshake</v-icon>
                        <h3 class="subheading text-uppercase">Des garanties fiables</h3>
                    </v-flex>
                    <v-flex xs12 md12 class="pt-3 pb-5">
                        <v-btn href="{{ url('/contact') }}" class="no-underline font-weight-bold btn-box-shadow-primary" round large color="#00e094"><span class="white--text">Découvrir Galileo</span></v-btn>
                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
        </v-card>
    </v-container>
    <v-container fluid pt-0 pb-0>
        <v-layout row wrap grid-md-list>
            <v-flex md3>
                <v-card id="seller" flat color="#00e094">
                    <v-img
                        height="300"
                        src="{{ asset('img/vendez-votre-bien.png') }}"
                    >
                        <div class="seller-image fill-height">
                            <v-layout pa-2 fill-height align-center class="lightbox white--text">
                                <v-flex md8 class="pt-3 pb-3 img-block-home text-md-center">
                                    <h2 class="headline text-uppercase font-weight-bold white--text pa-2">Acheter un bien</h2>
                                    <v-btn href="https://www.ladresse-montpellier-saintroch.com/catalog/estimation.php" target="_blank" round color="#00e094" class="white--text">Découvrir</v-btn>
                                </v-flex>
                            </v-layout>
                        </div>
                    </v-img>
                </v-card>
            </v-flex>
            <v-flex md3>
                <v-card id="buyer" flat color="#2196F3">
                    <v-img
                        height="300"
                        src="{{ asset('img/achetez-un-bien-neuf.png') }}"
                    >
                        <div class="buyer-image fill-height">
                            <v-layout pa-2 fill-height align-center class="lightbox white--text">
                                <v-flex md8 class="pt-3 pb-3 img-block-home text-md-center">
                                    <h2 class="headline text-uppercase font-weight-bold white--text pa-2">Vendre un bien</h2>
                                    <v-btn round color="#2196F3" class="white--text">Découvrir</v-btn>
                                </v-flex>
                            </v-layout>
                        </div>
                    </v-img>
                </v-card>
            </v-flex>
            <v-flex md3>
                <v-card id="seller" flat color="#D81B60">
                    <v-img
                        height="300"
                        src="{{ asset('img/vendez-votre-bien.png') }}"
                    >
                        <div class="seller-image fill-height">
                            <v-layout pa-2 fill-height align-center class="lightbox white--text">
                                <v-flex md8 class="pt-3 pb-3 img-block-home text-md-center">
                                    <h2 class="headline text-uppercase font-weight-bold white--text pa-2">Louer un bien</h2>
                                    <v-btn href="https://www.ladresse-montpellier-saintroch.com/catalog/estimation.php" target="_blank" round color="#D81B60" class="white--text">Découvrir</v-btn>
                                </v-flex>
                            </v-layout>
                        </div>
                    </v-img>
                </v-card>
            </v-flex>
            <v-flex md3>
                <v-card id="buyer" flat color="#FFCA28">
                    <v-img
                        height="300"
                        src="{{ asset('img/achetez-un-bien-neuf.png') }}"
                    >
                        <div class="buyer-image fill-height">
                            <v-layout pa-2 fill-height align-center class="lightbox white--text">
                                <v-flex md8 class="pt-3 pb-3 img-block-home text-md-center">
                                    <h2 class="headline text-uppercase font-weight-bold white--text pa-2">Estimer mon bien</h2>
                                    <v-btn round color="#FFCA28" class="white--text">Découvrir</v-btn>
                                </v-flex>
                            </v-layout>
                        </div>
                    </v-img>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
    <v-container fluid pa-0>
        <v-card flat>
            <v-layout row wrap>
                <v-flex xs12 offset-md1 md6 pt-5 class="text-md-center">
                    <v-layout row wrap>
                        <v-flex xs12 md12 class="pb-3">
                            <h2 class="display-1 text-uppercase font-weight-bold grey--text text--darken-4 pa-2">Optimisez vos recherches de bien</h2>
                            <p class="headline text-uppercase ">Un outil pensé pour les professionnels</p>
                        </v-flex>
                        <v-flex xs12 md12 class="pt-3 pb-5">
                            <p class="subheading">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </v-flex>
                        <v-flex md12 class="pb-5">
                            <v-btn href="{{ url('/programmes') }}" class="no-underline font-weight-bold btn-box-shadow-primary" round large color="#00e094"><span class="white--text">Trouver votre bien</span></v-btn>
                        </v-flex>
                    </v-layout>
                </v-flex>
                <v-flex xs12 md5>
                    <v-img src="{{ asset('img/achetez-un-bien-neuf.png') }}"></v-img>
                </v-flex>
            </v-layout>
        </v-card>
    </v-container>
    <v-container fluid pa-0>
            <v-layout row wrap>
                <v-flex xs12 md5>
                    <v-img id="img-seller" src="{{ asset('img/vendez-votre-bien.png') }}"></v-img>
                </v-flex>
                <v-flex xs12 md6 pt-5 class="text-md-center">
                    <v-layout row wrap>
                        <v-flex xs12 md12 class="pb-3">
                            <h2 class="display-1 text-uppercase font-weight-bold grey--text text--darken-4 pa-2">Faites vous accompagner</h2>
                            <p class="headline text-uppercase ">Bénéficiez de l'expertise de nos conseillers</p>
                        </v-flex>
                        <v-flex xs12 md12 class="pt-3 pb-5">
                            <p class="subheading">Pour la plupart d’entre nous, particuliers Investisseurs, faire fructifier notre épargne n’est pas une tâche aisée. La variété des choix de placements et leur complexité accrue rendent plus difficile la prise de décision et nécessitent davantage de connaissances, d’informations et de temps à y consacrer. Le Conseiller en Gestion de Patrimoine vous aide dans cette prise de décision pour votre épargne, non seulement sur un angle purement financier, mais surtout il vous accompagne dans la gestion globale de votre patrimoine, tel un médecin généraliste qui veillera sur vous et votre famille, voire sur votre entreprise le cas échéant, vous préconisant un traitement approprié et individualisé.</p>
                        </v-flex>
                        <v-flex md12 class="pb-5">
                            <v-btn href="{{ url('/contact') }}" class="no-underline font-weight-bold btn-box-shadow-primary" round large color="#00e094"><span class="white--text">Se faire accompagner</span></v-btn>
                        </v-flex>
                    </v-layout>
                </v-flex>
            </v-layout>
    </v-container>
    <v-container fluid pa-0>
        <v-layout row wrap grid-md-list>
            <v-flex md12 class="text-md-center">
                <v-card flat color="#00e094" >
                    <v-responsive>
                        <v-parallax src="{{ asset('img/bg-video-concept.jpg') }}">
                            <v-layout row wrap class="pt-5 pb-5">
                                <v-flex md12>
                                    <h2 class="display-1 text-uppercase font-weight-bold white--text pa-2">Notre concept en vidéo</h2>
                                    <p class="headline text-uppercase white--text">Agent immobilier, expert comptable, notaire, courtier en prêt</p>
                                    <p class="headline white--text">Un moteur de recherche unique avec aide à la vente dédié aux professionnels</p>
                                </v-flex>
                                <v-flex md12  class="pt-3 pb-3">
                                    <teaser-galileo></teaser-galileo>
                                </v-flex>
                                @if(!Auth::user())
                                    <v-flex md12>
                                        <register-modal></register-modal>
                                    </v-flex>
                                @else
                                    <v-flex md12>
                                        <v-btn href="{{ url('/contact') }}" class="no-underline font-weight-bold btn-box-shadow-white" round large color="#fff"><span class="black--text">Contactez nous</span></v-btn>
                                        <v-btn href="tel:0621661430" class="no-underline font-weight-bold btn-box-shadow-white" round outline large color="#fff"><span class="white--text">Appelez nous</span></v-btn>
                                    </v-flex>
                                @endif
                            </v-layout>
                        </v-parallax>
                    </v-responsive>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
    <v-container fluid pa-0>
        <v-card>
            <v-layout row wrap grid-md-list>
                <v-flex md12 class="text-md-center">

                    {{--<v-responsive>
                        <v-parallax src="{{ asset('img/bg-video-concept.jpg') }}" height="auto">--}}
                    <v-layout row wrap class="pt-5 pb-5">
                        <v-flex md12>
                            <h2 class="display-1 text-uppercase font-weight-bold black--text pa-2">Parrainer c'est gagner</h2>
                            <p class="headline text-uppercase black--text">Vous connaissez quelqu'un susceptible d'acheter ?</p>
                            <p class="headline text-uppercase black--text">Recevez un chèque de <span class="font-weight-bold">500 €</span> pour chaque vente réalisée</p>
                        </v-flex>
                        <v-flex offset-md3 md6  class="pt-3 pb-3">
                            <p class="subheading black--text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </v-flex>
                        <v-flex md12>
                            @if(Auth::user())
                                @php($user = Auth::user())
                                <parrainage-modal :user="{{ $user }}"></parrainage-modal>
                            @else
                                <parrainage-modal></parrainage-modal>
                            @endif
                        </v-flex>
                    </v-layout>
                    {{--</v-parallax>
                </v-responsive>--}}
                </v-flex>
            </v-layout>
        </v-card>
    </v-container>
    <v-container fluid pa-0>
        <v-layout row wrap grid-md-list>
            <v-flex md12 class="text-md-center">
                <v-card flat color="#00e094" >
                    {{--<v-responsive>
                        <v-parallax src="{{ asset('img/bg-video-concept.jpg') }}" height="auto">--}}
                    <v-layout row wrap class="pt-5 pb-5">
                        <v-flex md12>
                            <h2 class="display-1 text-uppercase font-weight-bold white--text pa-2">Newsletter</h2>
                            <p class="headline text-uppercase white--text">Restez informé des derniers lots</p>
                        </v-flex>
                        <v-flex md12>
                            <newsletter-modal></newsletter-modal>
                        </v-flex>
                    </v-layout>
                    {{--</v-parallax>
                </v-responsive>--}}
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
    {{--<v-container fluid pa-0>
        <v-layout row wrap grid-md-list>
            <v-flex md12 class="text-md-center">
                <v-card flat color="#333" >
                    --}}{{--<v-responsive>
                        <v-parallax src="{{ asset('img/bg-video-concept.jpg') }}" height="auto">--}}{{--
                            <v-layout row wrap class="pt-5 pb-5">
                                <v-flex md12>
                                    <h2 class="display-1 text-uppercase font-weight-bold white--text pa-2">Nos témoignages</h2>
                                    <p class="headline text-uppercase white--text">Ce que les utilisateurs pensent de nous</p>
                                </v-flex>
                                <v-flex offset-md3 md6  class="pt-3 pb-3">
                                    <v-carousel id="testimonies" hide-delimiters height="350" flat>
                                        <v-carousel-item
                                        >
                                            <v-layout row wrap align-center pt-3>
                                                <v-flex md12>
                                                    <v-avatar
                                                        size="80px"
                                                    >
                                                        <img
                                                            src="https://avatars0.githubusercontent.com/u/9064066?v=4&s=460"
                                                            alt="Avatar"
                                                        >
                                                    </v-avatar>
                                                </v-flex>
                                                <v-flex md12 pt-3>
                                                    <h3 class="subheading font-weight-bold white--text">Pierre.C</h3>
                                                </v-flex>
                                                <v-flex md12 pb-3>
                                                <span class="rating">
                                                    <v-icon>star</v-icon>
                                                    <v-icon>star</v-icon>
                                                    <v-icon>star</v-icon>
                                                    <v-icon>star</v-icon>
                                                    <v-icon>star_half</v-icon>
                                                </span>
                                                </v-flex>
                                                <v-flex md8 offset-md2 pl-5 pr-5>
                                                    <p class="white--text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                </v-flex>
                                            </v-layout>
                                        </v-carousel-item>
                                        <v-carousel-item
                                        >
                                            <v-layout row wrap align-center pt-3>
                                                <v-flex md12>
                                                    <v-avatar
                                                        size="80px"
                                                    >
                                                        <img
                                                            src="https://avatars0.githubusercontent.com/u/9064066?v=4&s=460"
                                                            alt="Avatar"
                                                        >
                                                    </v-avatar>
                                                </v-flex>
                                                <v-flex md12 pt-3>
                                                    <h3 class="subheading font-weight-bold white--text">Pierre.C</h3>
                                                </v-flex>
                                                <v-flex md12 pb-3>
                                                <span class="rating">
                                                    <v-icon>star</v-icon>
                                                    <v-icon>star</v-icon>
                                                    <v-icon>star</v-icon>
                                                    <v-icon>star</v-icon>
                                                    <v-icon>star_half</v-icon>
                                                </span>
                                                </v-flex>
                                                <v-flex md8 offset-md2 pl-5 pr-5>
                                                    <p class="white--text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                </v-flex>
                                            </v-layout>
                                        </v-carousel-item>
                                        <v-carousel-item
                                        >
                                            <v-layout row wrap align-center pt-3>
                                                <v-flex md12>
                                                    <v-avatar
                                                        size="80px"
                                                    >
                                                        <img
                                                            src="https://avatars0.githubusercontent.com/u/9064066?v=4&s=460"
                                                            alt="Avatar"
                                                        >
                                                    </v-avatar>
                                                </v-flex>
                                                <v-flex md12 pt-3>
                                                    <h3 class="subheading font-weight-bold white--text">Pierre.C</h3>
                                                </v-flex>
                                                <v-flex md12 pb-3>
                                                <span class="rating">
                                                    <v-icon>star</v-icon>
                                                    <v-icon>star</v-icon>
                                                    <v-icon>star</v-icon>
                                                    <v-icon>star</v-icon>
                                                    <v-icon>star_half</v-icon>
                                                </span>
                                                </v-flex>
                                                <v-flex md8 offset-md2 pl-5 pr-5>
                                                    <p class="white--text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                </v-flex>
                                            </v-layout>
                                        </v-carousel-item>
                                        <v-carousel-item
                                        >
                                            <v-layout row wrap align-center pt-3>
                                                <v-flex md12>
                                                    <v-avatar
                                                        size="80px"
                                                    >
                                                        <img
                                                            src="https://avatars0.githubusercontent.com/u/9064066?v=4&s=460"
                                                            alt="Avatar"
                                                        >
                                                    </v-avatar>
                                                </v-flex>
                                                <v-flex md12 pt-3>
                                                    <h3 class="subheading font-weight-bold white--text">Pierre.C</h3>
                                                </v-flex>
                                                <v-flex md12 pb-3>
                                                <span class="rating">
                                                    <v-icon>star</v-icon>
                                                    <v-icon>star</v-icon>
                                                    <v-icon>star</v-icon>
                                                    <v-icon>star</v-icon>
                                                    <v-icon>star_half</v-icon>
                                                </span>
                                                </v-flex>
                                                <v-flex md8 offset-md2 pl-5 pr-5>
                                                    <p class="white--text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                </v-flex>
                                            </v-layout>
                                        </v-carousel-item>
                                        <v-carousel-item
                                        >
                                            <v-layout row wrap align-center pt-3>
                                                <v-flex md12>
                                                    <v-avatar
                                                        size="80px"
                                                    >
                                                        <img
                                                            src="https://avatars0.githubusercontent.com/u/9064066?v=4&s=460"
                                                            alt="Avatar"
                                                        >
                                                    </v-avatar>
                                                </v-flex>
                                                <v-flex md12 pt-3>
                                                    <h3 class="subheading font-weight-bold white--text">Pierre.C</h3>
                                                </v-flex>
                                                <v-flex md12 pb-3>
                                                <span class="rating">
                                                    <v-icon>star</v-icon>
                                                    <v-icon>star</v-icon>
                                                    <v-icon>star</v-icon>
                                                    <v-icon>star</v-icon>
                                                    <v-icon>star_half</v-icon>
                                                </span>
                                                </v-flex>
                                                <v-flex md8 offset-md2 pl-5 pr-5>
                                                    <p class="white--text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                </v-flex>
                                            </v-layout>
                                        </v-carousel-item>
                                    </v-carousel>
                                </v-flex>
                                @if(!Auth::user())
                                    <v-flex md12>
                                        <register-modal></register-modal>
                                    </v-flex>
                                @endif
                            </v-layout>
                        --}}{{--</v-parallax>
                    </v-responsive>--}}{{--
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
    <v-container grid-list-md>
        <v-layout row wrap>
            <v-flex xs12 md12 class="pb-5 text-md-center">
                <h2 class="display-1 text-uppercase font-weight-bold grey--text text--darken-4 pa-2">Notre actualités</h2>
                <p class="headline text-uppercase ">Découvrez tous nos conseils et ne ratez plus aucunes ventes</p>
            </v-flex>
            @foreach($posts as $post)
                <v-flex flex xs12 md4>
                    <post
                        :slug="'{{ $post->slug }}'"
                        :thumbnail="'{{ $post->image }}'"
                        :name="'{{ addslashes($post->title) }}'"
                        :excerpt="'{{ addslashes($post->excerpt) }}'"
                        :categories="'{{ $post->category_id }}'"
                        :date="'{{ $post->created_at }}'"
                    ></post>
                </v-flex>
            @endforeach
        </v-layout>
    </v-container>--}}



    {{--<v-container fluid pt-0 pb-0>
        <v-layout row wrap grid-md-list>
            <v-flex md12>
                <v-card id="seller" flat color="#2196F3">
                    <v-img
                        height="500"
                        src="{{ asset('img/bg-investir-dans-le-neuf.png') }}"
                        aspect-ratio="1.7"
                    >
                        <div class="seller-image fill-height bottom-secondary-gradient">
                            <v-layout pa-2 fill-height align-center class="lightbox white--text">
                                <v-flex class="text-md-center">
                                    <h2 class="headline text-uppercase font-weight-bold white--text pa-2">Investissez en toute sécurité</h2>
                                    <h3 class="headline">N'ayez plus peur d'investir, faîtes confiance à nos spécialistes en gestion de patrimoine</h3>
                                    <v-btn href="https://www.ladresse-montpellier-saintroch.com/catalog/estimation.php" target="_blank" outline round color="white">Découvrir</v-btn>
                                </v-flex>
                            </v-layout>
                        </div>
                    </v-img>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>--}}
@endsection
