import { createStore } from 'vuex'
// In your main.js or where you configure axios
import axios from 'axios'
axios.defaults.baseURL = 'http://127.0.0.1:8000'

// Modules (add them here when needed)

import errors from './modules/utils/errors'
import categories from './modules/categories'
import brands from './modules/brands'
import sizes from './modules/sizes'
import products from './modules/products'
import stocks from './modules/stocks'

const store = createStore({
    modules: {
        errors,
        categories,
        brands,
        sizes,
        products,
        stocks,
    }
})

export default store
