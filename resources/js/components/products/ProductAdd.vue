<template>
    <div class="card card-primary card-outline">
        <div class="card-body">
        <h5 class="card-title">Create a Product</h5><br><br>

        <!-- form start -->
        <form role="form" action=" " method="POST">
            <div class="card-body">
                <div class="form-group">
                    <label>Category:</label>
                    <!-- The line below causes error -->
                    <select class="form-control" v-model="form.category_id">
                        <option v-for="category in categories" :value="category.id">
                            {{ category.name }}
                        </option>
                    </select>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>Submit</button>
            </div>
        </form>

        </div>
    </div><!-- /.card -->
</template>

<script>
    import store from '../../store'
    import * as actions from '../../store/action-types'
    import { mapGetters } from 'vuex'
    import categories from '../../store/modules/categories'

    export default {
        data() {
            return {
                form: {
                    category_id: 0
                }
            }
        },
        computed: {
            ...mapGetters({
                categories: 'categories/getCategories'
            })  
        },
        mounted() {
            console.log('Component mounted.')
            store.dispatch(`categories/${actions.GET_CATEGORIES}`)
                .then(() => {
                    console.log('Categories:', Array.from(this.categories));
            });
        }
    }
</script>

