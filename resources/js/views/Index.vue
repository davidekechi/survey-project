<template>
    <section class="px-20 pt-8">
        <Header />

        <div v-if="!surveyComplete" class="w-full bg-white mt-10 lg:px-40">
            <h1 class="text-2xl font-bold mb-4">Start the survey</h1>

            <div v-if="loader" class="w-full flex justify-center mt-12">
                <div class="spinner"></div>
            </div>

            <div v-if="!loader" class="px-6 py-12 rounded-lg shadow-lg border" id="survey-container">
                <form @submit.prevent="submitAnswers">
                    <div v-for="(question, index) in questions.data" class='mb-4'>
                        <p class='font-semibold'>{{ +(questions.from) + +(index) }}. {{ question.question }}</p>
                        <input type='number' min='0' max='5' class='w-full border rounded p-2 mt-2' @change="storeAnswers(question.slug, $event.target.value)" :value="formData.answers[question.slug] ? formData.answers[question.slug].answer : null" required>
                    </div>
                    <div class="flex justify-between">
                        <button v-if="questions.prev_page_url != null" type="button" id="prev-btn" class="mt-4 bg-white border-2 border-black text-black px-4 !h-10 rounded w-fit" @click="getQuestions(questions.prev_page_url)">Previous</button>
                        <button v-if="questions.next_page_url != null" type="submit" id="next-btn" class="mt-4 bg-black text-white px-4 !h-10 rounded w-fit">Next</button>
                        <button v-if="questions.next_page_url == null" type="submit" id="next-btn" class="mt-4 bg-black text-white px-4 !h-10 rounded w-fit">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <div v-if="surveyComplete" class="w-full bg-white mt-40 lg:px-40 grid justify-center">
            <h1 class="text-2xl font-bold mb-4 flex justify-center">Thank you for taking the survey</h1>
            <h1 class="text-2xl font-bold mb-4 flex justify-center">Your response has been recorded and will be displayed anonymously</h1>

            <div class="grid justify-center mt-12">
                <a href="/stats"><button type="button" class="bg-black text-white px-4 !h-10 rounded w-fit">View Survey Results</button></a>
            </div>
        </div>
    </section>
</template>

<script>
import Header from '../partials/__Header.vue';

export default {
    beforeRouteEnter() {
        if(localStorage.getItem("redirectTo") == '/stats') {
            window.location.href = "/stats";
        }
    },
    name: 'Index',
    components: {
        Header
    },
    data() {
        return {
            loader: true,
            questions: {},
            formData: {
                answers: {},
            },
            surveyComplete: false
        }
    },
    methods: {
        async getQuestions(url = '/api/questions') {
            this.loader = true;

            await axios.get(url, {
              headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
              }
            })
            .then(response => {
                this.questions = response.data;
                setTimeout(() => {
                    this.loader = false;
                }, 1000);
            })
            .catch(error => {
                console.log(error)
            });
        },

        storeAnswers(question, answer) {
            this.formData['answers'][question] = { question: question, answer: answer };
        },

        async submitAnswers() {
            this.loader = true;
            if(this.questions.next_page_url != null) {
                this.getQuestions(this.questions.next_page_url);
                return
            }

            await axios.post('/api/questions', this.formData, {
              headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
              }
            })
            .then(response => {
                localStorage.setItem('redirectTo', '/stats');
                this.surveyComplete = true;
            })
            .catch(error => {
                console.log(error)
            });
        }
    },
    mounted () {
        this.getQuestions();
    },
    created() {}
}

</script>