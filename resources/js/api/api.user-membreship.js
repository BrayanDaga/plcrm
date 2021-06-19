import request from './api';

const apiUserMembreship = {
    list: (page) => request.get(`/api/usersMembreship?page=${page}`),
};

export default apiUserMembreship;
