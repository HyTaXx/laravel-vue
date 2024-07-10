<template>
  <MusicLayout>
    <template #title>
      <p>Liste de mes Playlist</p>
    </template>
    <template #action>
      <Link :href="route('playlists.create')" class="text-black"
        >Créer une Playlist</Link
      >
    </template>
    <template #content>
      <p>playlists</p>
      <ul>
        <li v-for="playlist in playlists" :key="playlist.id">
          {{ playlist.title }}
        </li>
      </ul>

      <table class="table-auto">
        <thead>
          <tr>
            <th>#</th>
            <th>Titre</th>
            <th>Nombre de musiques</th>
            <th>Créée le</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(playlist, i) in playlists" :key="playlist.id">
            <td>{{ i + 1 }}</td>
            <td>{{ playlist.title }}</td>
            <td>{{ playlist.tracks_count }} musiques</td>
            <td>
              {{ $moment(playlist.created_at).format("DD/MM/YYYY hh:mm:ss") }}
            </td>
            <td>
              <Link
                :href="route('playlists.show', playlist.id)"
                class="text-blue-500"
                >Voir</Link
              >
            </td>
          </tr>
        </tbody>
      </table>
    </template>
  </MusicLayout>
</template>

<script>
import MusicLayout from "@/Layouts/MusicLayout.vue";
import { Link } from "@inertiajs/vue3";

export default {
  name: "PlaylistIndex",
  components: {
    MusicLayout,
    Link,
  },
  props: {
    playlists: Array,
  },
};
</script>
