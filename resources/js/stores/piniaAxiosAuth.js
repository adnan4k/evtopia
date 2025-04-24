import axios from 'axios'

export default function piniaAxiosAuth({ store }) {
  if (store.$id !== 'authStore') return

  applyHeader(store.token)

  store.$subscribe((_mutation, state) => {
    applyHeader(state.token)
  })

  function applyHeader(bearer) {
    if (bearer) {
      axios.defaults.headers.common.Authorization = bearer
    } else {
      delete axios.defaults.headers.common.Authorization
    }
  }
}
