<template>
  <div>Working..........</div>
</template>

<script>
export default {
  asyncData({ query, $axios, redirect, app }) {
    return $axios.$post(`/login/github/callback`, query).then((res) => {
      app.$cookies.set('token', res)
      app.store.commit('setLoggin')
      $axios.defaults.headers.common.authorization = `Bearer ${res}`
      redirect('/')
    })
  },
}
</script>

<style></style>
