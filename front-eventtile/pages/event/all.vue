<template>
  <div class="flex flex-wrap justify-center">
    <h1 class="w-10/12 my-2 text-xl">All New Event</h1>
    <section
      v-for="(event, i) in events"
      :key="i"
      class="w-10/12 p-5 my-2 bg-gray-100 rounded shadow"
    >
      <nuxt-link :to="`/event/${event.slug}`" class="flex justify-between">
        <div class="w-full">
          <p>{{ event.name }}</p>
          <p class="text-gray-700 text-xs mt-4">{{ event.date }}</p>
          <p class="text-gray-700 text-xs mt-4">{{ event.address }}</p>
        </div>

        <img
          :src="event.image"
          class="w-64 h-32 border border-gray-200 ml-4"
          alt="event image"
        />
      </nuxt-link>
    </section>
  </div>
</template>

<script>
export default {
  middleware: 'admin',
  async asyncData({ $axios, params }) {
    const { data } = await $axios.$get('event/all')
    return { events: data }
  },
}
</script>

<style></style>
