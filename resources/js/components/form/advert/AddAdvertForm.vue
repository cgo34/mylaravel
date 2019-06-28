<template>
    <v-stepper id="addAdvert" class="advert-location" v-model="creatingAdvert.e1">
        <v-layout justify-center row wrap>
            {{ user_type }}
            {{ type }}
            {{ advert_types }}
            <v-flex md10>
                <v-stepper-header>
                    <v-stepper-step v-if="type === 'Vente'" color="rgb(0, 224, 148)" :complete="creatingAdvert.e1 > 1" step="1">Localisation</v-stepper-step>
                    <v-stepper-step v-if="type === 'Location'" color="#D81B60" :complete="creatingAdvert.e1 > 1" step="1">Localisation</v-stepper-step>
                    <v-stepper-step v-if="type === 'Recherche'" color="rgb(33, 150, 243)" :complete="creatingAdvert.e1 > 1" step="1">Type</v-stepper-step>
                    <v-divider></v-divider>
                    <v-stepper-step v-if="type === 'Vente'" color="rgb(0, 224, 148)" :complete="creatingAdvert.e1 > 2" step="2">Le bien</v-stepper-step>
                    <v-stepper-step v-if="type === 'Location'"  color="#D81B60" :complete="creatingAdvert.e1 > 2" step="2">Le bien</v-stepper-step>
                    <v-stepper-step v-if="type === 'Recherche'" color="rgb(33, 150, 243)" :complete="creatingAdvert.e1 > 2" step="2">Localisation</v-stepper-step>
                    <v-divider></v-divider>
                    <v-stepper-step v-if="type === 'Vente'" color="rgb(0, 224, 148)" :complete="creatingAdvert.e1 > 3" step="3">Montant</v-stepper-step>
                    <v-stepper-step v-if="type === 'Location'"  color="#D81B60" :complete="creatingAdvert.e1 > 3" step="3">Montant</v-stepper-step>
                    <v-stepper-step v-if="type === 'Recherche'" color="rgb(33, 150, 243)" :complete="creatingAdvert.e1 > 3" step="3">Le bien</v-stepper-step>

                    <v-divider v-if="type !== 'Recherche'"></v-divider>
                    <v-divider v-if="type === 'Recherche'"></v-divider>
                    <v-stepper-step v-if="type === 'Vente'" color="rgb(0, 224, 148)" :complete="creatingAdvert.e1 > 4" step="4">Photos</v-stepper-step>
                    <v-stepper-step v-if="type === 'Location'" color="#D81B60" :complete="creatingAdvert.e1 > 4" step="4">Photos</v-stepper-step>
                    <v-stepper-step v-if="type === 'Recherche'" color="rgb(33, 150, 243)" :complete="creatingAdvert.e1 > 4" step="4">Montant</v-stepper-step>
                    <v-divider></v-divider>
                    <v-stepper-step v-if="type === 'Vente'" color="rgb(0, 224, 148)" step="5">Récapitulatif</v-stepper-step>
                    <v-stepper-step v-if="type === 'Location'" color="#D81B60" step="5">Récapitulatif</v-stepper-step>
                    <v-stepper-step v-if="type === 'Recherche'" color="rgb(33, 150, 243)" step="5">Récapitulatif</v-stepper-step>
                </v-stepper-header>
            </v-flex>
        </v-layout>
        <v-stepper-items>
            <v-stepper-content v-if="type === 'Recherche'" step="1">
                <v-card
                    class="mb-5 pb-5"
                >
                    <v-card-title primary-title class="justify-center">
                        <h3>Que cherchez vous ?</h3>
                    </v-card-title>
                    <v-layout justify-center row wrap>
                        <v-flex xs12 sm4 md6>
                            <!-- Advert Type-->
                            <v-layout class="row wrap align-center">
                                <label>Type de bien</label>
                                <v-flex md6 class="text-md-right"
                                        v-if="advert_type.name !== 'Vente' && advert_type.name !== 'Recherche'"
                                        v-for="(advert_type, index) in  advert_types"
                                        v-bind:key="index"
                                >
                                    <label class="text-md-center">
                                        <input type="radio" v-model="creatingAdvert.advert_type" :name="advert_type.name" :value="advert_type.name" class="property-type-input-element" />

                                        <div class="panel panel-default property-type-input layout align-center justify-center">
                                            <div class="panel-heading">
                                                <img
                                                    v-if="advert_type.name === 'Achat'"
                                                    src="/img/icons/building.png" width="60px" />
                                                <img
                                                    v-else-if="advert_type.name === 'Location'"
                                                    src="/img/icons/house.png" width="60px" />
                                                <v-spacer></v-spacer>
                                                <span class="font-weight-bold">{{ advert_type.name }}</span>
                                            </div>
                                        </div>
                                    </label>

                                </v-flex>
                            </v-layout>
                        </v-flex>
                    </v-layout>
                    <!-- Property Type-->
                    <v-flex xs12 sm4 md6>

                    </v-flex>
                </v-card>
                <v-layout row wrap>
                    <v-flex md6 class="text-md-left">
                        <v-btn flat>Retour</v-btn>
                    </v-flex>
                    <v-flex md6 class="text-md-right">
                        <v-btn
                            round
                            color="#D81B60"
                            class="white--text"
                            @click.stop="creatingAdvert.e1 = 2"
                            :disabled="!(creatingAdvert.advert_type)"
                        >
                            Suivant
                        </v-btn>
                    </v-flex>
                </v-layout>
            </v-stepper-content>
            <v-stepper-content  v-else step="1">
                <v-card
                    class="mb-5 pb-5"
                >
                    <v-card-title primary-title class="justify-center">
                        <h3 v-if="type !== 'Recherche'">Où est situé votre bien ?</h3>
                        <h3 v-else-if="type === 'Recherche'">Où cherchez vous un bien ?</h3>
                    </v-card-title>
                    <v-layout v-if="type !== 'Recherche'" justify-center row wrap>
                        <v-flex xs12 sm8 md8>
                            <label>Adresse de votre bien</label>
                            <v-text-field
                                outline
                                single-line
                                v-model="creatingAdvert.address"
                                id="address"
                                name="address"
                                :value="creatingAdvert.address"
                                :rules="[rules.required]"
                                required
                            ></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm8 md8>
                            <label>Commune ou code postal</label>
                            <v-text-field
                                outline
                                single-line
                                v-model="creatingAdvert.zipcode"
                                id="zipcode"
                                name="zipcode"
                                :value="creatingAdvert.zipcode"
                                :rules="[rules.required]"
                                required
                            ></v-text-field>
                        </v-flex>
                    </v-layout>
                    <v-layout v-if="type === 'Recherche'" justify-center row wrap>
                        <v-flex xs12 sm8 md8>
                            <label>Ville ou Code postal</label>
                            {{ creatingAdvert }}
                            <v-combobox
                                @keyup="getCities"
                                hide-no-data
                                outline
                                single-line
                                v-model="creatingAdvert.city"
                                id="city"
                                name="city"
                                :items="test"
                                item-text="name"
                                item-value="value"
                                :rules="[rules.required]"
                                @input.native="creatingAdvert.city=$event.srcElement.value"
                                required
                            ></v-combobox>
                        </v-flex>
                    </v-layout>
                </v-card>
                <v-layout row wrap>
                    <v-flex md6 class="text-md-left">
                        <v-btn flat>Retour</v-btn>
                    </v-flex>
                    <v-flex md6 class="text-md-right">
                        <v-btn v-if="type === 'Recherche'"
                            round
                            color="#D81B60"
                            class="white--text"
                            @click.stop="creatingAdvert.e1 = 2"
                            :disabled="!(creatingAdvert.advert_type)"
                        >
                            Suivant
                        </v-btn>
                        <v-btn v-else
                               round
                               color="#D81B60"
                               class="white--text"
                               @click.stop="creatingAdvert.e1 = 2"
                               :disabled="!(creatingAdvert.city)"
                        >
                            Suivant
                        </v-btn>
                    </v-flex>
                </v-layout>
            </v-stepper-content>



            <!-- STEP 2 : ADVERT -->
            <v-stepper-content  v-if="type === 'Recherche'" step="2">
                here advert recherche step 2
                <v-card
                    class="mb-5 pb-5"
                >
                    <v-card-title primary-title class="justify-center">
                        <h3 v-if="type !== 'Recherche'">Où est situé votre bien ?</h3>
                        <h3 v-else-if="type === 'Recherche'">Où cherchez vous un bien ?</h3>
                    </v-card-title>
                    <v-layout v-if="type !== 'Recherche'" justify-center row wrap>
                        <v-flex xs12 sm8 md8>
                            <label>Adresse de votre bien</label>
                            <v-text-field
                                outline
                                single-line
                                v-model="creatingAdvert.address"
                                id="address"
                                name="address"
                                :value="creatingAdvert.address"
                                :rules="[rules.required]"
                                required
                            ></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm8 md8>
                            <label>Commune ou code postal</label>
                            <v-text-field
                                outline
                                single-line
                                v-model="creatingAdvert.zipcode"
                                id="zipcode"
                                name="zipcode"
                                :value="creatingAdvert.zipcode"
                                :rules="[rules.required]"
                                required
                            ></v-text-field>
                        </v-flex>
                    </v-layout>
                    <v-layout v-if="type === 'Recherche'" justify-center row wrap>
                        <v-flex xs12 sm8 md8>
                            <label>Ville ou Code postal</label>
                            {{ creatingAdvert }}
                            <v-combobox
                                @keyup="getCities"
                                hide-no-data
                                outline
                                single-line
                                v-model="creatingAdvert.city"
                                id="address"
                                name="address"
                                :items="test"
                                item-text="name"
                                item-value="value"
                                :rules="[rules.required]"
                                @input.native="creatingAdvert.city=$event.srcElement.value"
                                required
                            ></v-combobox>
                        </v-flex>
                    </v-layout>
                </v-card>
                <v-layout row wrap>
                    <v-flex md6 class="text-md-left">
                        <v-btn round flat @click.stop="creatingAdvert.e1 = 1">Retour</v-btn>
                    </v-flex>
                    <v-flex md6 class="text-md-right">
                        <v-btn
                            round
                            color="#D81B60"
                            class="white--text"
                            @click.stop="creatingAdvert.e1 = 3"
                            :disabled="!(creatingAdvert.city)"
                        >
                            Suivant
                        </v-btn>
                    </v-flex>
                </v-layout>
            </v-stepper-content>
            <v-stepper-content v-else step="2">
                <v-card
                    class="mb-5 pb-5"
                >
                    <v-card-title primary-title class="justify-center">
                        <h3 v-if="type === 'Vente' || type === 'Location'">Décrivez votre bien </h3>
                        <h3 v-else-if="type === 'Recherche'">Que souhaitez vous acheter ?</h3>
                    </v-card-title>
                    <v-layout justify-center row wrap>
                        <v-flex xs12 sm4 md6>
                            <!-- Property Type-->
                            <v-layout class="row wrap align-center">
                                <label>Type de bien</label>
                                <v-flex md6 class="text-md-right"
                                    v-for="(property_type, index) in  property_types"
                                    v-bind:key="index"
                                >
                                    <label class="text-md-center">
                                        <input @click="creatingAdvert.property_features = []" type="radio" v-model="creatingAdvert.property_type" :name="property_type.name" :value="property_type.name" class="property-type-input-element" />

                                        <div class="panel panel-default property-type-input layout align-center justify-center">
                                            <div class="panel-heading">
                                                <img
                                                    v-if="property_type.name === 'Appartement'"
                                                    src="/img/icons/building.png" width="60px" />
                                                <img
                                                    v-else-if="property_type.name === 'Maison'"
                                                    src="/img/icons/house.png" width="60px" />
                                                <img
                                                    v-else-if="property_type.name === 'Parking'"
                                                    src="/img/icons/park.png" width="60px" />
                                                <img
                                                    v-else-if="property_type.name === 'Terrain'"
                                                    src="/img/icons/terrain.png" width="60px" />
                                                <v-spacer></v-spacer>
                                                <span class="font-weight-bold">{{ property_type.name }}</span>
                                            </div>
                                        </div>
                                    </label>

                                </v-flex>
                            </v-layout>
                            <!-- Property Informations-->
                            <v-layout
                                v-if="type === 'Vente' || type === 'Location'"
                                class="row wrap align-center"
                            >
                                <v-flex md4>
                                    <label>Surface</label>
                                    <v-text-field
                                        single-line
                                        v-model="creatingAdvert.living_space"
                                        id="living_space"
                                        name="living_space"
                                        :value="creatingAdvert.living_space"
                                        outline
                                        suffix="m²"
                                        placeholder="0"
                                        color="#D81B60"
                                        :rules="[rules.required]"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex md4>
                                    <label>Pièces</label>
                                    <v-text-field
                                        class="input-number"
                                        single-line
                                        v-model="creatingAdvert.room"
                                        id="room"
                                        name="room"
                                        :value="creatingAdvert.room"
                                        outline
                                        placeholder="0"
                                        append-icon="add"
                                        prepend-inner-icon="remove"
                                        @click:append="addRoom"
                                        @click:prepend-inner="removeRoom"
                                        color="#D81B60"
                                        :rules="[rules.required]"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex md4>
                                    <label>Chambres</label>
                                    <v-text-field
                                        single-line
                                        v-model="creatingAdvert.bedroom"
                                        id="bedroom"
                                        name="bedroom"
                                        :value="creatingAdvert.bedroom"
                                        outline
                                        placeholder="0"
                                        append-icon="add"
                                        prepend-inner-icon="remove"
                                        @click:append="addBedroom"
                                        @click:prepend-inner="removeBedroom"
                                        color="#D81B60"
                                        :rules="[rules.required]"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                            <v-layout
                                v-else-if="type === 'Recherche'"
                                class="row wrap align-center"
                            >
                                <v-flex md6>
                                    <label>Surface minimum</label>
                                    <v-text-field
                                        single-line
                                        v-model="creatingAdvert.living_space_min"
                                        id="living_space_min"
                                        name="living_space_min"
                                        :value="creatingAdvert.living_space_min"
                                        outline
                                        suffix="m²"
                                        placeholder="0"
                                        color="#D81B60"
                                        :rules="[rules.required]"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex md6>
                                    <label>Surface maximum</label>
                                    <v-text-field
                                        single-line
                                        v-model="creatingAdvert.living_space_max"
                                        id="living_space_max"
                                        name="living_space_max"
                                        :value="creatingAdvert.living_space_max"
                                        outline
                                        suffix="m²"
                                        placeholder="0"
                                        color="#D81B60"
                                        :rules="[rules.required]"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex md4>
                                    <label>Pièces</label>
                                    <v-text-field
                                        class="input-number"
                                        single-line
                                        v-model="creatingAdvert.room"
                                        id="room"
                                        name="room"
                                        :value="creatingAdvert.room"
                                        outline
                                        placeholder="0"
                                        append-icon="add"
                                        prepend-inner-icon="remove"
                                        @click:append="addRoom"
                                        @click:prepend-inner="removeRoom"
                                        color="#D81B60"
                                        :rules="[rules.required]"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex md4>
                                    <label>Chambres</label>
                                    <v-text-field
                                        single-line
                                        v-model="creatingAdvert.bedroom"
                                        id="bedroom"
                                        name="bedroom"
                                        :value="creatingAdvert.bedroom"
                                        outline
                                        placeholder="0"
                                        append-icon="add"
                                        prepend-inner-icon="remove"
                                        @click:append="addBedroom"
                                        @click:prepend-inner="removeBedroom"
                                        color="#D81B60"
                                        :rules="[rules.required]"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex md4>
                                    <label>Salle de bain</label>
                                    <v-text-field
                                        single-line
                                        v-model="creatingAdvert.bathroom"
                                        id="bathroom"
                                        name="bathroom"
                                        :value="creatingAdvert.bathroom"
                                        outline
                                        placeholder="0"
                                        append-icon="add"
                                        prepend-inner-icon="remove"
                                        @click:append="addBathroom"
                                        @click:prepend-inner="removeBathroom"
                                        color="#D81B60"
                                        :rules="[rules.required]"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                            <!-- Property Availability Date-->
                            <v-layout class="row wrap align-center">
                                <v-flex md12>
                                    <label>Disponible à partir de</label>
                                    <v-menu
                                        v-model="menu2"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        lazy
                                        transition="scale-transition"
                                        offset-y
                                        full-width
                                        min-width="290px"
                                    >
                                        <template v-slot:activator="{ on }">
                                            <v-text-field
                                                v-model="creatingAdvert.dateFormatted"
                                                outline
                                                single-line
                                                append-icon="event"
                                                readonly
                                                v-on="on"
                                                :rules="[rules.required]"
                                            ></v-text-field>
                                        </template>
                                        <v-date-picker v-model="date" @input="menu2 = false"></v-date-picker>
                                    </v-menu>
                                </v-flex>
                            </v-layout>
                            <!-- Property Features -->
                            <v-layout class="row wrap align-center">
                                <v-flex md12>
                                    <label>Equipements du bien</label>
                                    <v-layout
                                        row
                                        wrap
                                        align-center
                                        v-for="(property_type, index) in  property_types"
                                        v-bind:key="index"
                                        v-if="creatingAdvert.property_type === property_type.name"
                                    >
                                        <v-flex
                                            md3
                                            class="text-md-center"
                                            v-for="(feature, index) in property_type.features"
                                            v-bind:key="index"
                                        >
                                            <label>
                                                <input type="checkbox" :name="feature.key" :value="feature.id" v-model="creatingAdvert.property_features" class="property-feature-input-element" />

                                                <div class="panel panel-default property-feature-input layout align-center justify-center">
                                                    <div class="panel-heading">
                                                        <img :src="'/img/icons/' + feature.key + '.png'" width="30px" />
                                                        <v-spacer></v-spacer>
                                                        <span class="font-weight-bold">{{ feature.name }}</span>
                                                    </div>
                                                </div>
                                            </label>

                                        </v-flex>
                                    </v-layout>
                                </v-flex>

                            </v-layout>
                            <!-- Property Description -->
                            <v-layout row wrap align-center>
                                <v-flex md12>
                                    <label>Description du bien</label>
                                    <v-textarea
                                        outline
                                        v-model="creatingAdvert.description"
                                        id="description"
                                        name="description"
                                        :value="creatingAdvert.description"
                                        placeholder="Décrivez ici votre bien, par exemple : joli apparement en centre de village plein de lumière idéal pour jeune couple avec enfant"
                                        :rules="[rules.required]"
                                    ></v-textarea>
                                </v-flex>
                            </v-layout>
                            <!-- Property Energetic Class -->
                            <v-layout row wrap align-center>
                                <v-flex md12>
                                    <label>Diagnostic de performance énergétique (optionnel)</label>
                                    <v-layout row wrap align-center>
                                        <v-flex md4>
                                            <v-text-field
                                                single-line
                                                v-model="creatingAdvert.energetic_class_value"
                                                outline
                                                placeholder="0"
                                                color="#D81B60"
                                            ></v-text-field>
                                        </v-flex>
                                        <v-flex md8>
                                            <v-select
                                                single-line
                                                :items="energetic_class_items"
                                                v-model="creatingAdvert.energetic_class"
                                                outline
                                                color="#D81B60"
                                            ></v-select>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                            </v-layout>
                        </v-flex>
                    </v-layout>
                </v-card>
                <v-layout row wrap>
                    <v-flex md6 class="text-md-left">
                        <v-btn round flat @click.stop="creatingAdvert.e1 = 1">Retour</v-btn>
                    </v-flex>
                    <v-flex md6 class="text-md-right">
                        <v-btn
                            round
                            color="#D81B60"
                            class="white--text"
                            @click.stop="creatingAdvert.e1 = 3"
                            :disabled="!(creatingAdvert.property_type
                                        && creatingAdvert.living_space
                                        && creatingAdvert.room
                                        && creatingAdvert.bedroom
                                        && creatingAdvert.description
                                        )"
                        >
                            Suivant
                        </v-btn>
                    </v-flex>
                </v-layout>
            </v-stepper-content>

            <!-- STEP 3 : ADVERT -->
            <v-stepper-content v-if="type === 'Recherche'" step="3">
                <v-card
                    class="mb-5 pb-5"
                >
                    <v-card-title primary-title class="justify-center">
                        <h3 v-if="type === 'Vente' || type === 'Location'">Décrivez votre bien </h3>
                        <h3 v-else-if="type === 'Recherche'">Que souhaitez vous acheter ?</h3>
                    </v-card-title>
                    <v-layout justify-center row wrap>
                        <v-flex xs12 sm4 md6>
                            <!-- Property Type-->
                            <v-layout class="row wrap align-center">
                                <label>Type de bien</label>
                                <v-flex md6 class="text-md-right"
                                        v-for="(property_type, index) in  property_types"
                                        v-bind:key="index"
                                >
                                    <label class="text-md-center">
                                        <input @click="creatingAdvert.property_features = []" type="radio" v-model="creatingAdvert.property_type" :name="property_type.name" :value="property_type.name" class="property-type-input-element" />

                                        <div class="panel panel-default property-type-input layout align-center justify-center">
                                            <div class="panel-heading">
                                                <img
                                                    v-if="property_type.name === 'Appartement'"
                                                    src="/img/icons/building.png" width="60px" />
                                                <img
                                                    v-else-if="property_type.name === 'Maison'"
                                                    src="/img/icons/house.png" width="60px" />
                                                <img
                                                    v-else-if="property_type.name === 'Parking'"
                                                    src="/img/icons/park.png" width="60px" />
                                                <img
                                                    v-else-if="property_type.name === 'Terrain'"
                                                    src="/img/icons/terrain.png" width="60px" />
                                                <v-spacer></v-spacer>
                                                <span class="font-weight-bold">{{ property_type.name }}</span>
                                            </div>
                                        </div>
                                    </label>

                                </v-flex>
                            </v-layout>
                            <!-- Property Informations-->
                            <v-layout
                                v-if="type === 'Vente' || type === 'Location'"
                                class="row wrap align-center"
                            >
                                <v-flex md4>
                                    <label>Surface</label>
                                    <v-text-field
                                        single-line
                                        v-model="creatingAdvert.living_space"
                                        id="living_space"
                                        name="living_space"
                                        :value="creatingAdvert.living_space"
                                        outline
                                        suffix="m²"
                                        placeholder="0"
                                        color="#D81B60"
                                        :rules="[rules.required]"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex md4>
                                    <label>Pièces</label>
                                    <v-text-field
                                        class="input-number"
                                        single-line
                                        v-model="creatingAdvert.room"
                                        id="room"
                                        name="room"
                                        :value="creatingAdvert.room"
                                        outline
                                        placeholder="0"
                                        append-icon="add"
                                        prepend-inner-icon="remove"
                                        @click:append="addRoom"
                                        @click:prepend-inner="removeRoom"
                                        color="#D81B60"
                                        :rules="[rules.required]"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex md4>
                                    <label>Chambres</label>
                                    <v-text-field
                                        single-line
                                        v-model="creatingAdvert.bedroom"
                                        id="bedroom"
                                        name="bedroom"
                                        :value="creatingAdvert.bedroom"
                                        outline
                                        placeholder="0"
                                        append-icon="add"
                                        prepend-inner-icon="remove"
                                        @click:append="addBedroom"
                                        @click:prepend-inner="removeBedroom"
                                        color="#D81B60"
                                        :rules="[rules.required]"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                            <v-layout
                                v-else-if="type === 'Recherche'"
                                class="row wrap align-center"
                            >
                                <v-flex md6>
                                    <label>Surface minimum</label>
                                    <v-text-field
                                        single-line
                                        v-model="creatingAdvert.living_space_min"
                                        id="living_space_min"
                                        name="living_space_min"
                                        :value="creatingAdvert.living_space_min"
                                        outline
                                        suffix="m²"
                                        placeholder="0"
                                        color="#D81B60"
                                        :rules="[rules.required]"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex md6>
                                    <label>Surface maximum</label>
                                    <v-text-field
                                        single-line
                                        v-model="creatingAdvert.living_space_max"
                                        id="living_space_max"
                                        name="living_space_max"
                                        :value="creatingAdvert.living_space_max"
                                        outline
                                        suffix="m²"
                                        placeholder="0"
                                        color="#D81B60"
                                        :rules="[rules.required]"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex md4>
                                    <label>Pièces</label>
                                    <v-text-field
                                        class="input-number"
                                        single-line
                                        v-model="creatingAdvert.room"
                                        id="room"
                                        name="room"
                                        :value="creatingAdvert.room"
                                        outline
                                        placeholder="0"
                                        append-icon="add"
                                        prepend-inner-icon="remove"
                                        @click:append="addRoom"
                                        @click:prepend-inner="removeRoom"
                                        color="#D81B60"
                                        :rules="[rules.required]"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex md4>
                                    <label>Chambres</label>
                                    <v-text-field
                                        single-line
                                        v-model="creatingAdvert.bedroom"
                                        id="bedroom"
                                        name="bedroom"
                                        :value="creatingAdvert.bedroom"
                                        outline
                                        placeholder="0"
                                        append-icon="add"
                                        prepend-inner-icon="remove"
                                        @click:append="addBedroom"
                                        @click:prepend-inner="removeBedroom"
                                        color="#D81B60"
                                        :rules="[rules.required]"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex md4>
                                    <label>Salle de bain</label>
                                    <v-text-field
                                        single-line
                                        v-model="creatingAdvert.bathroom"
                                        id="bathroom"
                                        name="bathroom"
                                        :value="creatingAdvert.bathroom"
                                        outline
                                        placeholder="0"
                                        append-icon="add"
                                        prepend-inner-icon="remove"
                                        @click:append="addBathroom"
                                        @click:prepend-inner="removeBathroom"
                                        color="#D81B60"
                                        :rules="[rules.required]"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                            <!-- Property Availability Date-->
                            <v-layout class="row wrap align-center">
                                <v-flex md12>
                                    <label>Disponible à partir de</label>
                                    <v-menu
                                        v-model="menu2"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        lazy
                                        transition="scale-transition"
                                        offset-y
                                        full-width
                                        min-width="290px"
                                    >
                                        <template v-slot:activator="{ on }">
                                            <v-text-field
                                                v-model="creatingAdvert.dateFormatted"
                                                outline
                                                single-line
                                                append-icon="event"
                                                readonly
                                                v-on="on"
                                                :rules="[rules.required]"
                                            ></v-text-field>
                                        </template>
                                        <v-date-picker v-model="date" @input="menu2 = false"></v-date-picker>
                                    </v-menu>
                                </v-flex>
                            </v-layout>
                            <!-- Property Features -->
                            <v-layout class="row wrap align-center">
                                <v-flex md12>
                                    <label>Equipements du bien</label>
                                    <v-layout
                                        row
                                        wrap
                                        align-center
                                        v-for="(property_type, index) in  property_types"
                                        v-bind:key="index"
                                        v-if="creatingAdvert.property_type === property_type.name"
                                    >
                                        <v-flex
                                            md3
                                            class="text-md-center"
                                            v-for="(feature, index) in property_type.features"
                                            v-bind:key="index"
                                        >
                                            <label>
                                                <input type="checkbox" :name="feature.key" :value="feature.id" v-model="creatingAdvert.property_features" class="property-feature-input-element" />

                                                <div class="panel panel-default property-feature-input layout align-center justify-center">
                                                    <div class="panel-heading">
                                                        <img :src="'/img/icons/' + feature.key + '.png'" width="30px" />
                                                        <v-spacer></v-spacer>
                                                        <span class="font-weight-bold">{{ feature.name }}</span>
                                                    </div>
                                                </div>
                                            </label>

                                        </v-flex>
                                    </v-layout>
                                </v-flex>

                            </v-layout>
                            <!-- Property Description -->
                            <v-layout row wrap align-center>
                                <v-flex md12>
                                    <label>Description du bien</label>
                                    <v-textarea
                                        outline
                                        v-model="creatingAdvert.description"
                                        id="description"
                                        name="description"
                                        :value="creatingAdvert.description"
                                        placeholder="Décrivez ici votre bien, par exemple : joli apparement en centre de village plein de lumière idéal pour jeune couple avec enfant"
                                        :rules="[rules.required]"
                                    ></v-textarea>
                                </v-flex>
                            </v-layout>
                            <!-- Property Energetic Class -->
                            <v-layout row wrap align-center>
                                <v-flex md12>
                                    <label>Diagnostic de performance énergétique (optionnel)</label>
                                    <v-layout row wrap align-center>
                                        <v-flex md4>
                                            <v-text-field
                                                single-line
                                                v-model="creatingAdvert.energetic_class_value"
                                                outline
                                                placeholder="0"
                                                color="#D81B60"
                                            ></v-text-field>
                                        </v-flex>
                                        <v-flex md8>
                                            <v-select
                                                single-line
                                                :items="energetic_class_items"
                                                v-model="creatingAdvert.energetic_class"
                                                outline
                                                color="#D81B60"
                                            ></v-select>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                            </v-layout>
                        </v-flex>
                    </v-layout>
                </v-card>
                <v-layout row wrap>
                    <v-flex md6 class="text-md-left">
                        <v-btn round flat @click.stop="creatingAdvert.e1 = 2">Retour</v-btn>
                    </v-flex>
                    <v-flex md6 class="text-md-right">
                        <v-btn
                            v-if="creatingAdvert.type !== 'Recherche'"
                            round
                            color="#D81B60"
                            class="white--text"
                            @click.stop="creatingAdvert.e1 = 4"
                            :disabled="!(creatingAdvert.property_type
                                        && creatingAdvert.living_space
                                        && creatingAdvert.room
                                        && creatingAdvert.bedroom
                                        && creatingAdvert.description
                                        )"
                        >
                            Suivant
                        </v-btn>
                        <v-btn
                            v-else
                            round
                            color="#D81B60"
                            class="white--text"
                            @click.stop="creatingAdvert.e1 = 4"

                        >
                            Suivant
                        </v-btn>
                    </v-flex>
                </v-layout>
            </v-stepper-content>
            <v-stepper-content v-else step="3">
                <v-card
                    class="mb-5 pb-5"
                >
                    <v-card-title primary-title class="justify-center">
                        <h3 v-if="type === 'Vente' || type === 'Location'">Le montant de votre bien</h3>
                        <h3 v-else-if="type === 'Recherche'">Votre budget</h3>
                    </v-card-title>
                    <v-layout
                        v-if="type === 'Vente' || type === 'Location'"
                        justify-center
                        row
                        wrap
                    >
                        <v-flex xs12 sm8 md8>
                            <label>Loyer mensuel charges comprises</label>
                            <v-text-field
                                single-line
                                v-model="creatingAdvert.rent_price"
                                outline
                                append-icon="euro_symbol"
                                placeholder="0"
                                color="#D81B60"
                                :rules="[rules.required]"
                            ></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm8 md8>
                            <label>Garantie demandée</label>
                            <v-text-field
                                single-line
                                v-model="creatingAdvert.guarantee"
                                outline
                                append-icon="euro_symbol"
                                placeholder="0"
                                color="#D81B60"
                                :rules="[rules.required]"
                            ></v-text-field>
                        </v-flex>
                    </v-layout>
                    <v-layout
                        v-else-if="type === 'Recherche'"
                        justify-center
                        row
                        wrap
                    >
                        <v-flex xs12 sm4 md4>
                            <label>Minimum</label>
                            <v-text-field
                                single-line
                                v-model="creatingAdvert.price_min"
                                outline
                                append-icon="euro_symbol"
                                placeholder="0"
                                color="#D81B60"
                                :rules="[rules.required]"
                            ></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm4 md4>
                            <label>Maximum</label>
                            <v-text-field
                                single-line
                                v-model="creatingAdvert.price_max"
                                outline
                                append-icon="euro_symbol"
                                placeholder="0"
                                color="#D81B60"
                                :rules="[rules.required]"
                            ></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-card>
                <v-layout row wrap>
                    <v-flex md6 class="text-md-left">
                        <v-btn round flat @click.stop="creatingAdvert.e1 = 2">Retour</v-btn>
                    </v-flex>
                    <v-flex md6 class="text-md-right">
                        <v-btn
                            round
                            color="#D81B60"
                            class="white--text"
                            @click.stop="creatingAdvert.e1 = 4"
                            :disabled="!(creatingAdvert.rent_price
                                        && creatingAdvert.guarantee
                                        )"
                        >
                            Suivant
                        </v-btn>
                    </v-flex>
                </v-layout>
            </v-stepper-content>

            <!-- STEP 4 : ADVERT -->
            <v-stepper-content v-if="type === 'Recherche'" step="4">
                <v-card
                    class="mb-5 pb-5"
                >
                    <v-card-title primary-title class="justify-center">
                        <h3 v-if="type === 'Vente' || type === 'Location'">Le montant de votre bien</h3>
                        <h3 v-else-if="type === 'Recherche'">Votre budget</h3>
                    </v-card-title>
                    <v-layout
                        v-if="type === 'Vente' || type === 'Location'"
                        justify-center
                        row
                        wrap
                    >
                        <v-flex xs12 sm8 md8>
                            <label>Loyer mensuel charges comprises</label>
                            <v-text-field
                                single-line
                                v-model="creatingAdvert.rent_price"
                                outline
                                append-icon="euro_symbol"
                                placeholder="0"
                                color="#D81B60"
                                :rules="[rules.required]"
                            ></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm8 md8>
                            <label>Garantie demandée</label>
                            <v-text-field
                                single-line
                                v-model="creatingAdvert.guarantee"
                                outline
                                append-icon="euro_symbol"
                                placeholder="0"
                                color="#D81B60"
                                :rules="[rules.required]"
                            ></v-text-field>
                        </v-flex>
                    </v-layout>
                    <v-layout
                        v-else-if="type === 'Recherche'"
                        justify-center
                        row
                        wrap
                    >
                        <v-flex xs12 sm4 md4>
                            <label>Minimum</label>
                            <v-text-field
                                single-line
                                v-model="creatingAdvert.price_min"
                                outline
                                append-icon="euro_symbol"
                                placeholder="0"
                                color="#D81B60"
                                :rules="[rules.required]"
                            ></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm4 md4>
                            <label>Maximum</label>
                            <v-text-field
                                single-line
                                v-model="creatingAdvert.price_max"
                                outline
                                append-icon="euro_symbol"
                                placeholder="0"
                                color="#D81B60"
                                :rules="[rules.required]"
                            ></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-card>
                <v-layout row wrap>
                    <v-flex md6 class="text-md-left">
                        <v-btn round flat @click.stop="creatingAdvert.e1 = 3">Retour</v-btn>
                    </v-flex>
                    <v-flex md6 class="text-md-right">
                        <v-btn
                            v-if="creatingAdvert.type !== 'Recherche'"
                            round
                            color="#D81B60"
                            class="white--text"
                            @click.stop="creatingAdvert.e1 = 5"
                            :disabled="!(creatingAdvert.rent_price
                                        && creatingAdvert.guarantee
                                        )"
                        >
                            Suivant
                        </v-btn>
                        <v-btn
                            v-else
                            round
                            color="#D81B60"
                            class="white--text"
                            @click.stop="creatingAdvert.e1 = 5"
                            :disabled="!(creatingAdvert.price_min
                                        && creatingAdvert.price_max
                                        )"
                        >
                            Suivant
                        </v-btn>
                    </v-flex>
                </v-layout>
            </v-stepper-content>
            <v-stepper-content v-if="type !== 'Recherche'" step="4">
                <v-card
                    class="mb-5 pb-5"
                >
                    <v-card-title primary-title class="justify-center">
                        <h3>Les photos de votre bien</h3>
                    </v-card-title>
                    <v-layout justify-center row wrap>
                        <v-flex xs12 sm8 md8>
                            <v-container>
                                <v-flex md12 class="filezone">
                                    <input type="file" id="files" ref="files" multiple v-on:change="handleFiles($event)" :rules="[rules.required]"/>
                                    <p>
                                        Drop your files here <br>or click to search
                                    </p>
                                </v-flex>

                                <div v-for="(file, key) in creatingAdvert.images" class="file-listing">
                                    <img class="preview" :src="file.url" v-bind:ref="'preview'+parseInt(key)"/>
                                    {{ file.name }}
                                    <div class="success-container" v-if="file.id > 0">
                                        Success
                                    </div>
                                    <div class="remove-container" v-else>
                                        <a class="remove" v-on:click.stop="removeFile(key)">Remove</a>
                                    </div>
                                </div>
                            </v-container>
                        </v-flex>
                    </v-layout>
                </v-card>
                <v-layout row wrap>
                    <v-flex md6 class="text-md-left">
                        <v-btn round flat @click.stop="creatingAdvert.e1 = 3">Retour</v-btn>
                    </v-flex>
                    <v-flex md6 class="text-md-right">
                        <v-btn
                            round
                            color="#D81B60"
                            class="white--text"
                            @click.stop="creatingAdvert.e1 = 5"
                            :disabled="creatingAdvert.images.length === 0"
                        >
                            Suivant
                        </v-btn>
                    </v-flex>
                </v-layout>
            </v-stepper-content>

            <v-stepper-content
                v-if="user === false && createAccount === 'false' && type !== 'Recherche'"
                step="5">
                <v-card
                    class="mb-5 pb-5"
                >
                    <v-card-title primary-title class="justify-center">
                        <h3>Connectez-vous sur Galileo</h3>
                    </v-card-title>
                    <v-layout justify-center row wrap>
                        <v-flex xs12 md6>
                            <v-text-field
                                outline
                                single-line
                                color="#42DCA3"
                                v-model="email"
                                label="Email*"
                                required></v-text-field>
                            <v-text-field
                                outline
                                single-line
                                color="#42DCA3"
                                v-on:keyup.enter="login"
                                v-model="password"
                                label="Password*"
                                type="password"
                                required></v-text-field>
                            <p><a @click="forgotForm"> <v-icon v-if="hover" color="#42DCA3" small light>keyboard_arrow_right</v-icon> <span @mouseover="hover = true" @mouseleave="hover = false">Mot de passe oublié ?</span> </a></p>
                        </v-flex>
                        <v-flex md12>
                            <v-container class="text-md-center">
                                <p>Vous n'avez pas encore de compte ?</p>
                                <v-btn color="#D81B60" outline round dark class="btn-box-shadow-secondary" @click.stop="createAccount = 'true'">Créer un compte</v-btn>
                            </v-container>
                        </v-flex>
                    </v-layout>
                </v-card>
                <v-layout row wrap>
                    <v-flex md6 class="text-md-left">
                        <v-btn round flat @click.stop="creatingAdvert.e1 = 4">Retour</v-btn>
                    </v-flex>
                    <v-flex md6 class="text-md-right">
                        <v-btn
                            dark
                            round
                            color="#D81B60"
                            @click.stop="login"
                        >
                            Me connecter
                        </v-btn>
                    </v-flex>
                </v-layout>
            </v-stepper-content>
            <v-stepper-content
                v-else-if="user === false && createAccount === 'true' && type !== 'Recherche'"
                step="5">
                <v-card
                    class="mb-5 pb-5"
                >
                    <v-card-title primary-title class="justify-center">
                        <h3>Inscrivez-vous sur Galileo</h3>
                    </v-card-title>
                        <v-layout row justify-center>
                            <v-flex xs12 md8>

                                <v-radio-group v-model="creatingUser.genre" row>
                                    <v-radio color="#42DCA3" label="Mademoiselle" value="mademoiselle"></v-radio>
                                    <v-radio color="#42DCA3" label="Madame" value="madame"></v-radio>
                                    <v-radio color="#42DCA3" label="Monsieur" value="monsieur"></v-radio>
                                </v-radio-group>
                            </v-flex>
                        </v-layout>
                        <v-layout row justify-center>
                            <v-flex xs12 md8>
                                <v-text-field outline single-line color="#42DCA3" v-model="creatingUser.username" label="Nom d'utilisateur*" :rules="[rules.username]" required></v-text-field>
                            </v-flex>
                        </v-layout>
                        <v-layout row justify-center>
                            <v-flex xs12 md4>
                                <v-text-field outline single-line color="#42DCA3" v-model="creatingUser.firstname" label="First name*" :rules="[rules.firstname]" required></v-text-field>
                            </v-flex>

                            <v-flex xs12 md4>
                                <v-text-field outline single-line color="#42DCA3" v-model="creatingUser.lastname" label="Last name*" :rules="[rules.lastname]" required></v-text-field>
                            </v-flex>
                        </v-layout>
                        <v-layout row justify-center>
                            <v-flex xs12 md4>
                                <v-text-field outline single-line color="#42DCA3" v-model="creatingUser.email" label="Email*" :rules="[rules.required, rules.email]" required></v-text-field>
                            </v-flex>
                            <v-flex xs12 md4>
                                <v-text-field outline single-line color="#42DCA3" v-model="creatingUser.phone" label="Phone*" :rules="[rules.phone]" required></v-text-field>
                            </v-flex>
                        </v-layout>
                        <v-layout row justify-center>
                            <v-flex xs12 md8>
                                <v-text-field outline single-line color="#42DCA3" v-model="creatingUser.address" label="Adresse*" :rules="[rules.address]" required></v-text-field>
                            </v-flex>
                        </v-layout>
                        <v-layout row justify-center>
                            <v-flex xs12 md4>
                                <v-text-field outline single-line color="#42DCA3" v-model="creatingUser.zipcode" label="Code postal*" :rules="[rules.zipcode]" required></v-text-field>
                            </v-flex>
                            <v-flex xs12 md4>
                                <v-text-field outline single-line color="#42DCA3" v-model="creatingUser.city" label="Ville*" :rules="[rules.city]" required></v-text-field>
                            </v-flex>
                        </v-layout>
                        <v-layout row justify-center>
                            <v-flex xs12 md4>
                                <v-text-field
                                    outline single-line
                                    color="#42DCA3"
                                    v-model="creatingUser.password"
                                    :append-icon="showPassword ? 'visibility_off' : 'visibility'"
                                    :rules="[rules.required, rules.min]"
                                    :type="showPassword ? 'text' : 'password'"
                                    name="password"
                                    label="Password*"
                                    hint="Au moins 6 caractères"
                                    counter
                                    @click:append="showPassword = !showPassword"
                                ></v-text-field>
                            </v-flex>
                            <v-flex xs12 md4>
                                <v-text-field
                                    outline single-line
                                    color="#42DCA3"
                                    v-on:keyup.enter="validateParticular"
                                    v-model="creatingUser.password_confirmation"
                                    :append-icon="showPassword ? 'visibility_off' : 'visibility'"
                                    :rules="[rules.required, rules.min]"
                                    :type="showPassword ? 'text' : 'password'"
                                    name="password_confirmation"
                                    label="Password*"
                                    hint="Au moins 6 caractères"
                                    counter
                                    @click:append="showPassword = !showPassword"
                                ></v-text-field>
                            </v-flex>
                        </v-layout>
                        <v-layout row justify-center>
                            <v-flex md8>
                                <small>*indicates required field</small>
                            </v-flex>
                        </v-layout>
                </v-card>
                <v-layout row wrap>
                    <v-flex md6 class="text-md-left">
                        <v-btn round flat @click.stop="createAccount = 'false'">Retour</v-btn>
                    </v-flex>
                    <v-flex md6 class="text-md-right">
                        <v-btn
                            dark
                            round
                            color="#D81B60"
                            @click.stop="registerParticular"
                        >
                            Créer mon compte
                        </v-btn>
                    </v-flex>
                </v-layout>
            </v-stepper-content>
            <v-stepper-content v-else-if="user !== false && type !== 'Recherche'" step="5">
                <v-card
                    class="mb-5 pb-5"
                >
                    <v-card-title primary-title class="justify-center">
                        <h3>Récapitulatif de votre annonce</h3>
                    </v-card-title>
                    <v-layout justify-center row wrap>
                        <v-flex md9>
                            <v-card>
                                <v-layout row wrap>
                                    <v-flex md5 pa-0 pt-0 pb-0>
                                        <v-img
                                            v-for="(image, index) in creatingAdvert.images"
                                            v-bind:key="index"
                                            v-if="index === 0"
                                            :src="image.url">
                                        </v-img>
                                    </v-flex>
                                    <v-flex md7 style="position: relative;">
                                        <!--<favorites-properties
                                            class="btn-favorite"
                                            :property="location.id"
                                            :favorited="favoriteProperty(location.favorites)"
                                        ></favorites-properties>-->
                                        <v-card-title class="pt-1 pb-0">
                                            <v-layout row wrap>
                                                <v-flex md8>
                                                    <h3 class="title">{{ creatingAdvert.property_type }}</h3>
                                                    <v-chip small>{{ creatingAdvert.living_space }}m²</v-chip>
                                                    <v-chip small>{{ creatingAdvert.typology }}</v-chip>
                                                    <v-chip small>R+{{ creatingAdvert.floor }}</v-chip><br>
                                                    <span class="subheading secondary--text">{{ creatingAdvert.zipcode }}</span>
                                                </v-flex>
                                                <v-flex md4 class="text-md-right">
                                                    <span class="font-weight-bold title">{{ creatingAdvert.rent_price }}€/mois</span>
                                                    <img src="https://v.seloger.com/s/width/150/logos/1/s/z/l/1szl5iaqv57vz2bp8oobbohm9jn0kx0fda5wkl8fo.jpg" alt="FLATLOOKER" height="30px">
                                                </v-flex>
                                            </v-layout>
                                        </v-card-title>
                                        <v-card-text class="pt-0 pb-1">
                                            <v-layout row wrap>
                                                <v-flex md12>
                                                    <p>{{ creatingAdvert.description }}</p>
                                                </v-flex>
                                            </v-layout>

                                        </v-card-text>
                                        <v-card-actions class="">
                                            <v-spacer></v-spacer>
                                            <v-btn
                                                dark
                                                color="orange"
                                                round
                                                small
                                            >
                                                <v-icon small>call</v-icon>
                                                <span class="text-none">Afficher le numéro</span>
                                            </v-btn>
                                            <v-btn
                                                dark
                                                color="blue"
                                                round
                                                small
                                            >
                                                <v-icon small>email</v-icon>
                                                <span class="text-none">Envoyez un message</span>
                                            </v-btn>
                                        </v-card-actions>
                                    </v-flex>
                                </v-layout>

                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-card>
                <v-layout row wrap>
                    <v-flex md6 class="text-md-left">
                        <v-btn round flat @click.stop="creatingAdvert.e1 = 4">Retour</v-btn>
                    </v-flex>
                    <v-flex md6 class="text-md-right">
                        <v-btn
                            dark
                            round
                            color="#D81B60"
                            @click.stop="saveAdvert"
                        >
                            Publier mon annonce de location
                        </v-btn>
                    </v-flex>
                </v-layout>
            </v-stepper-content>

            <v-stepper-content
                v-if="user === false && createAccount === 'false' && type === 'Recherche'"
                step="5">
                <v-card
                    class="mb-5 pb-5"
                >
                    <v-card-title primary-title class="justify-center">
                        <h3>Connectez-vous sur Galileo</h3>
                    </v-card-title>
                    <v-layout justify-center row wrap>
                        <v-flex xs12 md6>
                            <v-text-field
                                outline
                                single-line
                                color="#42DCA3"
                                v-model="email"
                                label="Email*"
                                required></v-text-field>
                            <v-text-field
                                outline
                                single-line
                                color="#42DCA3"
                                v-on:keyup.enter="login"
                                v-model="password"
                                label="Password*"
                                type="password"
                                required></v-text-field>
                            <p><a @click="forgotForm"> <v-icon v-if="hover" color="#42DCA3" small light>keyboard_arrow_right</v-icon> <span @mouseover="hover = true" @mouseleave="hover = false">Mot de passe oublié ?</span> </a></p>
                        </v-flex>
                        <v-flex md12>
                            <v-container class="text-md-center">
                                <p>Vous n'avez pas encore de compte ?</p>
                                <v-btn color="#D81B60" outline round dark class="btn-box-shadow-secondary" @click.stop="createAccount = 'true'">Créer un compte</v-btn>
                            </v-container>
                        </v-flex>
                    </v-layout>
                </v-card>
                <v-layout row wrap>
                    <v-flex md6 class="text-md-left">
                        <v-btn round flat @click.stop="creatingAdvert.e1 = 3">Retour</v-btn>
                    </v-flex>
                    <v-flex md6 class="text-md-right">
                        <v-btn
                            dark
                            round
                            color="#D81B60"
                            @click.stop="login"
                        >
                            Me connecter
                        </v-btn>
                    </v-flex>
                </v-layout>
            </v-stepper-content>
            <v-stepper-content
                v-else-if="user === false && createAccount === 'true' && type === 'Recherche'"
                step="5">
                <v-card
                    class="mb-5 pb-5"
                >
                    <v-card-title primary-title class="justify-center">
                        <h3>Inscrivez-vous sur Galileo</h3>
                    </v-card-title>
                        <v-layout row justify-center>
                            <v-flex xs12 md8>

                                <v-radio-group v-model="creatingUser.genre" row>
                                    <v-radio color="#42DCA3" label="Mademoiselle" value="mademoiselle"></v-radio>
                                    <v-radio color="#42DCA3" label="Madame" value="madame"></v-radio>
                                    <v-radio color="#42DCA3" label="Monsieur" value="monsieur"></v-radio>
                                </v-radio-group>
                            </v-flex>
                        </v-layout>
                        <v-layout row justify-center>
                            <v-flex xs12 md8>
                                <v-text-field outline single-line color="#42DCA3" v-model="creatingUser.username" label="Nom d'utilisateur*" :rules="[rules.username]" required></v-text-field>
                            </v-flex>
                        </v-layout>
                        <v-layout row justify-center>
                            <v-flex xs12 md4>
                                <v-text-field outline single-line color="#42DCA3" v-model="creatingUser.firstname" label="First name*" :rules="[rules.firstname]" required></v-text-field>
                            </v-flex>

                            <v-flex xs12 md4>
                                <v-text-field outline single-line color="#42DCA3" v-model="creatingUser.lastname" label="Last name*" :rules="[rules.lastname]" required></v-text-field>
                            </v-flex>
                        </v-layout>
                        <v-layout row justify-center>
                            <v-flex xs12 md4>
                                <v-text-field outline single-line color="#42DCA3" v-model="creatingUser.email" label="Email*" :rules="[rules.required, rules.email]" required></v-text-field>
                            </v-flex>
                            <v-flex xs12 md4>
                                <v-text-field outline single-line color="#42DCA3" v-model="creatingUser.phone" label="Phone*" :rules="[rules.phone]" required></v-text-field>
                            </v-flex>
                        </v-layout>
                        <v-layout row justify-center>
                            <v-flex xs12 md8>
                                <v-text-field outline single-line color="#42DCA3" v-model="creatingUser.address" label="Adresse*" :rules="[rules.address]" required></v-text-field>
                            </v-flex>
                        </v-layout>
                        <v-layout row justify-center>
                            <v-flex xs12 md4>
                                <v-text-field outline single-line color="#42DCA3" v-model="creatingUser.zipcode" label="Code postal*" :rules="[rules.zipcode]" required></v-text-field>
                            </v-flex>
                            <v-flex xs12 md4>
                                <v-text-field outline single-line color="#42DCA3" v-model="creatingUser.city" label="Ville*" :rules="[rules.city]" required></v-text-field>
                            </v-flex>
                        </v-layout>
                        <v-layout row justify-center>
                            <v-flex xs12 md4>
                                <v-text-field
                                    outline single-line
                                    color="#42DCA3"
                                    v-model="creatingUser.password"
                                    :append-icon="showPassword ? 'visibility_off' : 'visibility'"
                                    :rules="[rules.required, rules.min]"
                                    :type="showPassword ? 'text' : 'password'"
                                    name="password"
                                    label="Password*"
                                    hint="Au moins 6 caractères"
                                    counter
                                    @click:append="showPassword = !showPassword"
                                ></v-text-field>
                            </v-flex>
                            <v-flex xs12 md4>
                                <v-text-field
                                    outline single-line
                                    color="#42DCA3"
                                    v-on:keyup.enter="validateParticular"
                                    v-model="creatingUser.password_confirmation"
                                    :append-icon="showPassword ? 'visibility_off' : 'visibility'"
                                    :rules="[rules.required, rules.min]"
                                    :type="showPassword ? 'text' : 'password'"
                                    name="password_confirmation"
                                    label="Password*"
                                    hint="Au moins 6 caractères"
                                    counter
                                    @click:append="showPassword = !showPassword"
                                ></v-text-field>
                            </v-flex>
                        </v-layout>
                        <v-layout row justify-center>
                            <v-flex md8>
                                <small>*indicates required field</small>
                            </v-flex>
                        </v-layout>
                </v-card>
                <v-layout row wrap>
                    <v-flex md6 class="text-md-left">
                        <v-btn round flat @click.stop="creatingAdvert.e1 = 3">Retour</v-btn>
                    </v-flex>
                    <v-flex md6 class="text-md-right">
                        <v-btn
                            dark
                            round
                            color="#D81B60"
                            @click.stop="registerParticular"
                        >
                            Créer mon compte
                        </v-btn>
                    </v-flex>
                </v-layout>
            </v-stepper-content>
            <v-stepper-content v-else-if="user !== false && type === 'Recherche'" step="5">
                <v-card
                    class="mb-5 pb-5"
                >
                    <v-card-title primary-title class="justify-center">
                        <h3>Récapitulatif de votre annonce</h3>
                    </v-card-title>
                    <v-layout justify-center row wrap>
                        <v-flex md9>
                            <v-card>
                                <v-layout align-center row wrap pl-1>
                                    <v-flex
                                        md2
                                        pa-0
                                        pt-0
                                        pb-0
                                        class="text-md-center"
                                    >
                                        <v-card
                                            v-if="creatingAdvert.advert_type === 'Location'"
                                            flat
                                            height="100%"
                                            color="rgba(216, 27, 96, 0.6)"
                                            class="pa-4"
                                        >
                                            <v-avatar
                                                size="80px"
                                                color="rgba(216, 27, 96)"
                                                style="border-radius: 100px;"
                                                class="border-white"
                                            >
                                <span class="white--text font-weight-bold">
                                    {{ creatingAdvert.advert_type }}
                                </span>
                                            </v-avatar>
                                        </v-card>
                                        <v-card
                                            v-else-if="creatingAdvert.advert_type === 'Achat'"
                                            flat
                                            height="100%"
                                            color="rgba(0, 224, 148, 0.6)"
                                            class="pa-4"
                                        >
                                            <v-avatar
                                                size="80px"
                                                color="rgba(0, 224, 148)"
                                                style="border-radius: 100px;"
                                                class="border-white"
                                            >
                                <span class="white--text font-weight-bold">
                                    {{ creatingAdvert.advert_type }}
                                </span>
                                            </v-avatar>
                                        </v-card>
                                    </v-flex>
                                    <v-flex md7 style="position: relative;">
                                        <!--<favorites-properties
                                            class="btn-favorite"
                                            :property="location.id"
                                            :favorited="favoriteProperty(location.favorites)"
                                        ></favorites-properties>-->
                                        <v-card-title class="pt-1 pb-0">
                                            <v-layout row wrap>
                                                <v-flex md12>
                                                    <h3 v-if="creatingAdvert.city" class="subheading">Rercherche {{ creatingAdvert.property_type }} sur {{ creatingAdvert.city.name }}</h3>
                                                    <p>
                                                        <img
                                                            v-if="creatingAdvert.property_type === 'Appartement'"
                                                            class="icon-buyer-features"
                                                            src="/img/icons/BUILDING1.png"
                                                            width="25px" />
                                                        <img
                                                            v-if="creatingAdvert.property_type === 'Maison'"
                                                            class="icon-buyer-features"
                                                            src="/img/icons/HOUSE1.png"
                                                            width="25px" />
                                                        <img
                                                            v-if="creatingAdvert.property_type === 'Terrain'"
                                                            class="icon-buyer-features"
                                                            src="/img/icons/PARK1.png"
                                                            width="25px" />
                                                        <img
                                                            v-if="creatingAdvert.property_type === 'Parking'"
                                                            class="icon-buyer-features"
                                                            src="/img/icons/PARKING1.png"
                                                            width="25px" />
                                                        1 {{ creatingAdvert.property_type }} de {{ creatingAdvert.living_space_max }}m² ou plus
                                                    </p>
                                                </v-flex>
                                            </v-layout>
                                        </v-card-title>
                                        <v-card-text class="pt-0 pb-0">
                                            <v-layout row wrap>
                                                <v-flex v-if="creatingAdvert.room" md1>
                                                    <img src="/img/icons/ROOM.png" width="20px" />
                                                    <v-spacer></v-spacer>
                                                    <span class="pl-1 text-md-center font-weight-bold">{{ creatingAdvert.room }}</span>
                                                </v-flex>
                                                <v-flex v-if="creatingAdvert.bedroom" md1>
                                                    <img src="/img/icons/BEDROOM.png" width="20px" />
                                                    <v-spacer></v-spacer>
                                                    <span class="pl-1 font-weight-bold">{{ creatingAdvert.bedroom }}</span>
                                                </v-flex>
                                                <v-flex v-if="creatingAdvert.bathroom" md1>
                                                    <img src="/img/icons/BATHROOM_2.png" width="20px" />
                                                    <v-spacer></v-spacer>
                                                    <span class="pl-1 font-weight-bold">{{ creatingAdvert.bathroom }}</span>
                                                </v-flex>
                                            </v-layout>
                                        </v-card-text>
                                    </v-flex>
                                    <v-flex md3 class="text-md-center">
                                        <v-card-actions class="">
                                            <v-btn
                                                dark
                                                color="#2196F3"
                                                round
                                                small
                                            >
                                                <v-icon small>call</v-icon>
                                                <span class="text-none">Afficher le numéro</span>
                                            </v-btn>
                                        </v-card-actions>
                                        <v-card-actions class="">
                                            <v-btn
                                                dark
                                                color="#2196F3"
                                                round
                                                small
                                            >
                                                <v-icon small>email</v-icon>
                                                <span class="text-none">Envoyez un message</span>
                                            </v-btn>
                                        </v-card-actions>
                                    </v-flex>
                                </v-layout>

                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-card>
                <v-layout row wrap>
                    <v-flex md6 class="text-md-left">
                        <v-btn round flat @click.stop="creatingAdvert.e1 = 4">Retour</v-btn>
                    </v-flex>
                    <v-flex md6 class="text-md-right">
                        <v-btn
                            dark
                            round
                            color="#D81B60"
                            @click.stop="saveAdvert"
                        >
                            Publier mon annonce de recherche
                        </v-btn>
                    </v-flex>
                </v-layout>
            </v-stepper-content>

        </v-stepper-items>
    </v-stepper>
</template>

<script>

export default {
  name: "AddLocationForm",
    props: ['type', 'user_type', 'propertiestype'],
    data () {
        return {
            test: [],
            validProfessional: true,
            showPassword: false,
            active: 0,
            createAccount: 'false',
            hover: false,
            showPassword: false,
            email: '',
            password: '',
            selectedfeatures: [],
            e1: 0,
            address: '',
            zipcode: '',
            column: true,
            property_type: 'Appartement',
            living_space: '',
            room: '',
            bedroom: '',
            menu2: false,
            date: new Date().toISOString().substr(0, 10),
            dateFormatted: this.formatDate(new Date().toISOString().substr(0, 10)),
            property_features: [],
            features: [],
            description: '',
            energetic_class_value: '',
            energetic_class: '',
            energetic_class_items: [
                'Non renseigné',
                'A - inférieur à 50',
                'B - de 51 à 90',
                'C - de 91 à 150',
                'D - de 151 à 230',
                'E - de 231 à 330',
                'F - de 331 à 450',
                'G - plus de 450',
            ],
            rent_price: '',
            guarantee: '',
            testfile: null,
            files: [],
            images: [],
            rules: {
                min: value => value.length >= 6 || '6 caractères minimum',
                required: value => !!value || 'Required.',
                counter: value => value.length >= 20 || 'La description doit contenir au moins 20 caractères',
                email: value => {
                    const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                    return pattern.test(value) || 'Invalid e-mail.'
                }
            }
        }
    },
    mounted() {
        this.$store.dispatch('adverts/loadPropertyTypes');
        this.$store.dispatch('adverts/loadAdvertTypes');
        this.$store.dispatch('user/loadUser');
        if (localStorage.getItem('creatingAdvert')) this.$store.state.adverts.creatingAdvert = JSON.parse(localStorage.getItem('creatingAdvert'));

    },
    computed: {
        computedDateFormatted() {
            return this.formatDate(this.date);
        },
        creatingAdvert() {
            return this.$store.state.adverts.creatingAdvert;
        },
        cities() {
            return this.$store.state.adverts.cities;
        },
        property_types() {
            return this.$store.state.adverts.property_types;
        },
        advert_types() {
            return this.$store.state.adverts.advert_types;
        },
        user() {
            return this.$store.state.user.user;
        },
        creatingUser() {
            return this.$store.state.user.creatingUser;
        },
    },
    watch: {
        creatingAdvert: {
            handler() {
                console.log('creatingAdvert changed!');
                this.creatingAdvert.type = this.type;
                console.log(this.creatingAdvert);
                if(this.creatingAdvert.energetic_class_value <= 50){
                    this.creatingAdvert.energetic_class = 'A - inférieur à 50';
                }

                if(this.creatingAdvert.energetic_class_value > 50 && this.creatingAdvert.energetic_class_value <= 90){
                    this.creatingAdvert.energetic_class = 'B - de 51 à 90';
                }

                if(this.creatingAdvert.energetic_class_value > 50 && this.creatingAdvert.energetic_class_value <= 90){
                    this.creatingAdvert.energetic_class = 'B - de 51 à 90';
                }

                if(this.creatingAdvert.energetic_class_value > 90 && this.creatingAdvert.energetic_class_value <= 150){
                    this.creatingAdvert.energetic_class = 'C - de 91 à 150';
                }

                if(this.creatingAdvert.energetic_class_value > 150 && this.creatingAdvert.energetic_class_value <= 230){
                    this.creatingAdvert.energetic_class = 'D - de 151 à 230';
                }

                if(this.creatingAdvert.energetic_class_value > 230 && this.creatingAdvert.energetic_class_value <= 330){
                    this.creatingAdvert.energetic_class = 'E - de 231 à 330';
                }

                if(this.creatingAdvert.energetic_class_value > 330 && this.creatingAdvert.energetic_class_value <= 450){
                    this.creatingAdvert.energetic_class = 'F - de 331 à 450';
                }

                if(this.creatingAdvert.energetic_class_value > 450){
                    this.creatingAdvert.energetic_class = 'G - plus de 450';
                }
                localStorage.setItem('creatingAdvert', JSON.stringify(this.creatingAdvert));
            },
            deep: true,
        },
        date(val) {
            this.dateFormatted = this.formatDate(this.date);
        },
    },
    methods: {
        getCities() {
            //this.$store.dispatch('adverts/loadCities');
            axios.get('https://geo.api.gouv.fr/communes?codePostal=' + this.creatingAdvert.city).then(function (response) {
                console.log('by zipcode');
                this.test = [];
                var value = response.data;
                if(value){
                    for(var i = 0; i < value.length; i++){
                        this.test.push({
                            code: value[i]['code'],
                            code_departement: value[i]['codeDepartement'],
                            code_region: value[i]['codeRegion'],
                            codes_postaux: value[i]['codesPostaux'],
                            value: value[i]['nom'],
                            name: value[i]['nom'] + ' ' + value[i]['codesPostaux'][0],
                            population: value[i]['population'],
                        });
                    }
                }

            }.bind(this)).catch(function (data) {
                console.log(data);
                console.log('error');
            });
            axios.get('https://geo.api.gouv.fr/communes?nom=' + this.creatingAdvert.city).then(function (response) {
                console.log('by commune');
                this.test = [];
                var value = response.data;
                if(value){
                    for(var i = 0; i < value.length; i++){
                        this.test.push({
                            code: value[i]['code'],
                            value: value[i]['nom'],
                            name: value[i]['nom'] + ' ' + value[i]['codesPostaux'][0],
                        });
                    }
                }
            }.bind(this)).catch(function (data) {
                console.log(data);
                console.log('error');
            });

        },
        login() {
            console.log('test login');
            console.log(this.email);
            console.log(this.password);
            axios.post('/login', {
                email: this.email,
                password: this.password
            }).then((response) => {

                this.email = '';
                this.password = '';

                //this.user = true;
                this.users = response.data;
                //this.loginModal = false;

                this.loginModal = false;
                var current = window.location.href;
                document.location.href = current;
                console.log(this.user);

            }).catch(error => {
                console.log(error.response);
                console.log(error.response.data.errors);
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                    console.log(this.errors);
                }
            });
        },
        registerParticular() {
            //this.validateProfessional();
            var _this = this;
            console.log(_this.creatingUser);
            axios.post('/register', _this.creatingUser).then(response => {

                console.log(response);
                var current = window.location.href;
                document.location.href = current;
            }).catch(error => {
                console.log(_this.creatingUser);
                console.log('POST /register => error');
                var errors = error.response;
                console.log(errors);
            });
        },
        registerForm() {
            window.location.href = '/register';
        },
        forgotForm() {
            window.location.href = '/password/reset';
        },
        formatDate (date) {
            if (!date) return null;
            const [year, month, day] = date.split('-');
            return `${day}/${month}/${year}`;
        },
        addRoom() {
            this.creatingAdvert.room++;
        },
        removeRoom() {
            if(this.creatingAdvert.room > 0){
                this.creatingAdvert.room--;
            }
        },
        addBedroom() {
            this.creatingAdvert.bedroom++;
        },
        removeBedroom() {
            if(this.creatingAdvert.bedroom > 0){
                this.creatingAdvert.bedroom--;
            }
        },
        addBathroom() {
            this.creatingAdvert.bathroom++;
        },
        removeBathroom() {
            if(this.creatingAdvert.bathroom > 0){
                this.creatingAdvert.bathroom--;
            }
        },
        handleFiles(e) {
            let uploadedFiles = this.$refs.files.files;
            for(var i = 0; i < uploadedFiles.length; i++) {
                this.files.push(uploadedFiles[i]);
                this.$store.dispatch('adverts/addCreatingAdvertFile', uploadedFiles[i]);
            }
            document.getElementById("files").value = "";
            localStorage.setItem('creatingAdvert', JSON.stringify(this.creatingAdvert));
        },
        getImagePreviews(){
            for( let i = 0; i < this.creatingAdvert.images.length; i++ ){
                if ( /\.(jpe?g|png|gif)$/i.test( this.creatingAdvert.images[i].name ) ) {
                    let reader = new FileReader();
                    reader.addEventListener("load", function(){
                        this.$refs['preview'+parseInt(i)][0].src = reader.result;
                    }.bind(this), false);
                    reader.readAsDataURL( this.creatingAdvert.images[i] );
                }else{
                    this.$nextTick(function(){
                        this.$refs['preview'+parseInt(i)][0].src = '/img/generic.png';
                    });
                }
            }
        },
        removeFile( key ){
            this.files.splice( key, 1 );
            this.$store.dispatch('adverts/removeCreatingAdvertFile', key);
            localStorage.setItem('creatingAdvert', JSON.stringify(this.creatingAdvert));
        },
        saveAdvert(e) {
            console.log('submit advert');
            this.$store.dispatch('adverts/createAdvert', this.creatingAdvert);
            localStorage.removeItem('creatingAdvert');
            if(this.type === 'Location'){
                location.href = '/annonces/add/location/success';
            }else if(this.type === 'Recherche'){
                //location.href = '/annonces/add/recherche/success';
            }else if(this.types === 'Vente'){
                location.href = '/annonces/add/vente/success';
            }
            //
            /*e.preventDefault();
            console.log(e.preventDefault());


            var ad = {
                address: this.address,
                zipcode: this.zipcode,
                property_type: this.property_type,
                living_space: this.living_space,
                room: this.room,
                bedroom: this.bedroom,
                property_features: this.property_features,
                description: this.description,
                energetic_class_value: this.energetic_class_value,
                energetic_class: this.energetic_class,
                rent_price: this.rent_price,
                guarantee: this.guarantee,
                testfiles: this.files,
                testimages: '',
            };
            const formData = new FormData();
            formData.append('address', this.address);
            formData.append('zipcode', this.zipcode);
            formData.append('property_type', this.property_type);
            formData.append('living_space', this.living_space);
            formData.append('room', this.room);
            formData.append('bedroom', this.bedroom);
            formData.append('property_features', this.property_features);
            formData.append('description', this.description);
            formData.append('energetic_class_value', this.energetic_class_value);
            formData.append('energetic_class', this.energetic_class);
            formData.append('rent_price', this.rent_price);
            formData.append('guarantee', this.guarantee);
            formData.append('features', this.selectedfeatures);
            if(this.selectedfeatures){
                for (var i = 0; i < this.selectedfeatures.length; i++) {
                    // formData.append("Regions[" + i + "].Id", region[i])
                    formData.append("features[" + i + "]", this.selectedfeatures[i]);
                }
            }
            if(this.files){
                for (var i = 0; i < this.files.length; i++) {
                    // formData.append("Regions[" + i + "].Id", region[i])
                    formData.append("images[" + i + "]", this.files[i]);
                }
            }
            if(this.files){
                formData.append("files", this.files);
            }

            console.log('annonce');
            console.log(formData);*/

            /*axios.post('/annonces/add/location', formData).then(function (data) {
                console.log(data);
                console.log('success');
                location.href = '/annonces/add/location/success';
            }.bind(this)).catch(function (data) {
                console.log(data);
                console.log('error');
            });*/
        },
    },
};
</script>

<style scoped>
    #addAdvert,
    #addAdvert .v-stepper__header {
        background: transparent;
        box-shadow: none;
    }

    /* Extras */
    a:visited{color:#888}
    a{color:#444;text-decoration:none;}
    p{margin-bottom:.3em;}

    .property-type-input-element {
        display: none;
    }

    .property-feature-input-element {
        display: none;
    }

    label {
        width: 100%
    }

    #addAdvert .property-feature-input {
        margin: auto 0;
    }

    .property-type-input {
        border-radius: 5px;
        box-shadow: 0 0 1px 1px grey;
        padding: 10px;
        width:100%;height:130px;
        -webkit-transition: all 100ms ease-in;
        -moz-transition: all 100ms ease-in;
        transition: all 100ms ease-in;
        -webkit-filter: brightness(1.8) grayscale(1) opacity(.5);
        -moz-filter: brightness(1.8) grayscale(1) opacity(.5);
        filter: brightness(1) grayscale(1) opacity(.5);
    }

    .property-type-input:hover {
        cursor: pointer;
        box-shadow: 0 0 1px 1px #D81B60;
        -webkit-filter: brightness(1.2) grayscale(.5) opacity(.9);
        -moz-filter: brightness(1.2) grayscale(.5) opacity(.9);
        filter: brightness(1.2) grayscale(.5) opacity(.9);
    }

    .property-type-input-element:checked + .property-type-input {
        box-shadow: 0 0 1px 1px #D81B60;
        -webkit-filter: none;
        -moz-filter: none;
        filter: none;
    }

    .property-feature-input {
        border-radius: 5px;
        box-shadow: 0 0 1px 1px grey;
        padding: 10px;
        width:100%;height:100px;
        -webkit-transition: all 100ms ease-in;
        -moz-transition: all 100ms ease-in;
        transition: all 100ms ease-in;
        -webkit-filter: brightness(1.8) grayscale(1) opacity(.5);
        -moz-filter: brightness(1.8) grayscale(1) opacity(.5);
        filter: brightness(1) grayscale(1) opacity(.5);
    }

    .property-feature-input:hover {
        cursor: pointer;
        box-shadow: 0 0 1px 1px #D81B60;
        -webkit-filter: brightness(1.2) grayscale(.5) opacity(.9);
        -moz-filter: brightness(1.2) grayscale(.5) opacity(.9);
        filter: brightness(1.2) grayscale(.5) opacity(.9);
    }

    .property-feature-input-element:checked + .property-feature-input {
        box-shadow: 0 0 1px 1px #D81B60;
        -webkit-filter: none;
        -moz-filter: none;
        filter: none;
    }

    .theme--light.v-text-field--outline>.v-input__control>.v-input__slot {
        border: 1px solid #c7c7c7 !important;
    }

    .theme--light.v-text-field--outline:not(.v-input--is-focused):not(.v-input--has-state)>.v-input__control>.v-input__slot:hover {
        border: 1px solid #D81B60;
        -webkit-filter: brightness(1.2) grayscale(.5) opacity(.9);
        -moz-filter: brightness(1.2) grayscale(.5) opacity(.9);
        filter: brightness(1.2) grayscale(.5) opacity(.9);
    }

    .input-number input[type="text"] {
        text-align: center !important;
    }

    input[type="file"]{
        opacity: 0;
        width: 100%;
        height: 200px;
        position: absolute;
        cursor: pointer;
    }
    .filezone {
        outline: 2px dashed grey;
        outline-offset: -10px;
        background: #f8fafc;
        color: dimgray;
        padding: 10px 10px;
        min-height: 200px;
        position: relative;
        cursor: pointer;
    }
    .filezone:hover {
        background: #c0c0c0;
    }

    .filezone p {
        font-size: 1.2em;
        text-align: center;
        padding: 50px 50px 50px 50px;
    }
    div.file-listing img{
        max-width: 90%;
    }

    div.file-listing{
        margin: auto;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    div.file-listing img{
        height: 100px;
    }
    div.success-container{
        text-align: center;
        color: green;
    }

    div.remove-container{
        text-align: center;
    }

    div.remove-container a{
        color: red;
        cursor: pointer;
    }

    a.submit-button{
        display: block;
        margin: auto;
        text-align: center;
        width: 200px;
        padding: 10px;
        text-transform: uppercase;
        background-color: #CCC;
        color: white;
        font-weight: bold;
        margin-top: 20px;
    }

</style>
