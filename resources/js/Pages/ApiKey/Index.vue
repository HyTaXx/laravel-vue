<template>
    <div>
        <h1>My API Keys</h1>
        <Link :href="route('api-keys.create')" class="custom-link">Create API Key</Link>
        <table class="table">
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
                   <td><Link :href="route('api-keys.destroy', { apiKey: apiKey })" method="delete" as="button">Delete API Key</Link></td>
                </tr>
            </tbody>
        </table>
    </div>
 </template>

<script>
    export default {
        props: {
            apiKeys: Array,
        },
    }
</script>