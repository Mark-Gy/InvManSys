import { createApp } from 'vue';
import ProductAdd from './components/products/ProductAdd.vue';
import ProductEdit from './components/products/ProductEdit.vue';
import StockManage from './components/stocks/StockManage.vue';

import store from './store';

// Create Vue app instance
const app = createApp({});

// Register component
app.component('product-add', ProductAdd);
app.component('product-edit', ProductEdit);
app.component('stock-manage', StockManage);
app.use(store);

// Mount app
app.mount('#app');
