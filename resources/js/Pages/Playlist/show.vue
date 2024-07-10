<template>
  <MusicLayout>
    <template #title>
      <p>{{ playlist.title }}</p>
    </template>
    <template #action>
      <Link :href="route('playlists.index')" class="text-black">Retour</Link>
    </template>
    <template #content>
      <div>
        <input
          v-model="filter"
          type="text"
          placeholder="Search tracks..."
          class="p-2 mb-4 border rounded"
        />
        <div class="grid grid-cols-4 justify-center gap-8">
          <Track
            v-for="track in filteredTracks"
            :key="track.uuid"
            :track="track"
            :active="currentTrack === track.uuid"
            @played="play"
          />
        </div>
      </div>
    </template>
  </MusicLayout>
</template>
  
  <script>
import MusicLayout from "@/Layouts/MusicLayout.vue";
import { Link } from "@inertiajs/vue3";
import Track from "@/Components/Track.vue";

export default {
  name: "Show",
  components: {
    MusicLayout,
    Link,
    Track,
  },
  props: {
    playlist: Object,
    tracks: Array,
  },
  data() {
    return {
      audio: null,
      currentTrack: null,
      filter: "",
    };
  },
  computed: {
    filteredTracks() {
      return this.tracks.filter((track) =>
        track.title.toLowerCase().includes(this.filter.toLowerCase())
      );
    },
  },
  methods: {
    play(track) {
      const url = `storage/${track.music}`;

      if (!this.audio) {
        this.audio = new Audio(url);
        this.audio.play();
        this.currentTrack = track.uuid;
      } else if (this.currentTrack !== track.uuid) {
        this.audio.src = url;
        this.audio.play();
        this.currentTrack = track.uuid;
      } else {
        if (this.audio.paused) {
          this.audio.play();
        } else {
          this.audio.pause();
        }
      }

      this.audio.addEventListener("ended", () => {
        this.currentTrack = null;
      });
    },
  },
};
</script>
  