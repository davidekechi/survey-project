<template>
    <div class="h-[100vh] border grid items-center px-8 lg:px-[35%]">
        <div>
            <h4 class="mb-8 text-2xl font-extrabold flex justify-center">SURVEY PROJECT</h4>
            <form @submit.prevent="register" class="border border-black p-8 rounded-lg shadow">

                <div class="mt-4">
                  <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                  <input
                    id="name"
                    v-model="formData.name"
                    type="name"
                    required
                    autofocus
                    class="block mt-1 w-full border border-black p-2 rounded-md"
                  />
                </div>

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

                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" v-model="formData.admin" class="rounded border-gray-300 !text-black focus:ring-indigo-500">
                        <span class="ms-2 text-sm text-gray-600">Make admin?</span>
                    </label>
                </div>

                <!-- Forgot Password & Login Button -->
                <div class="flex items-center justify-between mt-8">
                    <button type="submit" class="px-4 py-2 bg-black text-white text-sm rounded w-full">
                        Register
                    </button>
                </div>
                <p class="mt-2"><a class="underline text-sm text-black rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="/login">
                    Already registered?
                </a></p>
            </form>
        </div>
    </div>
</template>

<script>

export default {
    name: 'Register',
    data() {
        return {
            formData: {
                name: "",
                email: "",
                password: "",
                admin: false
            },
            errorMessage: ''
        }
    },
    methods: {
        async register() {
            this.errorMessage = '';

            await axios.post('/api/register', this.formData)
            .then(response => {
                localStorage.setItem('token', response.data.token);
                localStorage.setItem('userRole', response.data.role);
                window.location.href = "/";
            })
            .catch(error => {
                this.errorMessage = "This email already exists!";
            });
        }
    },
    mounted () {
    },
    created() {}
}

</script>