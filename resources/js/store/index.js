import { createStore } from 'vuex'

// Modules (add them here when needed)

import categories from './modules/categories'
import brands from './modules/brands'

const store = createStore({
    modules: {
        categories,
        brands
    }
})

export default store
