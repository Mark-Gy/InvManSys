import * as types from '../../mutation-types';

export default {
    [types.RETURN_PRODUCT_SUCCESS](state, payload) {
        state.return_products.push(payload);
    }
}
