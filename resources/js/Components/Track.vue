<template>
  <div
    class="flex flex-col items-center gap-4 p-4 bg-gray-900 rounded-lg shadow-lg hover:bg-gray-800 transition-colors duration-300 w-[400px]"
    :class="{ border: active, 'border-blue-600': active }"
  >
    <img :src="'storage/' + track.image" alt="Album Art" class="rounded-lg" />
    <div class="flex flex-col flex-grow">
      <h1 class="text-white font-semibold text-lg">{{ track.title }}</h1>
      <p class="text-gray-400">{{ track.artist }}</p>
    </div>
    <div class="w-full flex flex-row justify-between">
      <button
        @click="handleClick"
        class="bg-orange text-white px-4 py-2 rounded-full shadow hover:bg-green-400 transition-colors duration-300"
      >
        Play
      </button>
      <Link
        :href="route('tracks.edit', { track: track })"
        class="text-white bg-lime-600 hover:bg-lime-700 px-4 py-2 rounded-full shadow transition-colors duration-300"
        >Modifier</Link
      >
      <Link
        :href="route('tracks.destroy', { track: track })"
        class="text-white bg-red-600 hover:bg-red-700 px-4 py-2 rounded-full shadow transition-colors duration-300"
        as="button"
        method="delete"
        >Supprimer</Link
      >
    </div>
  </div>
</template>

<script setup>
import { defineProps, defineEmits } from "vue";

const props = defineProps({
  active: {
    type: Boolean,
    default: false,
  },
  track: {
    type: Object,
  },
});

const emit = defineEmits(["played"]);

const handleClick = () => {
  emit("played", props.track);
};
</script>
