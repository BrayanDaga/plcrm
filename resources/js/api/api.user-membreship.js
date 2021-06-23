import request from './api';

const apiUserMembreship = {
    listByUser: params => request.getPaginate(`/api/usersMembreship`, params),
    listUserMembreship: params => request.getPaginate(`/api/usersMembreship/list`, params)
};

export default apiUserMembreship;
