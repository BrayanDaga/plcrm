import request from './api';

const apiUsers = {
  listByUser: () => request.get(`/users/api`),
  listUsers: () => request.get(`/users/api/list`),
};

export default apiUsers;
