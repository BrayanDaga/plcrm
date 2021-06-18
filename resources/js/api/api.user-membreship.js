import request from "./api";

const apiUserMembreship = {
    list: (page) => request.get(`/api/usersMembreship/list?page=${page}`),
};

export default apiUserMembreship;
