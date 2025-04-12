import * as types from '../../mutation-types';
import * as actions from '../../action-types';
import axios from 'axios';

export default {
    [actions.ADD_PRODUCT]({ commit }, data) {
        console.log('Data being sent to the server:', data);
        return axios.post('/api/products', data)
            .then(response => {
                commit(types.ADD_PRODUCT_SUCCESS, response.data);
                
                if (response.data.success == true) {
                    window.location.href = '/products';
                }
                return response;
            })
            .catch(error => {
                console.error('Error occurred while adding product:', error);
                if (error.response && error.response.data) {
                    console.error('Server response:', error.response.data);
                    if (error.response.data.errors) {
                        console.log('Commit key:', types.SET_ERRORS);
                        console.log('Committing errors:', error.response.data.errors);
                        commit('errors/' + types.SET_ERRORS, error.response.data.errors, { root: true });
                    }
                }
                throw error;
            });
    },
    [actions.EDIT_PRODUCT]({ commit }, payload) {
        console.log('Data being sent to the server:', payload);
        return axios.post(`/api/products/${payload.id}`, payload.data)
            .then(response => {
                commit(types.EDIT_PRODUCT_SUCCESS, response.data);
                
                if (response.data.success == true) {
                    window.location.href = '/products';
                }
                return response;
            })
            .catch(error => {
                console.error('Error occurred while adding product:', error);
                if (error.response && error.response.data) {
                    console.error('Server response:', error.response.data);
                    if (error.response.data.errors) {
                        console.log('Commit key:', types.SET_ERRORS);
                        console.log('Committing errors:', error.response.data.errors);
                        commit(`errors/${types.SET_ERRORS}`, error.response.data.errors, { root: true });
                    }
                }
                throw error;
            });
    }
}