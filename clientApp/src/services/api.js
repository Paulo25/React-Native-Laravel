import axios from 'axios';

const api = axios.create({
   baseURL: "http://192.168.43.42:100/api"
});

export default api;