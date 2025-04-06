import { createStore } from 'vuex'

// Modules (add them here when needed)

import categories from './modules/categories'
import brands from './modules/brands'
import sizes from './modules/sizes'

const store = createStore({
    modules: {
        categories,
        brands,
        sizes
    }
})

export default store
