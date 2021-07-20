import request from './api';

const apiUserMembreship = {
  listByUser: () => request.get(`/user-membreship/api`),
  listUserMembreship: () => request.get(`/user-membreship/api/list`),
};

export default apiUserMembreship;
