<template>
  <nav class="p-4 shadow bg-yellow-700 text-white">
    <div class="flex justify-between">
      <nuxt-link to="/"> Home </nuxt-link>
      <div v-if="loggedIn" class="flex">
        <nuxt-link to="/payment-ticket">
          <a class="mx-2">Payment & Tickets</a>
        </nuxt-link>

        <p>Welcome, {{ user.name }}</p>
        <a href="" class="ml-2" @click.prevent="logout">Logout</a>
      </div>

      <div v-else>
        <nuxt-link to="/login" class="mx-2">Login</nuxt-link>
        <nuxt-link to="/register" class="mx-2">Register</nuxt-link>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  computed: {
    loggedIn() {
      return this.$store.state.loggedIn
    },
    user() {
      return this.$store.state.user
    },
  },

  methods: {
    logout() {
      this.$axios.post('/logout').then((res) => {
        this.$cookies.remove('token')
        this.$store.commit('logout')
        this.$router.push('/login')
      })
    },
  },
}
</script>

<style></style>
