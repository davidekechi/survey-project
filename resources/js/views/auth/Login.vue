<template>
    <div class="h-[100vh] border grid items-center px-8 lg:px-[35%]">
        <div>
            <h4 class="mb-8 text-2xl font-extrabold flex justify-center">SURVEY PROJECT</h4>
            <form @submit.prevent="login" class="border border-black p-8 rounded-lg shadow">
                <!-- Email Address -->
                <div class="mt-4">
                  <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                  <input
                    id="email"
                    v-model="formData.email"
                    type="email"
                    required
                    autofocus
                    class="block mt-1 w-full border border-black p-2 rounded-md"
                  />
                  <p v-if="errorMessage" class="text-red-500 text-sm mt-1">{{ errorMessage }}</p>
                </div>

                <!-- Password -->
                <div class="mt-4">
                  <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                  <input
                    id="password"
                    v-model="formData.password"
                    type="password"
                    required
                    class="block mt-1 w-full border border-black p-2 rounded-md"
                  />
                </div>

                <!-- Forgot Password & Login Button -->
                <div class="flex items-center justify-between mt-8">
                    <button type="submit" class="px-4 py-2 bg-black text-white text-sm rounded w-full">
                        Log in
                    </button>
                </div>
                <p class="mt-2 text-sm">New? <a class="underline text-black rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="/register">
                    Register now
                </a></p>
            </form>
        </div>
    </div>
</template>

<script>

export default {
    name: 'Login',
    data() {
        return {
            formData: {
                email: "",
                password: "",
            },
            errorMessage: ''
        }
    },
    methods: {
        async login() {
            this.errorMessage = ''; // Reset errors

            await axios.post('/api/login', this.formData)
            .then(response => {
                localStorage.setItem('token', response.data.token); // Store token
                window.location.href = response.data.redirect_to;
            })
            .catch(error => {
                this.errorMessage = "This email or password is invalid!";
            });
        }
    },
    mounted () {},
    created() {}
}

</script>