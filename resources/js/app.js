import { createApp } from 'vue';
import ProductAdd from './components/products/ProductAdd.vue';
import store from './store';  // Import Vuex store

// Create Vue app instance
const app = createApp({});

// Use Vuex store
app.use(store);

// Register component
app.component('product-add', ProductAdd);

// Mount app
app.mount('#app');
