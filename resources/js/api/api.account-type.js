import api from './api';

const apiAccountType = {
  list: () => api.get('/api/accountType'),
  add: accountType => api.post('/api/accountType', accountType),
  detail: id => api.get(`/api/accountType/${id}`),
  edit: accountType => api.put(`/api/accountType/${accountType.id}`, accountType),
  delete: (id, params) => api.deleteState(`/api/accountType/${id}`, params)
};

export default apiAccountType;
