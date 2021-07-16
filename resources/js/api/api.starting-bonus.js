import api from './api';

const startingBonus = {
  list: ()  => api.get(`/starting-bonus/startingBonus`),
  add: startingBonus => api.post('/starting-bonus/startingBonus', startingBonus),
//   detail: id => api.get(`/starting-bonus/startingBonus/${id}`),
//   edit: startingBonus => api.put(`/starting-bonus/startingBonus/${startingBonus.id}`, startingBonus),
  delete: (id, params) => api.deleteState(`/starting-bonus/startingBonus/${id}`, params)
};

export default startingBonus;
