<template>
  <div class="flex flex-wrap justify-center p-2">
    <section class="w-8/12 p-1">
      <div class="bg-gray-100 p-2 shadow-md rounded">
        <div class="flex justify-center w-full">
          <img :src="event.image" :alt="event.name" width="400" />
        </div>
        <p class="text-2xl">About</p>
        <p class="text-sm">{{ event.description }}</p>
      </div>
    </section>
    <section class="w-3/12 p-1">
      <div class="bg-gray-100 p-2 shadow-md rounded">
        <h1 class="text-2xl">{{ event.name }}</h1>
        <div class="p-2 my-2">
          <p class="text-sm my-4">
            <i class="fas fa-map-marker w-5 mr-2"></i>{{ event.address }}
          </p>
          <p class="text-sm my-4">
            <i class="fas fa-calendar-alt w-5 mr-2"></i>{{ event.date }}
          </p>
          <p class="text-sm my-4">
            <i class="fas fa-money-bill-wave w-5 mr-2"></i>
            $ {{ event.ticket_price }}
          </p>
          <p class="text-sm">
            <i class="fas fa-adjust w-5 mr-2"></i> {{ event.ticket_remaining }}
          </p>
          <button
            class="w-full bg-green-600 rounded shadow p-2 text-white my-6"
            @click="openPayModal"
          >
            Book Now
          </button>
          <pay-now
            v-if="isPayOpen"
            :amount="event.ticket_price"
            :event-slug="event.slug"
            @close="isPayOpen = false"
          />
          <i v-if="isAdmin" class="fas fa-edit" @click="moveToEdit"></i>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import PayNow from '../../../components/payment/PayNow'
export default {
  components: { PayNow },
  async asyncData({ $axios, params }) {
    const { data } = await $axios.$get(`event/${params.show}`)
    return { event: data }
  },
  data() {
    return {
      isPayOpen: false,
    }
  },
  head() {
    return {
      script: [
        {
          src: 'https://js.stripe.com/v3/',
        },
      ],
    }
  },
  computed: {
    isAdmin() {
      return this.$store.state.user.isAdmin
    },
    isLoggedIn() {
      return this.$store.state.loggedIn
    },
  },

  methods: {
    moveToEdit() {
      this.$router.push(`/event/${this.$route.params.show}/edit`)
    },
    openPayModal() {
      if (!this.isLoggedIn) {
        this.$router.push(`/login?redirect=${this.$route.fullPath}`)
        return
      }
      this.isPayOpen = true
    },
  },
}
</script>

<style></style>
