export default ({ app }) => {
  const token = app.$cookies.get('token')
  app.$axios.defaults.headers.common.authorization = `Bearer ${token}`
}
