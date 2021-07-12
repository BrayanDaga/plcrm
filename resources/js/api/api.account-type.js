import api from './api';

const apiAccountType = {
  list: (params) => api.getPaginate(`/config/account-type/accountType`,params),
  add: accountType => api.post('/config/account-type/accountType', accountType),
  detail: id => api.get(`/config/account-type/accountType/${id}`),
  edit: accountType => api.put(`/config/account-type/accountType/${accountType.id}`, accountType),
  delete: (id, params) => api.deleteState(`/config/account-type/accountType/${id}`, params)
};

export default apiAccountType;
