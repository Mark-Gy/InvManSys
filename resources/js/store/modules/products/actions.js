// // products/actions.js
// import * as types from '../../mutation-types'
// import * as actions from '../../action-types'
// import axios from 'axios' 
// import mutations from './mutations';

// export default {
//     [actions.ADD_PRODUCT]({ commit }, data) {
//         // Fix the URL path - remove the extra "products/" segment
//         return axios.post('/products', data)
//             .then(response => {
//                 // Handle success response
//                 return response;
//             })
//             .catch(error => {
                
//                 // console.error(error.response.data.errors);
//                 // throw error;

//                 commit(mutations.SET_ERROR, error.response.data.errors);
//             });
//     }
// }

// products/actions.js
import * as types from '../../mutation-types'
import * as actions from '../../action-types'
import axios from 'axios' 
import mutations from './mutations';

export default {
    [actions.ADD_PRODUCT]({ commit }, data) {
        return axios.post('/api/products', data)  // Make sure this matches your route
            .then(response => {
                // Handle success response
                return response;
            })
            .catch(error => {
                if (error.response && error.response.data && error.response.data.errors) {
                    commit('errors/' + types.SET_ERRORS, error.response.data.errors, { root: true });
                }
                throw error;
            });
    }
}