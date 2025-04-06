import actions from './actions'
import getters from './getters'
import mutations from './mutations'

const state = {
    is_errors: false,
    errors: []
}

export default {
    namespaced: true,
    state,
    actions,
    getters,
    mutations
}
