import * as actions from '../../action-types';
import * as mutations from '../../mutation-types';
import axios from 'axios';

export default {
    [actions.GET_CATEGORIES]({ commit }) {
        axios.get('/api/categories')
            .then(res => {
                if (res.data.success === true) {
                    commit(mutations.SET_CATEGORIES, res.data.data);
                }
            })
            .catch(err => {
                console.error(err.response);
            });
    }
};
