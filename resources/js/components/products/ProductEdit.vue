<template>
    <form role="form" @submit.prevent="submitForm" method="POST">
        <div class="row">
            <show-error></show-error>
            <div class="col-sm-6">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                    <h5 class="card-title">Update Product</h5><br><br>

                    <!-- form start -->
                        <div class="card-body">
                            <div class="form-group">
                                <label>Category:<span class="text-danger">*</span></label><br>
                                <select class="form-control" v-model="form.category_id">
                                    <option v-for="category in categories" :value="category.id">
                                        {{ category.name }}
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Brand:<span class="text-danger">*</span></label><br>
                                <select class="form-control" v-model="form.brand_id">
                                    <option v-for="brand in brands" :value="brand.id">
                                        {{ brand.name }}
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>SKU:<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" v-model="form.sku" placeholder="SKU">
                            </div>

                            <div class="form-group">
                                <label>Name:<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" v-model="form.name" placeholder="Product Name">
                            </div>

                            <div class="form-group">
                                <label>Image:<span class="text-danger">*</span></label>
                                <img :src="product.product_image" class="old_image">
                                <input type="file" @change="selectImage" class="form-control" placeholder="Image">
                            </div>

                            <div class="form-group">
                                <label>Cost Price:<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" v-model="form.cost_price" placeholder="Cost Price">
                            </div>

                            <div class="form-group">
                                <label>Retail Price:<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" v-model="form.retail_price" placeholder="Retail Price">
                            </div>

                            <div class="form-group">
                                <label>Expiration Date:<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" v-model="form.expiration_date" placeholder="MM-DD-YYYY">
                            </div>


                            <div class="form-group">
                                <label>Description:<span class="text-danger">*</span></label>
                                <textarea class="form-control" v-model="form.description" placeholder="Description (Max 200 characters)"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Status:<span class="text-danger">*</span></label>
                                <select class="form-control" v-model="form.status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
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

                        <div class="row mb-2" v-for="(item, index) in form.items" :key="index">   
                            <div class="col-sm-4">
                                <select class="form-control" v-model="item.size_id">
                                    <option value="">Select Size</option>
                                    <option v-for="(size, index) in sizes" :key="index" :value=" size.id ">
                                        {{ size.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" v-model="item.location" class="form-control" placeholder="Location">
                            </div>
                            <div class="col-sm-3">
                                <input type="number" v-model="item.quantity" class="form-control" placeholder="Quantity">
                            </div>
                            <div class="col-sm-2">  
                                <button type="button" @click="deleteItem(index)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>   </button>
                            </div>
                        </div>
                        <br>
                        <button type="button" @click="addItem" class="btn btn-primary btn-sm mt-2"><i class="fa fa-plus"></i> Add Item</button>
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
        props: ['product'],
        data() {
            return {
                form: {
                    category_id: '',
                    brand_id: '',
                    sku: '',
                    name: '',
                    image: '',
                    cost_price: 0,
                    retail_price: 0,
                    expiration_date: '',
                    description: '',
                    status: 1,
                    items: [{
                        size_id: '',
                        location: '',
                        quantity: 0
                    }]
                }
            }
        },
        computed: {
            ...mapGetters({
                categories: 'categories/getCategories',
                brands: 'brands/getBrands',
                sizes: 'sizes/getSizes',
                errors: 'errors/getErrors',
                isErrors: 'errors/getIsErrors'
            }),
        },
        mounted() {
            console.log('Component mounted.')
            store.dispatch(`categories/${actions.GET_CATEGORIES}`)
            store.dispatch(`brands/${actions.GET_BRANDS}`)
            store.dispatch(`sizes/${actions.GET_SIZES}`)
                .then(() => {
                    console.log('Categories:', Array.from(this.categories));
            });

            //Get Data
            this.form.category_id = this.product.category_id;
            this.form.brand_id = this.product.brand_id;
            this.form.name = this.product.name;
            this.form.sku = this.product.sku;
            this.form.cost_price = this.product.cost_price;
            this.form.retail_price = this.product.retail_price;
            this.form.expiration_date = this.product.expiration_date;
            this.form.description = this.product.description;
            this.form.status = this.product.status;
            this.form.items = this.product.product_stocks;

        },
        methods: {
            selectImage(e) {
                this.form.image = e.target.files[0]
            },
            addItem() {
                let item = {
                    size_id: '',
                    location: '',
                    quantity: 0
                }
                this.form.items.push(item)
            },
            deleteItem(index) {
                this.form.items.splice(index, 1)
            },
            submitForm() {
                try {
                    
                    let data = new FormData();
                    data.append('_method', 'PUT')
                    data.append('category_id', this.form.category_id);
                    data.append('brand_id', this.form.brand_id);
                    data.append('sku', this.form.sku);
                    data.append('name', this.form.name);
                    data.append('image', this.form.image);
                    data.append('cost_price', this.form.cost_price);
                    data.append('retail_price', this.form.retail_price);
                    data.append('expiration_date', this.form.expiration_date);
                    data.append('description', this.form.description);
                    data.append('status', this.form.status);
                    data.append('items', JSON.stringify(this.form.items));

                    let payload = {
                        data: data,
                        id: this.product.id,
                    }

                    store.dispatch(`products/${actions.EDIT_PRODUCT}`, payload);
                    // store.dispatch('products/ADD_PRODUCT', data);
                }
                catch(err){
                    console.log(err);
                }
            },
            hasError(field) {
                return this.isErrors && this.errors[field] !== undefined;
            },
            getError(field) {
                return this.hasError(field) ? this.errors[field][0] : '';
            },
        }
    }
</script>

<style scooped>
    .old_image {
        width: 100px;
    }
</style>