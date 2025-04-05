import { createApp } from 'vue';
import ProductAdd from './components/products/ProductAdd.vue';


import store from './store';

// Create Vue app instance
const app = createApp({});

// Register component
app.component('product-add', ProductAdd);
app.use(store);

// Mount app
app.mount('#app');
