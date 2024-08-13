import axios from 'axios';

// Set up the base URL 
const instance = axios.create({
  baseURL: 'http://localhost:8000/api', 
});

export default instance;
