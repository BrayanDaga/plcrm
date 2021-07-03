import api from './api';

const apiBank = {
    list: () => api.get('/api/bank'),
    add: bank => api.post('/api/bank', bank),
    detail: id => api.get(`/api/bank/${id}`),
    edit: (bank) => api.put(`/api/bank/${bank.id}`),
    delete: id => api.delete(`/api/bank/${id}`)
};

export default apiBank;
