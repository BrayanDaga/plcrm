import api from './api';

const apiBank = {
    list: () => api.get('/api/bank'),
    add: bank => api.post('/api/bank', bank),
    detail: id => api.get(`/api/bank/${id}`),
    edit: (bank, id) => api.put(`/api/bank/${id}`, bank),
    delete: id => api.delete(`/api/bank/${id}`)
};

export default apiBank;
