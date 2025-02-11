<template>
    <section class="px-20 pt-8">
        <Header />

        <div class="w-full bg-white mt-10 lg:px-40">
            <h1 class="text-2xl font-bold mb-4">Here are the results</h1>

            <div v-if="loader" class="w-full flex justify-center mt-12">
                <div class="spinner"></div>
            </div>

            <div v-if="!loader" class="px-6 py-12 rounded-lg shadow-lg border" id="survey-container">
                
            </div>
        </div>
    </section>
</template>

<script>
import Header from '../partials/__Header.vue';

export default {
    name: 'Stats',
    components: {
        Header
    },
    data() {
        return {
            loader: true,
        }
    },
    methods: {
    },
    mounted () {
    },
    created() {}
}

</script>