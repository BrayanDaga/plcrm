import api from './api';

const apiStartingBonus = {
  list: ()  => api.get(`/starting-bonus/startingBonus`),
  add: apiStartingBonus => api.post('/starting-bonus/startingBonus', apiStartingBonus),
   detail: id => api.get(`/starting-bonus/startingBonus/${id}`),
  delete: id => api.delete(`/starting-bonus/startingBonus/${id}`)


};

export default apiStartingBonus;
