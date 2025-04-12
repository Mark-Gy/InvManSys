import * as mutations from '../../../mutation-types'

export default {
    [mutations.SET_ERRORS](state, payload) {
        console.log('Mutation called with payload:', payload);
        state.is_errors = true
        state.errors = payload
    }
}
