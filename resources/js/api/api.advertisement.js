import api from './api';

const apiAdvertisements = {
  list: () => api.get('/api/advertisements'),
  add: advertisements => api.post('/api/advertisements', advertisements),
  detail: id => api.get(`/api/advertisements/${id}`),
  edit: advertisements => api.put(`/api/advertisements/${advertisements.id}`, advertisements),
  delete: (id, params) => api.deleteState(`/api/advertisements/${id}`, params)
};

export default apiAdvertisements;
