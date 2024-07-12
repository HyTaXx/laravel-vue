<template>
    <MusicLayout>
        <template #title>
            <p>My API Keys</p>
        </template>
        <template #content>
            <div>
                <Link :href="route('api-keys.create')" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-900">Create API Key</Link>
                <table class="table mt-5">
                    <thead>
                        <tr>
                        <th>Name</th>
                        <th>Key</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="apiKey in apiKeys" :key="apiKey.id">
                        <td>{{ apiKey.name }}</td>
                        <td>{{ apiKey.key }}</td>
                        <td><Link :href="route('api-keys.destroy', { apiKey: apiKey })" method="delete" as="button" class="bg-red-500 rounded px-4 py-2 text-white hover:bg-red-700">Delete API Key</Link></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </template>
    </MusicLayout>
 </template>

<script>
    import MusicLayout from '@/Layouts/MusicLayout.vue'
    export default {
        components: {
            MusicLayout,
        },
        props: {
            apiKeys: Array,
        },
    }
</script>