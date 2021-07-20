import axios from 'axios';

const sleep = (delay) => {
  return new Promise((resolve) => {
    setTimeout(resolve, delay);
  });
};

axios.interceptors.response.use(async (response) => {
  await sleep(2000);
  return response;
});

const responseBody = (response) => response.data;

const request = {
  get: (url) => axios.get(url).then(responseBody),
  getPaginate: (url, params) => axios.get(url, { params }).then(responseBody),
  post: (url, body) => axios.post(url, body).then(responseBody),
  put: (url, body) => axios.put(url, body).then(responseBody),
  delete: (url) => axios.delete(url).then(responseBody),
  deleteState: (url, params) => axios.delete(url, { params }).then(responseBody),
};

export default request;
