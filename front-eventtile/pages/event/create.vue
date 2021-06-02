<template>
  <div class="min-h-screen bg-gray-200">
    <div class="flex justify-center">
      <div class="rounded border shadow-sm p-4 my-12 w-10/12 bg-gray-600">
        <h1 class="text-center text-2xl">Create Event</h1>
        <form
          class="flex flex-wrap justify-center my-10"
          @submit.prevent="submit"
        >
          <div class="w-full flex flex-wrap justify-center mt-10">
            <input
              type="file"
              class="p-2 rounded border shadow-sm w-9/12"
              @change="handleFile"
            />
            <error-field :errors="errors" field="image" />
          </div>
          <div class="w-full flex flex-wrap justify-center mt-10">
            <input
              v-model="form.name"
              type="text"
              class="p-2 rounded border shadow-sm w-9/12"
              placeholder="Event Name Please"
            />
            <error-field :errors="errors" field="name" />
          </div>
          <div class="w-full flex flex-wrap justify-center mt-10">
            <div class="w-9/12 flex justify-between">
              <div class="w-5/12">
                <textarea
                  v-model="form.description"
                  class="p-2 rounded border shadow-sm w-full"
                  cols="30"
                  rows="3"
                  placeholder="Event Description"
                ></textarea>
                <error-field :errors="errors" field="description" />
              </div>
              <div class="w-5/12">
                <textarea
                  v-model="form.address"
                  class="p-2 rounded border shadow-sm w-full"
                  cols="30"
                  rows="3"
                  placeholder="Event Description"
                ></textarea>
                <error-field :errors="errors" field="address" />
              </div>
            </div>
          </div>

          <div class="w-full flex flex-wrap justify-center mt-10">
            <div class="w-9/12 flex justify-between">
              <div class="w-5/12">
                <input
                  v-model="form.ticket_price"
                  type="number"
                  class="p-2 rounded border shadow-sm w-full"
                  placeholder="Event Price"
                />
                <error-field :errors="errors" field="ticket_price" />
              </div>
              <div class="w-5/12">
                <input
                  v-model="form.ticket_remaining"
                  type="textarea"
                  class="p-2 rounded border shadow-sm w-full"
                  placeholder="Event Total Number of Ticket"
                />
                <error-field :errors="errors" field="ticket_remaining" />
              </div>
            </div>
          </div>

          <div class="w-full flex flex-wrap justify-center mt-10">
            <div class="w-9/12 flex justify-between">
              <div class="w-5/12">
                <label for="date" class="text-gray-600"
                  >Publish This Event</label
                >
                <input
                  v-model="form.published_at"
                  type="date"
                  class="p-2 rounded border shadow-sm w-full"
                  placeholder="Event Published Date"
                />
                <error-field :errors="errors" field="published_at" />
              </div>
              <div class="w-5/12">
                <label for="date" class="text-gray-600"
                  >Publish This Event</label
                >
                <input
                  v-model="form.date"
                  type="date"
                  class="p-2 rounded border shadow-sm w-full"
                  placeholder="Event Date"
                />
                <error-field :errors="errors" field="date" />
              </div>
            </div>
          </div>

          <div class="w-full flex justify-center mt-10">
            <input
              type="submit"
              class="
                p-2
                rounded
                border
                shadow-sm
                w-9/12
                bg-blue-600
                text-white
                font-semibold
                cursor-pointer
              "
              value="Create"
            />
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import ErrorField from '../../components/util/ErrorField.vue'
export default {
  components: { ErrorField },
  middleware: 'admin',
  data() {
    return {
      form: {
        image: '',
        name: '',
        description: '',
        address: '',
        ticket_price: '',
        ticket_remaning: '',
        published_at: '',
        date: '',
      },
      errors: {},
    }
  },
  methods: {
    handleFile(e) {
      this.form.image = e.target.files[0]
    },
    submit() {
      const NewForm = new FormData()

      Object.keys(this.form).forEach((key) => {
        NewForm.set(key, this.form[key])
      })
      this.$axios
        .$post('event', NewForm, {
          headers: {
            'content-type': 'multiform/form-data',
          },
        })
        .then((res) => {
          this.$router.push('/event')
        })
        .catch((e) => (this.errors = e.response.data.errors))
    },
  },
}
</script>

<style></style>
