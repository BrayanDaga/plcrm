import api from './api';

const apiPayment = {
    list: () => api.get('/api/payment/list'),
};

export default apiPayment;