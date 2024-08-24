import axios from 'axios';

const axiosInstance = axios.create({
  baseURL: 'http://127.0.0.1:8000/api',
});

axiosInstance.interceptors.request.use(
  async (config) => {

    const token = localStorage.getItem('token');
    if (token) {
      try {
          await axios.get('http://127.0.0.1:8000/api/TokenValidation', {
              headers: {
                  'Authorization': `Bearer ${token}`,
              },
          });
      } catch (err) {
          if (err.response.status === 401) {
              localStorage.removeItem('token')
          }
      }    
    }
    
    if (token && config.headers['auth']) {
      config.headers['Authorization'] = `Bearer ${token}`;
    }

    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

export default axiosInstance;
