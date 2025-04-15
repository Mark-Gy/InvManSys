<template>
    <form role="form" @submit.prevent="submitForm" method="POST">
        <div class="row">
            <show-error></show-error>
            <div class="col-sm-6">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                    <h5 class="card-title">Return Product</h5><br><br>

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

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>Submit</button>
                        </div>
                    

                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h5 class="card-title">Product Size</h5><br><br>
                            <table  class="table table-sm">
                                <tr v-for="(item, index) in form.items" :key="index">
                                    <td>
                                        {{ item.size }}
                                    </td>
                                    <td>
                                        <input v-model="item.quantity" class="form-control" placeholder="Quantity">
                                    </td>
                                </tr>
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
    import categories from '../../store/modules/categories'
    import brands from '../../store/modules/brands'
    import sizes from '../../store/modules/sizes'
    import products from '../../store/modules/products'
    import errors from '../../store/modules/utils/errors'
    import ShowError from '../utils/ShowError.vue'

    export default {
        components: {
            ShowError
        },
        data() {
            return {
                form: {
                    date: '',
                    product_id: '',
                    items: [
                    ]
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
            console.log('Component mounted.')
            store.dispatch(`products/${actions.GET_PRODUCTS}`)
                .then(() => {
                    console.log('Products:', Array.from(this.products));
            });
        },
        methods: {
            selectedProduct(e) {
                this.form.items = [];
                let product = this.products.filter(product => product.id == this.form.product_id)
                console.log(product);

                product[0].product_stocks.map(stock=>{
                    let item = {
                        size : stock.size.name,
                        size_id : stock.size_id,
                        quantity : ''
                    }
                    this.form.items.push(item)
                })
            },
            submitForm() {
                store.dispatch(`return_products/${actions.SUBMIT_RETURN_PRODUCT}`, this.form);
            }
        },
    }
</script>
