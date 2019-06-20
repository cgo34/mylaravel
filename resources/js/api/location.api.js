import axios from 'axios';

export default class LocationAPI {
    static getLocations() {
        return axios.get('/api/annonces/location');
    }
}
