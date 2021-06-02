<template>
  <div>
    <div
      class="
        w-screen
        h-screen
        fixed
        inset-0
        bg-gray-900
        opacity-75
        z-20
        transition-all
        duration-1000
      "
      @click="$emit('close')"
    ></div>
    <section
      class="p-4 absolute top-0 flex inset-x-0 justify-center mt-30 z-30"
    >
      <div class="z-50 fixed w-11/12 sm:w-1/3 mt-10 overflow-x-scroll">
        <div class="bg-white p-4">
          <h1 class="text-center text-3xl">Book Your Seat Now</h1>
          <input
            v-model="name"
            class="p-2 shadow border border-gray-900 w-full my-6"
            type="text"
            placeholder="Please, Enter Your Name"
          />
          <!-- Stripe Elements Placeholder -->
          <div id="card-element" class="p-3 border border-gray-900"></div>
          <input
            v-model="ticket_count"
            type="number"
            class="p-2 shadow border border-gray-900 w-full my-6 text-center"
            min="1"
            step="1"
          />
          <button class="bg-blue-700 text-white p-2 w-full" @click="process">
            <i
              v-if="isLoading"
              class="fas fa-spinner fa-spin text-gray-200"
            ></i>
            <p v-else>Pay ${{ price }}</p>
          </button>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  props: {
    amount: { type: Number, default: 0 },
    eventSlug: { type: String, default: '' },
  },
  data() {
    return {
      name: '',
      ticket_count: 1,
      cardElement: null,
      stripe: null,
      isLoading: false,
    }
  },
  computed: {
    price() {
      return this.amount * this.ticket_count
    },
  },
  mounted() {
    this.stripe = window.Stripe(process.env.STRIPE_ID)

    const elements = this.stripe.elements()
    this.cardElement = elements.create('card')
    this.cardElement.mount('#card-element')
  },
  methods: {
    process() {
      if (this.isLoading) return

      this.verifyCard()
    },
    async verifyCard() {
      this.isLoading = true
      const { paymentMethod, error } = await this.stripe.createPaymentMethod(
        'card',
        this.cardElement,
        {
          billing_details: {
            name: this.name,
            address: {
              city: 'test',
              country: 'US',
              line1: 'test',
              line2: 'test1',
              postal_code: '44660',
              state: '123',
            },
          },
        }
      )

      if (error) {
        this.isLoading = false
      } else {
        await this.chargeCustomer(paymentMethod)
        this.$emit('close')
        this.$router.push('/event')
        this.isLoading = false
      }
    },
    async chargeCustomer(paymentMethod) {
      await this.$axios.$post(`payment/${this.eventSlug}`, {
        paymentMethod,
        ticket_count: this.ticket_count,
      })
    },
  },
}
</script>

<style></style>
