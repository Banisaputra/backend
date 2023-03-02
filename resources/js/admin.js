import qs from 'qs';
import assign from 'lodash.assign';
import merge from 'lodash.merge';

window.qs = qs;
window.assign = assign;
window.merge = merge;

window.Ajax = async ({
  endpoint: url,
  method = 'GET',
  headers = null,
  payload = null,
  onSuccess = () => {},
  onError = () => {},
  onFinish = () => {},
} = {}) => {
  const options = { method };
  options.headers = headers || {};
  options.body = payload || {};

  return fetch(url, options)
    .then(async (res) => {
      const data = await res.json();

      if (res.status !== 200) {
        onError(data);
        return data;
      }

      onSuccess(data);
      return data;
    })
    .catch((res) => {
      onError(res);
      console.error('an error occured.');
      // Toast.add('error', 'An error occured. Please try again later.');
    })
    .finally(onFinish);
};
