<template>
    <AppLayout title="Create Your Postcard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Shared Postcard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="grid grid-cols-2 gap-4 p-6">

<div>
    <div>
        <InputLabel for="recipient_name" value="Recipient Name" />
        <TextInput id="recipient_name" v-model="postcard.recipient_name" type="text"
            class="mt-1 block w-full" required autofocus />
    </div>

    <div class="mt-4">
        <InputLabel for="street1" value="Street 1" />
        <TextInput id="street1" v-model="postcard.street_1" type="text" class="mt-1 block w-full" required />
    </div>

    <div class="mt-4">
        <InputLabel for="street2" value="Street 2" />
        <TextInput id="street2" v-model="postcard.street_2" type="text" class="mt-1 block w-full"
            placeholder="OPTIONAL" />
    </div>

    <div class="mt-4 grid grid-cols-2 gap-4">
        <div>
            <InputLabel for="city" value="City" />
            <TextInput id="city" v-model="postcard.city" type="text" class="mt-1 block w-full" required />
        </div>

        <div>
            <InputLabel for="state" value="State" />
            <TextInput id="state" v-model="postcard.state" type="text" class="mt-1 block w-full" required />
        </div>
    </div>

    <div class="mt-4">
        <InputLabel for="zip_code" value="Zip Code" />
        <TextInput id="zip_code" v-model="postcard.zip_code" type="text" class="mt-1 block w-full"
            required />
    </div>

    <div class="mt-4">
        <InputLabel for="message" value="Message" />
        <textarea id="message" v-model="postcard.message"
            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
            required rows="4" />
    </div>
</div>


<div class="bg-blue-400 rounded-lg p-6">
    <h3>Preview</h3>
</div>

</div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/Guest.vue';
const props = defineProps({
    postcard: Object,
});

</script>
