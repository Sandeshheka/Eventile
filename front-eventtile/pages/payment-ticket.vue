<template>
  <div>
    <section>
      <h1>Tickets</h1>
      <div v-for="(ticket, i) in tickets" :key="i">
        <p>Tickets : {{ ticket.ticket_count }}</p>
      </div>
    </section>
    <section>
      <h1>Payments</h1>
      <div v-for="(payment, i) in payments" :key="i">
        <p>payment : {{ payment.payment_id }}</p>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  async asyncData({ query, $axios, redirect, app }) {
    const data = await $axios.$get(`/payment`)
    const tickets = await $axios.$get(`/ticket`)
    return { payments: data.data, tickets: tickets.data }
  },
}
</script>

<style></style>
