import request from './api';

const apiUserMembreship = {
    list: page => request.get(`/api/usersMembreship?page=${page}`),
    listUserMembreship: (page, pageSize) => request.get(`/api/usersMembreship/list?page=${page}`)
};

export default apiUserMembreship;
