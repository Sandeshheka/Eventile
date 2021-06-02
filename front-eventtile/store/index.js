export const state = () => ({
  loggedIn: false,
  user: {},
})

export const mutations = {
  setLoggin(state, payload) {
    state.loggedIn = true
    state.user = payload
  },
  logout(state) {
    state.loggedIn = false
  },
}

export const actions = {
  async nuxtServerInit({ commit }, { req }) {
    const token = this.$cookies.get('token')
    if (token) {
      const res = await this.$axios.$post('/me')
      commit('setLoggin', res)
    }
  },
}
