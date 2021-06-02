<template>
  <span
    v-if="errors[field]"
    class="w-9/12 text-xs text-red-700 font-semibold"
    >{{ errors[field][0] }}</span
  >
</template>

<script>
export default {
  props: ['errors', 'field'],
}
</script>

<style></style>
