<template>
  <MusicLayout>
    <template #title>
      <p>Créer Playlist</p>
    </template>
    <template #action>
      <Link :href="route('playlists.index')" class="text-black">Retour</Link>
    </template>
    <template #content>
      <form @submit.prevent="submit">
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
        <input
          type="submit"
          value="Enregistrer"
          class="bg-blue-500 hover:bg-blue-700 px-4 py-2 text-white rounded"
          :disabled="form.processing"
        />
        <div v-for="track in tracks" :key="track.uuid">
          <input
            type="checkbox"
            name="tracks"
            :id="track.uuid"
            :value="track.uuid"
            v-model="form.tracks"
          />
          <label :for="track.uuid">{{ track.title }}</label>
        </div>
      </form>
    </template>
  </MusicLayout>
</template>

<script>
import MusicLayout from "@/Layouts/MusicLayout.vue";

export default {
  name: "Index",
  components: {
    MusicLayout,
  },
  props: {
    tracks: Array,
  },
  data() {
    return {
      form: this.$inertia.form({
        title: "",
        tracks: [],
      }),
    };
  },
  methods: {
    submit() {
      this.form.post(route("playlists.store"));
    },
  },
};
</script>
