const apiMessage = {
  list: () => api.get('/api/message'),
  add: message => api.post('/api/message', message),
  detail: id => api.get(`/api/message/${id}`),
  edit: message => api.put(`/api/message/${message.id}`, message),
  delete: (id, params) => api.deleteState(`/api/message/${id}`, params)
};

export default apiMessage;
