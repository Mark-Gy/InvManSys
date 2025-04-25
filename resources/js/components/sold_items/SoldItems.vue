<template>
  <form role="form" @submit.prevent="submitForm" method="POST">
      <div class="row">
          <show-error></show-error>
          <div class="col-sm-6">
              <div class="card card-primary card-outline">
                  <div class="card-body">
                      <h5 class="card-title">Sell Products</h5><br><br>

                      <!-- form start -->
                      <div class="card-body">
                          <div class="form-group">
                              <label>Product:<span class="text-danger">*</span></label><br>
                              <select class="form-control" @change="selectedProduct" v-model="form.product_id">
                                  <option disabled value="">Select Product</option>
                                  <option v-for="product in products" :value="product.id">
                                      {{ product.name }}
                                  </option>
                              </select>
                          </div>

                          <div class="form-group">
                              <label>Date<span class="text-danger">*</span></label>
                              <input type="date" v-model="form.date" class="form-control">
                          </div>
                      </div>
                      <!-- /.card-body -->

                      <div class="card-footer text-right">
                          <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Submit</button>
                      </div>
                  </div>
              </div>
          </div>

          <div class="col-sm-6">
              <div class="card card-primary card-outline">
                  <div class="card-body">
                      <h5 class="card-title">Product Sizes</h5><br><br>
                          <table class="table table-sm">
                              <thead>
                                  <tr>
                                      <th>Size</th>
                                      <th>Quantity to Deduct</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr v-for="(item, index) in form.items" :key="index">
                                      <td>{{ item.size }}</td>
                                      <td>
                                          <input 
                                              v-model="item.quantity" 
                                              class="form-control" 
                                              type="number" 
                                              min="1" 
                                              :max="item.stock"
                                              @change="validateQuantity(item)"
                                              placeholder="Enter quantity">
                                      </td>
                                  </tr>
                              </tbody>
                          </table>
                      <br>
                  </div>
              </div>
          </div>
      </div>
  </form>
</template>

<script>
import store from '../../store'
import * as actions from '../../store/action-types'
import { mapGetters } from 'vuex'
import ShowError from '../utils/ShowError.vue'
import Swal from 'sweetalert2' 

export default {
  components: {
      ShowError
  },
  data() {
      return {
          form: {
              date: '',
              product_id: '',
              items: []
          }
      }
  },
  computed: {
      ...mapGetters({
          products: 'products/getProducts',
          errors: 'errors/getErrors',
          isErrors: 'errors/getIsErrors'
      }),
  },
  mounted() {
      store.dispatch(`products/${actions.GET_PRODUCTS}`)
          .then(() => {
              console.log('Products loaded:', this.products);
          });
  },
  methods: {
      selectedProduct() {
          this.form.items = [];
          const product = this.products.find(p => p.id == this.form.product_id);
          
          if (product && product.product_stocks) {
              product.product_stocks.forEach(stock => {
                  this.form.items.push({
                      size: stock.size.name,
                      size_id: stock.size_id,
                      stock: stock.quantity,
                      quantity: null
                  });
              });
          }
      },
      validateQuantity(item) {
          if (item.quantity > item.stock) {
              Swal.fire({
                  icon: 'error',
                  title: 'Invalid Quantity',
                  text: `Cannot deduct more than available stock (${item.stock})`,
              });
              item.quantity = item.stock;
          }
      },
      submitForm() {
          const itemsToSell = this.form.items.filter(item => item.quantity && item.quantity > 0);
          
          if (itemsToSell.length === 0) {
              Swal.fire({
                  icon: 'error',
                  title: 'Validation Error',
                  text: 'Fill out the form to record sale',
              });
              return;
          }

          for (const item of itemsToSell) {
              if (item.quantity > item.stock) {
                  Swal.fire({
                      icon: 'error',
                      title: 'Validation Error',
                      text: `Quantity for ${item.size} exceeds available stock`,
                  });
                  return;
              }
          }

          const payload = {
              product_id: this.form.product_id,
              date: this.form.date,
              items: itemsToSell
          };

          store.dispatch(`soldItems/${actions.RECORD_SOLD_ITEMS}`, payload)
              .then(() => {
                  Swal.fire({
                      icon: 'success',
                      title: 'Success!',
                      text: 'Stock deducted successfully!',
                  });
                  this.form = {
                      date: '',
                      product_id: '',
                      items: []
                  };
              })
              .catch(error => {
                  Swal.fire({
                      icon: 'error',
                      title: 'Error',
                      text: error.message || 'Failed to record sale',
                  });
              });
      }
  }
}
</script>