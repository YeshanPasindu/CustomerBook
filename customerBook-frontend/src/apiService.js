import axios from 'axios';

const apiClient = axios.create({
  baseURL: 'http://localhost:8000/api', 
  headers: {
    Authorization: `Bearer ${localStorage.getItem('token')}`,
  },
});


export const login = (data) => apiClient.post('/login', data);
export const signup = (data) => apiClient.post('/register', data);
export const logout = () => apiClient.post('/logout');


export const getCustomers = () => apiClient.get('/customers');
export const searchCustomers = (query) => apiClient.get(`/customers/search?query=${query}`);
export const addCustomer = (data) => apiClient.post('/customers', data);
export const updateCustomer = (id, data) => apiClient.put(`/customers/${id}`, data);
export const deleteCustomer = (id) => apiClient.delete(`/customers/${id}`);
export const getCustomer = (id) => apiClient.get(`/customers/${id}`);

