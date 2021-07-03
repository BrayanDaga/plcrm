import api from './api';

const apiPaymentMethod = {
  list: () => api.get('/api/paymentMethod'),
  add: paymentMethod => api.post('/api/paymentMethod', paymentMethod),
  detail: id => api.get(`/api/paymentMethod/${id}`),
  edit: paymentMethod => api.put(`/api/paymentMethod/${paymentMethod.id}`, paymentMethod),
  delete: (id, params) => api.deleteState(`/api/paymentMethod/${id}`, params)
};

export default apiPaymentMethod;