<template>
    <section class="px-20 pt-8">
        <Header />

        <div class="w-full bg-white mt-10 lg:px-40">

            <div class="flex">
                <h4 class="text-2xl font-bold">Questions:</h4>

                <select class="!mx-4 rounded w-full" @change="getAnswers($event.target.value)">
                    <option v-for="question in questions" :value="question.id">{{ question.question }}</option>
                </select>
            </div>

            <div v-if="loader" class="w-full flex justify-center mt-12">
                <div class="spinner"></div>
            </div>

            <div v-if="!loader" class="mt-8">

                <div class="mt-20">
                    <h4 class="text-xl font-bold">Based on {{ answers.total }} responses</h4>
                    <Chart :answers="answers" />
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import Header from '../partials/__Header.vue';
import Chart from '../partials/__Chart.vue';

export default {
    beforeRouteEnter() {
        if(localStorage.getItem("redirectTo") != '/stats') {
            window.location.href = "/";
        }
    },
    name: 'Stats',
    components: {
        Header,
        Chart
    },
    data() {
        return {
            loader: true,
            questions: {},
            answers: {},
        }
    },
    methods: {
        async getQuestions(url = '/api/questions/answers') {
            this.loader = true;

            await axios.get(url, {
              headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
              }
            })
            .then(response => {
                this.questions = response.data.data;
                setTimeout(() => {
                    this.loader = false;
                }, 1000);
            })
            .catch(error => {
                console.log(error)
            });
        },

        async getAnswers(questionId = 1) {
            this.loader = true;

            await axios.get(`/api/answers/${questionId}`, {
              headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
              }
            })
            .then(response => {
                this.answers = response.data.data;

                setTimeout(() => {
                    this.loader = false;
                }, 1000);
            })
            .catch(error => {
                console.log(error)
            });
        },
    },
    mounted () {
        console.log(localStorage.getItem('redirectTo'))
        this.getQuestions();
        this.getAnswers();
    },
    created() {}
}

</script>