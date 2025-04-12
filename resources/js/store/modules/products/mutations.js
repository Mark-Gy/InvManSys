import * as types from '../../mutation-types';

export default {
  [types.EDIT_PRODUCT_SUCCESS](state, payload) {
    // Add the new product to your products array
    state.products.push(payload);
  }
}