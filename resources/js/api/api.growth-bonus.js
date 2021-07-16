import api from './api';

const apiGrowthBonus = {
  list: ()  => api.get(`/growth-bonus/growthBonus`),
  add: apiGrowthBonus => api.post('/growth-bonus/growthBonus', apiGrowthBonus),
   detail: id => api.get(`/growth-bonus/growthBonus/${id}`),
//   edit: apiGrowthBonus => api.put(`/growth-bonus/growthBonus/${apiGrowthBonus.id}`, apiGrowthBonus),
  delete: id => api.delete(`/growth-bonus/growthBonus/${id}`)


};

export default apiGrowthBonus;
