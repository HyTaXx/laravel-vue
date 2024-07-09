<template>
    <MusicLayout>
        <template #title>
            <p>lol</p>
        </template>
        <template #content>
            <div>
                <h1>Liste de mes tracks</h1>

                <!-- {{ tracks }} -->
                <div>
                    <ul>
                        <li v-for="track in tracks" :key="track.uuid">
                            {{ track.title }} - {{ track.artist }}
                        </li>
                    </ul>
                </div>
            </div>
        </template>
    </MusicLayout>
</template>

<script>
import MusicLayout from '@/Layouts/MusicLayout.vue';
export default {
    name: 'TrackIndex',
    components: {
        MusicLayout,
    },
    props: {
        tracks: {
            type: Array,
            required: true,
        },
    },
};
</script>