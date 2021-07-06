import api from './api';

const apiAdvertisements = {
  list: () => api.get('/api/advertisements'),
  add: advertisement => api.post('/api/advertisements', advertisement),
  detail: id => api.get(`/api/advertisements/${id}`),
  edit: advertisement => api.put(`/api/advertisements/${advertisement.id}`, advertisement),
  delete: (id, params) => api.deleteState(`/api/advertisements/${id}`, params)
};

export default apiAdvertisements;
