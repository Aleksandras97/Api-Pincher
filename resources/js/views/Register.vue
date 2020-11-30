<template>
    <div class="md:pt-8 pb-6 px-2 md:px-0 bg-white">
    <div class="gb-white max-w-lg mx-auto">
        <a href="">
            <h1 class="text-4xl font-bold text-black text-center">Register</h1>
        </a>
    </div>

    <div class="gb-white max-w-lg mx-auto p-8 md:p-8 my-5">
        <section>
            <h3 class="font-bold text-2xl">Welcome to Pincher</h3>
            <p class="text-gray-700 pt-2">Register for new account</p>
        </section>

        <section class="mt-10">
            <Form action="#" class="flex flex-col" @submit="register">

                <div v-if="state.serverErrors" class="form-error">

                  <div v-for="(value, key) in state.serverErrors" :key="key">
                      {{ value[0] }}
                  </div>
                </div>

                <div class="pt-3 rounded bg-gray-200">
                  <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="username">Username</label>
                  <Field :rules="isRequired" as="input" name="username" class="login-input" v-model="state.username" autocomplete="off" />

                </div>
                <ErrorMessage class="form-error" name="username" />

                <div class="pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="name">Name</label>
                    <Field :rules="isRequired" as="input" name="name" class="login-input" v-model="state.name" autocomplete="off" />

                </div>
                <ErrorMessage class="form-error" name="name" />

                <div class="pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="email">Email</label>
                    <Field :rules="validateEmail" as="input" name="email" class="login-input" autocomplete="off" v-model="state.email" />
                </div>
                <ErrorMessage class="form-error" name="email" />

                <div class="pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="password">Password</label>
                    <Field type="password" :rules="validate" as="input" name="password" class="login-input" v-model="state.password" />
                </div>
                <ErrorMessage class="form-error" name="password" />


                <button class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200">Register</button>
            </Form>
        </section>
    </div>

    <div class=" max-w-lg mx-auto text-center mt-12 mb-6">
        <p class="text-black">Already have an account?  <router-link class="font-bold hover:underline" :to="{ name: 'Login'}" exact>Log In</router-link>
        </p>
    </div>
</div>
</template>

<script>
import { reactive } from 'vue'
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import { Field, Form, ErrorMessage  } from 'vee-validate';

export default {
    components: {
      Field,
      Form,
      ErrorMessage,
    },
    setup(){
        const store = useStore();
        const router = useRouter();

        const state = reactive({
            username: '',
            name: '',
            email: '',
            password: '',
            serverErrors: '',
        });

        function register() {
            store.dispatch('register', {
                username: state.username,
                name: state.name,
                email: state.email,
                password: state.password,
            })
                .then(response => {
                    router.push({ name: 'Login'})
                })
                .catch(error => {
                  state.serverErrors = Object.values(error.response.data.errors)
                })
        }

        function isRequired(value) {
          return value ? true : 'This field is required';
        }

        function validate(value) {
          if (!value) {
            return 'This field is required';
          }

          if (value.length < 6) {
            return 'The password must be at least 6 characters.';
          }

          return true;
        }

        function validateEmail(value) {
          // if the field is empty
          if (!value) {
            return 'This field is required';
          }

          // if the field is not a valid email
          if (!/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i.test(value)) {
            return 'This field must be a valid email';
          }

          // All is good
          return true;
        }

        return {
            state,
            register,
            isRequired,
            validateEmail,
            validate,
        }
    }
}
</script>
