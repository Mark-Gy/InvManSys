import * as types from '../../mutation-types';

export default {
  [types.EDIT_PRODUCT_SUCCESS](state, payload) {
    state.products.push(payload);
  },
  [types.SET_PRODUCTS](state, payload) {
    state.products = payload;
  }
}