<template>
  <MusicLayout>
    <template #title>
      <p>Creer une musique</p>
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

        <div class="mb-3">
          <label for="image" class="block gray-700 text-sm font-bold mb-2"
            >Image</label
          >
          <input
            id="image"
            type="file"
            name="image"
            class="shadow border rounded py-2 px-3 appearance-none leading-tight"
            @input="form.image = $event.target.files[0]"
          />
          <p class="text-red-500 text-xs italic">{{ form.errors.image }}</p>
        </div>

        <div class="mb-3">
          <label for="music" class="block gray-700 text-sm font-bold mb-2"
            >Music</label
          >
          <input
            id="music"
            type="file"
            name="music"
            class="shadow border rounded py-2 px-3 appearance-none leading-tight"
            @input="form.music = $event.target.files[0]"
          />
          <p class="text-red-500 text-xs italic">{{ form.errors.music }}</p>
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
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import MusicLayout from "@/Layouts/MusicLayout.vue";

export default {
  name: "Create",
  components: {
    MusicLayout,
  },
  data() {
    return {
      form: useForm({
        title: "",
        artist: "",
        music: null,
        image: null,
        display: "true", // Ensure display is treated as string to match select options
      }),
    };
  },
  methods: {
    handleSubmit() {
      this.form.post(route("tracks.store"));
    },
  },
};
</script>
  