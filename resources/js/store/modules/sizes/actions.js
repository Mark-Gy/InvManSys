import * as actions from '../../action-types';
import * as mutations from '../../mutation-types';
import axios from 'axios';

export default {
    [actions.GET_SIZES]({ commit }) {
        axios.get('/api/sizes')
            .then(res => {
                if (res.data.success === true) {
                    commit(mutations.SET_SIZES, res.data.data);
                }
            })
            .catch(err => {
                console.error(err.response);
            });
    }
};
