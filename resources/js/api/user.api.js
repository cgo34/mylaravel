import axios from 'axios';

export default class UserAPI {
    static getUsers() {
        return axios.get('/api/users');
    }

    static getUser() {
        console.log('getUser');
        return axios.get(`/user`);
    }

    static createUser(user) {
        return axios.post('/api/users', user);
    }
}
