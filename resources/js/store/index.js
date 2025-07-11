import { createStore } from 'vuex'
import axios from 'axios'
axios.defaults.baseURL = 'http://127.0.0.1:8000'


import errors from './modules/utils/errors'
import categories from './modules/categories'
import brands from './modules/brands'
import sizes from './modules/sizes'
import products from './modules/products'
import stocks from './modules/stocks'
import return_products from './modules/return_products'
import soldItems from './modules/sold_items'

const store = createStore({
    modules: {
        errors,
        categories,
        brands,
        sizes,
        products,
        stocks,
        return_products,
        soldItems
    }
})

export default store
