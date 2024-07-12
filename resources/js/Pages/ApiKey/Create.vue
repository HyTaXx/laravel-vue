<template>
    <MusicLayout>
        <template #title>
            <p>Create an API Key</p>
        </template>
        <template #content>
            <div>
                <Link :href="route('api-keys')" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-900">Back to API Keys</Link>
                <form @submit.prevent="submit" class="flex flex-col w-[700px] mt-2">
                    <label for="name">Name for api key</label>
                    <input type="text" name="name" id="name" v-model="form.name">
                    <input type="submit" value="submit" class="w-[120px] bg-blue-700 text-white px-4 py-2 rounded mt-2 hover:bg-blue-900 hover:cursor-pointer">
                </form>
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
        data() {
           return {
               form: this.$inertia.form({
                    'name': '',
               })
           }
       },
         methods: {
              submit() {
                this.form.post(route('api-keys.store'))
              }
         }
    }
</script>