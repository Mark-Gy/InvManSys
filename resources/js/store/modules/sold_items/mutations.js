import * as types from '../../mutation-types';

export default {
  [types.ADD_SOLD_ITEM](state, item) {
    state.soldItems.push(item);
  }
}