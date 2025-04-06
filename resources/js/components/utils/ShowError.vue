<template>
    <div class="col-sm-12" v-if="isErrors">
        <div class="alert alert-danger" role="alert">
            <ul>
                <li v-for="(error, index) in errors" :key="index">
                    {{ error[0] }}
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
            })
        }
    }

</script>

<style scoped>

</style>