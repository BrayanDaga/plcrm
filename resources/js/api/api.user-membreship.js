import request from './api';

const apiUserMembreship = {
    list: page => request.get(`/api/usersMembreship?page=${page}`),
    listUserMembreship: params => request.getList(`/api/usersMembreship/list`, params)
};

export default apiUserMembreship;
