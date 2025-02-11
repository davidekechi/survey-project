<template>
    <div class="flex justify-between">
        <h1 class="text-3xl font-bold mb-2">Hello {{ user.name }},</h1>
        <button class="bg-black text-white px-4 !h-8 rounded text-sm" @click="signOut">Logout</button>
    </div>
</template>

<script>

export default {
    name: 'Header',
    data() {
        return {
            user: {},
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