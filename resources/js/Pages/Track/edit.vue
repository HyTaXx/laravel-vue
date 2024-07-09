<template>
  <MusicLayout>
    <template #title>
      <p>Modifier une musique</p>
    </template>
    <template #content>
      <form @submit.prevent="handleSubmit">
        <div class="mb-3">
          <label for="title" class="block gray-700 text-sm font-bold mb-2"
            >Titre</label
          >
          <input
            id="title"
            type="text"
            class="shadow border rounded py-2 px-3 appearance-none leading-tight"
            v-model="form.title"
          />
          <p class="text-red-500 text-xs italic">{{ form.errors.title }}</p>
        </div>

        <div class="mb-3">
          <label for="artist" class="block gray-700 text-sm font-bold mb-2"
            >Artiste</label
          >
          <input
            id="artist"
            type="text"
            class="shadow border rounded py-2 px-3 appearance-none leading-tight"
            v-model="form.artist"
          />
          <p class="text-red-500 text-xs italic">{{ form.errors.artist }}</p>
        </div>

        <div class="mb-3">
          <label class="block gray-700 text-sm font-bold mb-2"
            >Afficher la musique</label
          >
          <select name="display" id="display" v-model="form.display">
            <option value="true">Oui</option>
            <option value="false">Non</option>
          </select>
          <p class="text-red-500 text-xs italic">{{ form.errors.display }}</p>
        </div>

        <input
          type="submit"
          value="Enregistrer"
          class="bg-blue-500 hover:bg-blue-700 px-4 py-2 text-white rounded"
          :disabled="form.processing"
        />
      </form>

      {{ form }}
    </template>
  </MusicLayout>
</template>

<script>
import { useForm } from "@inertiajs/vue3";
import MusicLayout from "@/Layouts/MusicLayout.vue";

export default {
  name: "Edit",
  components: {
    MusicLayout,
  },
  props: {
    track: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      form: useForm({
        title: this.track.title,
        artist: this.track.artist,
        display: this.track.display ? "true" : "false",
      }),
    };
  },
  methods: {
    handleSubmit() {
      this.form.put(route("tracks.update", { track: this.track }));
    },
  },
};
</script>
