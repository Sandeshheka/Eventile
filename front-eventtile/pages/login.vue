<template>
  <div class="min-h-screen bg-gray-200">
    <div class="flex justify-center">
      <div class="rounded border shadow-sm p-4 my-12 w-4/12 bg-gray-600">
        <h1 class="text-center text-2xl">Login</h1>
        <div class="flex flex-wrap w-full justify-center">
          <button
            class="p-2 w-9/12 bg-gray-900 text-white"
            @click="socialLogin"
          >
            Login With Github
          </button>
        </div>
        <form class="flex flex-wrap justify-center" @submit.prevent="submit">
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
              value="Login"
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
  middleware: 'guest',
  data() {
    return {
      form: {
        email: '',

        password: '',
      },
      errors: {},
    }
  },
  methods: {
    submit() {
      this.$axios.$post('login', this.form).then((res) => {
        this.$cookies.set('token', res)

        this.$axios.defaults.headers.common.authorization = `Bearer ${res}`
        this.$axios.$post('/me').then((res) => {
          this.$store.commit('setLoggin', res)
          if (this.$route.query.redirect) {
            this.$router.push(this.$route.query.redirect)
          } else {
            this.$router.push('/')
          }
        })
      })
      // .catch((e) => (this.errors = e.response.data.errors))
    },
    socialLogin() {
      this.$axios.$get('login/github').then((res) => {
        window.location.href = res
      })
    },
  },
}
</script>

<style></style>
