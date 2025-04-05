import * as actions from '../../action-types';
import * as mutations from '../../mutation-types';
import axios from 'axios';

export default {
    [actions.GET_BRANDS]({ commit }) {
        axios.get('/api/brands')
            .then(res => {
                if (res.data.success === true) {
                    commit(mutations.SET_BRANDS, res.data.data);
                }
            })
            .catch(err => {
                console.error(err.response);
            });
    }
};
