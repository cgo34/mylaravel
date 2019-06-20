<template>
    <v-stepper id="addAdvert" class="advert-location" v-model="creatingLocation.e1">
        <v-layout justify-center row wrap>
            {{ creatingLocation }}
            <v-flex md10>
                <v-stepper-header>
                    <v-stepper-step color="#D81B60" :complete="e1 > 1" step="1">Localisation</v-stepper-step>
                    <v-divider></v-divider>
                    <v-stepper-step color="#D81B60" :complete="e1 > 2" step="2">Le bien</v-stepper-step>
                    <v-divider></v-divider>
                    <v-stepper-step color="#D81B60" :complete="e1 > 3" step="3">Montant</v-stepper-step>
                    <v-divider></v-divider>
                    <v-stepper-step color="#D81B60" :complete="e1 > 4" step="4">Photos</v-stepper-step>
                    <v-divider></v-divider>
                    <v-stepper-step color="#D81B60" step="5">Récapitulatif</v-stepper-step>
                </v-stepper-header>
            </v-flex>
        </v-layout>
        <p>test car j'en ai plein mon cul</p>
        <v-stepper-items>
            <v-stepper-content step="1">
                <v-card
                    class="mb-5 pb-5"
                >
                    <v-card-title primary-title class="justify-center">
                        <h3>Où est situé votre bien ?</h3>
                    </v-card-title>
                    <v-layout justify-center row wrap>
                        <v-flex xs12 sm8 md8>
                            <label>Adresse de votre bien</label>
                            <v-text-field
                                outline
                                single-line
                                v-model="creatingLocation.address"
                                :value="address"
                            ></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm8 md8>
                            <label>Commune ou code postal</label>
                            <v-text-field
                                outline
                                single-line
                                v-model="creatingLocation.zipcode"
                            ></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-card>
                <v-layout row wrap>
                    <v-flex md6 class="text-md-left">
                        <v-btn flat>Retour</v-btn>
                    </v-flex>
                    <v-flex md6 class="text-md-right">
                        <v-btn
                            href="#bien"
                            dark
                            round
                            color="#D81B60"
                            @click.stop="e1 = 2"
                        >
                            Suivant
                        </v-btn>
                    </v-flex>
                </v-layout>
            </v-stepper-content>

            <v-stepper-content step="2">
                <v-card
                    class="mb-5 pb-5"
                >
                    <v-card-title primary-title class="justify-center">
                        <h3>Décrivez votre bien </h3>
                    </v-card-title>
                    <v-layout justify-center row wrap>
                        <v-flex xs12 sm4 md6>
                            <!-- Property Type-->
                            <v-layout class="row wrap align-center">
                                <label>Type de bien</label>
                                <v-flex md6 class="text-md-right">

                                    <label class="text-md-center">
                                        <input @click.stop="setFeaturesPropertyType('Appartement')" type="radio" v-model="creatingLocation.property_type" name="property_type" value="Appartement" class="property-type-input-element" />

                                        <div class="panel panel-default property-type-input layout align-center justify-center">
                                            <div class="panel-heading">
                                                <img src="/img/icons/building.png" width="60px" />
                                                <v-spacer></v-spacer>
                                                <span class="font-weight-bold">Appartement</span>
                                            </div>
                                        </div>
                                    </label>

                                </v-flex>
                                <v-flex md6 class="text-md-left">

                                    <label class="text-md-center">
                                        <input @click.stop="setFeaturesPropertyType('Maison')" type="radio" v-model="creatingLocation.property_type" name="property_type" value="Maison" class="property-type-input-element" />

                                        <div class="panel panel-default property-type-input layout align-center justify-center">
                                            <div class="panel-heading">
                                                <img src="/img/icons/house.png" width="60px" />
                                            <v-spacer></v-spacer>
                                                <span class="font-weight-bold">Maison</span>
                                            </div>
                                        </div>
                                    </label>

                                </v-flex>
                                <v-flex md6 class="text-md-right">

                                    <label class="text-md-center">
                                        <input @click.stop="setFeaturesPropertyType('Terrain')" type="radio" v-model="creatingLocation.property_type" name="property_type" value="Terrain" class="property-type-input-element" />

                                        <div class="panel panel-default property-type-input layout align-center justify-center">
                                            <div class="panel-heading">
                                                <img src="/img/icons/terrain.png" width="60px" />
                                            <v-spacer></v-spacer>
                                                <span class="font-weight-bold">Terrain</span>
                                            </div>
                                        </div>
                                    </label>

                                </v-flex>
                                <v-flex md6 class="text-md-left">

                                    <label class="text-md-center">
                                        <input @click.stop="setFeaturesPropertyType('Parking')" type="radio" v-model="creatingLocation.property_type"  name="property_type" value="Parking" class="property-type-input-element" />

                                        <div class="panel panel-default property-type-input layout align-center justify-center">
                                            <div class="panel-heading">
                                                <img src="/img/icons/park.png" width="60px" />
                                            <v-spacer></v-spacer>
                                                <span class="font-weight-bold">Parking</span>
                                            </div>
                                        </div>
                                    </label>

                                </v-flex>
                            </v-layout>
                            <!-- Property Informations-->
                            <v-layout class="row wrap align-center">

                                <v-flex md4>
                                    <label>Surface</label>
                                    <v-text-field
                                        single-line
                                        v-model="creatingLocation.living_space"
                                        outline
                                        suffix="m²"
                                        placeholder="0"
                                        color="#D81B60"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex md4>
                                    <label>Pièces</label>
                                    <v-text-field
                                        class="input-number"
                                        single-line
                                        v-model="creatingLocation.room"
                                        outline
                                        placeholder="0"
                                        append-icon="add"
                                        prepend-inner-icon="remove"
                                        @click:append="addRoom"
                                        @click:prepend-inner="removeRoom"
                                        color="#D81B60"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex md4>
                                    <label>Chambres</label>
                                    <v-text-field
                                        single-line
                                        v-model="creatingLocation.bedroom"
                                        outline
                                        placeholder="0"
                                        append-icon="add"
                                        prepend-inner-icon="remove"
                                        @click:append="addBedroom"
                                        @click:prepend-inner="removeBedroom"
                                        color="#D81B60"
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
                                                v-model="creatingLocation.dateFormatted"
                                                outline
                                                single-line
                                                append-icon="event"
                                                readonly
                                                v-on="on"
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
                                    {{ creatingLocation.property_type }}
                                    {{ creatingLocation.property_features }}
                                    <v-layout row wrap align-center>
                                        <v-flex
                                            md3
                                            class="text-md-center"
                                            v-for="(feature, index) in features"
                                            v-bind:key="index"
                                        >
                                            <label>
                                                <input type="checkbox" :name="feature.key" :value="feature.id" v-model="creatingLocation.property_features" class="property-feature-input-element" />

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
                                        v-model="creatingLocation.description"
                                        name="description"
                                        placeholder="The Woodman set to work at once, and so sharp was his axe that the tree was soon chopped nearly through."
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
                                                v-model="creatingLocation.energetic_class_value"
                                                outline
                                                placeholder="0"
                                                color="#D81B60"
                                                @change="setEnergeticClass"
                                            ></v-text-field>
                                        </v-flex>
                                        <v-flex md8>
                                            <v-select
                                                single-line
                                                :items="energetic_class_items"
                                                v-model="creatingLocation.energetic_class"
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
                        <v-btn round flat @click.stop="e1 = 1">Retour</v-btn>
                    </v-flex>
                    <v-flex md6 class="text-md-right">
                        <v-btn
                            href="#montant"
                            dark
                            round
                            color="#D81B60"
                            @click.stop="e1 = 3"
                        >
                            Suivant
                        </v-btn>
                    </v-flex>
                </v-layout>
            </v-stepper-content>

            <v-stepper-content step="3">
                <v-card
                    class="mb-5 pb-5"
                >
                    <v-card-title primary-title class="justify-center">
                        <h3>Le montant de votre bien</h3>
                    </v-card-title>
                    <v-layout justify-center row wrap>
                        <v-flex xs12 sm8 md8>
                            <label>Loyer mensuel charges comprises</label>
                            <v-text-field
                                single-line
                                v-model="creatingLocation.rent_price"
                                outline
                                append-icon="euro_symbol"
                                placeholder="0"
                                color="#D81B60"
                            ></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm8 md8>
                            <label>Garantie demandée</label>
                            <v-text-field
                                single-line
                                v-model="creatingLocation.guarantee"
                                outline
                                append-icon="euro_symbol"
                                placeholder="0"
                                color="#D81B60"
                            ></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-card>
                <v-layout row wrap>
                    <v-flex md6 class="text-md-left">
                        <v-btn round flat @click.stop="e1 = 2">Retour</v-btn>
                    </v-flex>
                    <v-flex md6 class="text-md-right">
                        <v-btn
                            dark
                            round
                            color="#D81B60"
                            @click.stop="e1 = 4"
                        >
                            Suivant
                        </v-btn>
                    </v-flex>
                </v-layout>
            </v-stepper-content>
            <v-stepper-content step="4">
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
                                    <input type="file" id="files" ref="files" multiple v-on:change="handleFiles($event)"/>
                                    <p>
                                        Drop your files here <br>or click to search
                                    </p>
                                </v-flex>

                                <div v-for="(file, key) in this.creatingLocation.images" class="file-listing">
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
                        <v-btn round flat @click.stop="e1 = 3">Retour</v-btn>
                    </v-flex>
                    <v-flex md6 class="text-md-right">
                        <v-btn
                            dark
                            round
                            color="#D81B60"
                            @click.stop="e1 = 5"
                        >
                            Suivant
                        </v-btn>
                    </v-flex>
                </v-layout>
            </v-stepper-content>
            <v-stepper-content step="5">
                <v-card
                    class="mb-5 pb-5"
                >
                    <v-card-title primary-title class="justify-center">
                        <h3>Récapitulatif</h3>
                    </v-card-title>
                    <v-layout justify-center row wrap>
                        <v-flex xs12 sm8 md8>
                            <p>Recapitualif de votre annonce</p>
                        </v-flex>
                    </v-layout>
                </v-card>
                <v-layout row wrap>
                    <v-flex md6 class="text-md-left">
                        <v-btn round flat @click.stop="e1 = 4">Retour</v-btn>
                    </v-flex>
                    <v-flex md6 class="text-md-right">
                        <v-btn
                            dark
                            round
                            color="#D81B60"
                            @click.stop="submitFiles"
                        >
                            Publier mon annonce de location
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
    props: ['user', 'propertiestype'],
    data () {
        return {
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
        }
    },
    mounted() {
        if (localStorage.getItem('creatingLocation')) this.$store.state.locations.creatingLocation = JSON.parse(localStorage.getItem('creatingLocation'));
        this.propertiestype.forEach((type) => {
            if(this.creatingLocation.property_type === type.name) {
                this.features = type.features;
            }
        });

    },
    computed: {
        computedDateFormatted() {
            return this.formatDate(this.date);
        },
        creatingLocation() {
            return this.$store.state.locations.creatingLocation;
        },
    },
    watch: {
        creatingLocation: {
            handler() {
                console.log('creatingLocation changed!');
                console.log(this.creatingLocation);
                if(this.creatingLocation.energetic_class_value <= 50){
                    this.creatingLocation.energetic_class = 'A - inférieur à 50';
                }

                if(this.creatingLocation.energetic_class_value > 50 && this.creatingLocation.energetic_class_value <= 90){
                    this.creatingLocation.energetic_class = 'B - de 51 à 90';
                }

                if(this.creatingLocation.energetic_class_value > 50 && this.creatingLocation.energetic_class_value <= 90){
                    this.creatingLocation.energetic_class = 'B - de 51 à 90';
                }

                if(this.creatingLocation.energetic_class_value > 90 && this.creatingLocation.energetic_class_value <= 150){
                    this.creatingLocation.energetic_class = 'C - de 91 à 150';
                }

                if(this.creatingLocation.energetic_class_value > 150 && this.creatingLocation.energetic_class_value <= 230){
                    this.creatingLocation.energetic_class = 'D - de 151 à 230';
                }

                if(this.creatingLocation.energetic_class_value > 230 && this.creatingLocation.energetic_class_value <= 330){
                    this.creatingLocation.energetic_class = 'E - de 231 à 330';
                }

                if(this.creatingLocation.energetic_class_value > 330 && this.creatingLocation.energetic_class_value <= 450){
                    this.creatingLocation.energetic_class = 'F - de 331 à 450';
                }

                if(this.creatingLocation.energetic_class_value > 450){
                    this.creatingLocation.energetic_class = 'G - plus de 450';
                }
                localStorage.setItem('creatingLocation', JSON.stringify(this.creatingLocation));
            },
            deep: true,
        },
        date(val) {
            this.dateFormatted = this.formatDate(this.date);
        },
        energetic_class_value() {
            if(this.creatingLocation.energetic_class_value <= 50){
                this.creatingLocation.energetic_class = 'A - inférieur à 50';
            }

            if(this.creatingLocation.energetic_class_value > 50 && this.creatingLocation.energetic_class_value <= 90){
                this.creatingLocation.energetic_class = 'B - de 51 à 90';
            }

            if(this.creatingLocation.energetic_class_value > 50 && this.creatingLocation.energetic_class_value <= 90){
                this.creatingLocation.energetic_class = 'B - de 51 à 90';
            }

            if(this.creatingLocation.energetic_class_value > 90 && this.creatingLocation.energetic_class_value <= 150){
                this.creatingLocation.energetic_class = 'C - de 91 à 150';
            }

            if(this.creatingLocation.energetic_class_value > 150 && this.creatingLocation.energetic_class_value <= 230){
                this.creatingLocation.energetic_class = 'D - de 151 à 230';
            }

            if(this.creatingLocation.energetic_class_value > 230 && this.creatingLocation.energetic_class_value <= 330){
                this.creatingLocation.energetic_class = 'E - de 231 à 330';
            }

            if(this.creatingLocation.energetic_class_value > 330 && this.creatingLocation.energetic_class_value <= 450){
                this.creatingLocation.energetic_class = 'F - de 331 à 450';
            }

            if(this.creatingLocation.energetic_class_value > 450){
                this.creatingLocation.energetic_class = 'G - plus de 450';
            }
        }
    },
    methods: {
        setEnergeticClass() {
            console.log('set Energetic Class');
            if(this.creatingLocation.energetic_class_value <= 50){
                this.creatingLocation.energetic_class = 'A - inférieur à 50';
            }

            if(this.creatingLocation.energetic_class_value > 50 && this.creatingLocation.energetic_class_value <= 90){
                this.creatingLocation.energetic_class = 'B - de 51 à 90';
            }

            if(this.creatingLocation.energetic_class_value > 50 && this.creatingLocation.energetic_class_value <= 90){
                this.creatingLocation.energetic_class = 'B - de 51 à 90';
            }

            if(this.creatingLocation.energetic_class_value > 90 && this.creatingLocation.energetic_class_value <= 150){
                this.creatingLocation.energetic_class = 'C - de 91 à 150';
            }

            if(this.creatingLocation.energetic_class_value > 150 && this.creatingLocation.energetic_class_value <= 230){
                this.creatingLocation.energetic_class = 'D - de 151 à 230';
            }

            if(this.creatingLocation.energetic_class_value > 230 && this.creatingLocation.energetic_class_value <= 330){
                this.creatingLocation.energetic_class = 'E - de 231 à 330';
            }

            if(this.creatingLocation.energetic_class_value > 330 && this.creatingLocation.energetic_class_value <= 450){
                this.creatingLocation.energetic_class = 'F - de 331 à 450';
            }

            if(this.creatingLocation.energetic_class_value > 450){
                this.creatingLocation.energetic_class = 'G - plus de 450';
            }

        },
        formatDate (date) {
            if (!date) return null;
            const [year, month, day] = date.split('-');
            return `${day}/${month}/${year}`;
        },
        addRoom() {
            this.creatingLocation.room++;
        },
        removeRoom() {
            if(this.creatingLocation.room > 0){
                this.creatingLocation.room--;
            }
        },
        addBedroom() {
            this.creatingLocation.bedroom++;
        },
        removeBedroom() {
            if(this.creatingLocation.bedroom > 0){
                this.creatingLocation.bedroom--;
            }
        },
        handleFiles(e) {
            console.log(e);
            console.log('add file');
            console.log(this.$refs.files.files);
            let uploadedFiles = this.$refs.files.files;

            for(var i = 0; i < uploadedFiles.length; i++) {
                this.files.push(uploadedFiles[i]);
                this.$store.dispatch('locations/addCreatingLocationFile', uploadedFiles[i]);
            }
            document.getElementById("files").value = "";
            console.log(this.creatingLocation);
            localStorage.setItem('creatingLocation', JSON.stringify(this.creatingLocation));

        },
        getImagePreviews(){
             console.log('getimagepreview');
            for( let i = 0; i < this.creatingLocation.images.length; i++ ){
                console.log('infor');
                if ( /\.(jpe?g|png|gif)$/i.test( this.creatingLocation.images[i].name ) ) {
                    console.log('success');

                    // this.creatingLocation.images.push(this.files[i]);

                    let reader = new FileReader();
                    reader.addEventListener("load", function(){
                        this.$refs['preview'+parseInt(i)][0].src = reader.result;

                        // this.creatingLocation.images[i]['url'] = reader.result;

                    }.bind(this), false);
                    reader.readAsDataURL( this.creatingLocation.images[i] );
                }else{
                    console.log('error');
                    this.$nextTick(function(){
                        this.$refs['preview'+parseInt(i)][0].src = '/img/generic.png';
                    });
                }
            }
        },
        removeFile( key ){
            console.log('remove image');
            console.log(this.$refs.files.files);
            this.files.splice( key, 1 );
            this.$store.dispatch('locations/removeCreatingLocationFile', key);
            localStorage.setItem('creatingLocation', JSON.stringify(this.creatingLocation));
            console.log(this.creatingLocation);
            //this.getImagePreviews();
        },
        submitFiles(e) {
            e.preventDefault();
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
            console.log(formData);

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
