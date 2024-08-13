import axios from './axios';

const login = async (email, password) => {
  try {
    const response = await axios.post('/login', { email, password });
    return response.data; 
  } catch (error) {
    // Log detailed error for debugging
    console.error('Login error:', error.response ? error.response.data : error.message);
    throw new Error(error.response ? error.response.data.message : 'Login failed');
  }
};

export default {
  login
};
