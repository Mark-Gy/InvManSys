<template>
    <div class="col-sm-12" v-if="isErrors">
        <div class="alert alert-danger" role="alert">
            <ul>
                <li v-for="(error, index) in errors" :key="index">
                    {{ Array.isArray(error) ? error[0] : error }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        computed: {
            ...mapGetters('errors', {
                errors: 'getErrors',
                isErrors: 'getIsErrors'
            }),
        debugInfo() {
            console.log('Current errors:', this.errors);
            console.log('isErrors:', this.isErrors);
            return '';
        }
        }
    }

</script>

<style scoped>

</style>