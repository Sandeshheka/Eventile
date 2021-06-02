export default function ({ store, redirect, app }) {
  const isAdmin = !!store.state.user.isAdmin
  if (!isAdmin) {
    return redirect('/')
  }
}
