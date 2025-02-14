<template>
    <section class="px-20 pt-8">
        <Header />

        <div class="w-full bg-white mt-10 lg:px-40">

            <div v-if="loader" class="w-full flex justify-center mt-12">
                <div class="spinner"></div>
            </div>

            <div v-if="!loader" class="mt-8">

                <div class="">
                    <h4 class="text-xl font-bold">Users without survey answers</h4>
                </div>

                <div class="table-responsive w-full mt-12">
                    <table class="table table-striped border-gray-200">
                        <thead class="bg-gray-50 text-gray-700 border-b-0 border-black">
                            <tr>
                                <th>Name</th>
                                <th>Email Address</th>
                                <th>Registered On</th>
                            </tr>
                        </thead>
                        <tbody class="accordion" id="accordionExample">
                            <tr v-for="user in users">
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.registered_on }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import Header from '../partials/__Header.vue';

export default {
    beforeRouteEnter() {
        if(localStorage.getItem("userRole") != 'admin') {
            window.location.href = "/stats";
        }
    },
    name: 'Users',
    components: {
        Header,
    },
    data() {
        return {
            loader: true,
            users: {}
        }
    },
    methods: {
        async getAwaitingSurveyUsers() {
            this.loader = true;

            await axios.get(`/api/users/awaiting-survey`, {
              headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
              }
            })
            .then(response => {
                this.users = response.data.data;

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
        console.log(localStorage.getItem('userRole'))
        this.getAwaitingSurveyUsers();
    },
    created() {}
}

</script>