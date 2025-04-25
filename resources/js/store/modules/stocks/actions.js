import * as types from '../../mutation-types';
import * as actions from '../../action-types';
import axios from 'axios';

export default {
    [actions.SUBMIT_STOCK]({ commit }, data) {
        console.log('Data being sent to the server:', data);
        return axios.post('/stocks', data)
            .then(response => {
                commit(types.ADD_STOCK_SUCCESS, response.data);
                
                if (response.data.success == true) {
                    window.location.href = '/stocks';
                }
                return response;
            })
            .catch(error => {
                if (error.response && error.response.data) {
                    console.error('Server response:', error.response.data);
                    if (error.response.data.errors) {
                        console.log('Committing errors:', error.response.data.errors);
                    }
                }
                throw error;
            });
    },
    
}