<template>
    <MusicLayout>
        <template #title>
            <p>Liste de mes tracks</p>
        </template>
        <template #action>
            <Link :href="route('tracks.create')" class="text-black">Créer une musique</Link>
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
                    <Track v-for="track in filteredTracks" :key="track.uuid" :track="track" @played="play" />
                </div>
            </div>
        </template>
    </MusicLayout>
</template>

<script>
import MusicLayout from '@/Layouts/MusicLayout.vue';
import Track from '@/Components/Track.vue';
import { Link } from '@inertiajs/vue3';

export default {
    name: 'TrackIndex',
    components: {
        MusicLayout,
        Track,
        Link
    },
    props: {
        tracks: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            audio: null,
            currentTrack: null,
            filter: '',
        };
    },
    computed: {
        filteredTracks() {
            const query = this.filter.toLowerCase();
            return this.tracks.filter(track =>
                track.title.toLowerCase().includes(query) ||
                track.artist.toLowerCase().includes(query)
            );
        }
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

            this.audio.addEventListener('ended', () => {
                this.currentTrack = null;
            });
        }
    }
};
</script>
