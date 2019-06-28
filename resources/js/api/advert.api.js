import axios from 'axios';

export default class AdvertApi {
    static getLocations() {
        return axios.get('/api/annonces/location');
    }

    static getBuyers() {
        return axios.get('/api/annonces/achat');
    }

    static getPropertyTypes() {
        console.log("getPropertyTypes");
        return axios.get('/api/property/types');
    }

    static getAdvertTypes() {
        console.log("getAdvertTypes");
        return axios.get('/api/advert/types');
    }

    static createAdvert(advert) {
        return axios.post('/adverts', advert);
    }
}
