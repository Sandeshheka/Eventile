<template>
  <div class="min-h-screen bg-gray-200">
    <div class="flex justify-center">
      <div class="rounded border shadow-sm p-4 my-12 w-4/12 bg-gray-600">
        <h1 class="text-center text-2xl">Create Account</h1>
        <form
          class="flex flex-wrap justify-center my-10"
          @submit.prevent="submit"
        >
          <div class="w-full flex flex-wrap justify-center mt-10">
            <input
              v-model="form.name"
              type="text"
              class="p-2 rounded border shadow-sm w-9/12"
              placeholder="Your Name Please"
            />
            <error-field :errors="errors" field="name" />
          </div>
          <div class="w-full flex flex-wrap justify-center mt-10">
            <input
              v-model="form.email"
              type="email"
              class="p-2 rounded border shadow-sm w-9/12"
              placeholder="Your Email Please"
            />
            <error-field :errors="errors" field="email" />
          </div>
          <div class="w-full flex flex-wrap justify-center mt-10">
            <input
              v-model="form.password"
              type="password"
              class="p-2 rounded border shadow-sm w-9/12"
              placeholder="Your Password Please"
            />
            <error-field :errors="errors" field="password" />
          </div>
          <div class="w-full flex flex-wrap justify-center mt-10">
            <input
              v-model="form.password_confirmation"
              type="password"
              class="p-2 rounded border shadow-sm w-9/12"
              placeholder="Re-Type Password Please"
            />
            <error-field :errors="errors" field="password_confirmation" />
          </div>
          <div class="w-full flex justify-center mt-10">
            <input
              type="submit"
              class="
                p-2
                rounded
                border
                shadow-sm
                w-9/12
                bg-blue-600
                text-white
                font-semibold
                cursor-pointer
              "
              value="Register"
            />
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import ErrorField from '../components/util/ErrorField.vue'
export default {
  components: { ErrorField },
  data() {
    return {
      form: {
        email: 'sandy@heka.com',
        name: 'heka',
        password: '123456789',
        password_confirmation: '123456789',
      },
      errors: {},
    }
  },
  methods: {
    submit() {
      this.$axios
        .$post('register', this.form)
        .then((res) =>
          /* eslint-disable */
  
          this.$router.push('/login')
        )
        .catch((e) => (this.errors = e.response.data.errors))
    },
  },
}
</script>

<style></style>
