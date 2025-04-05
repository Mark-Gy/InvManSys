import { createStore } from 'vuex'

// Modules (add them here when needed)

import categories from './modules/categories'

const store = createStore({
    modules: {
        categories
    }
})

export default store
