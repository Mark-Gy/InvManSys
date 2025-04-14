import * as types from '../../mutation-types';

export default {
    [types.ADD_STOCK_SUCCESS](state, payload) {
        state.stocks.push(payload);
      }
}
