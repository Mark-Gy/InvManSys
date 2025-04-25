import axios from 'axios';
import * as types from '../../mutation-types';
import * as actions from '../../action-types';

export default {
    async [actions.RECORD_SOLD_ITEMS]({ commit }, form) {
        try {
            const response = await axios.post('sold-items', form);
            
            form.items.forEach(item => {
                commit(types.ADD_SOLD_ITEM, item);
            });
            
            return response.data; 
        } catch (error) {
            if (error.response) {
                if (error.response.data.errors) {
                    commit('errors/SET_ERRORS', error.response.data.errors, { root: true });
                } else {
                    commit('errors/SET_ERRORS', { 
                        form: [error.response.data.message || 'Failed to record sale'] 
                    }, { root: true });
                }
            } else {
                commit('errors/SET_ERRORS', { 
                    form: [error.message || 'Network error occurred'] 
                }, { root: true });
            }
            throw error;
        }
    }
};