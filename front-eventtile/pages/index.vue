<template>
  <section>
    <div class="flex flex-wrap justify-center p-12">
      <h1 class="text-4xl">Welcome To Eventile Project</h1>
    </div>
    <div class="flex flex-wrap w-full justify-center">
      <button
        class="p-2 w-1/12 bg-white-900 text-black rounded border shadow-sm"
        @click="eventOpen"
      >
        Show Event
      </button>
    </div>
  </section>
</template>

<script>
export default {
  middleware: 'auth',
  methods: {
    eventOpen() {
      this.$router.push('/event')
    },
  },
}
</script>

<style></style>
