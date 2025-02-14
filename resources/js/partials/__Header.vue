<template>
    <div class="flex justify-between">
        <h1 class="text-3xl font-bold mb-2">Hello {{ user.name }},</h1>
        <div class="flex">
                <a v-if="isAdmin && this.$route.name != 'UsersAwaiting'" class="text-sm underline mt-1" href="/awaiting">Awaiting Surveys</a>
                <div v-if="isAdmin && this.$route.name == 'UsersAwaiting'">
                    <a v-if="!canViewResults" class="text-sm underline mt-1" href="/">Take Survey</a>
                    <a v-if="canViewResults" class="text-sm underline mt-1" href="/stats">View Results</a>
                </div>
            <button class="bg-black text-white px-4 !h-8 rounded text-sm ml-4" @click="signOut">Logout</button>
        </div>
    </div>
</template>

<script>

export default {
    name: 'Header',
    data() {
        return {
            user: {},
            isAdmin: localStorage.getItem('userRole') == 'admin',
            canViewResults: localStorage.getItem("redirectTo") == '/stats'
        }
    },
    methods: {
        async getUser() {
            await axios.get('/api/user', {
              headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
              }
            })
            .then(response => {
                this.user = response.data;
            })
            .catch(error => {
                this.signOut();
            });
        },

        async signOut() {
            await axios.post('/api/logout', this.user, {
              headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
              }
            })
            .then(response => {
                localStorage.removeItem("token");
                localStorage.removeItem('redirectTo');
                window.location.href = "/login";
            })
            .catch(error => {
                console.log(error)
            });
        }
    },
    mounted () {
        this.getUser();
    },
    created() {}
}

</script>