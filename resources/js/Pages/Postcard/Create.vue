<template>
    <AppLayout title="Create Your Postcard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Create Your Postcard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <form @submit.prevent="submit">
                        <PostcardForm v-model="form">
                            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Save
                            </PrimaryButton>
                        </PostcardForm>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PostcardForm from '@/Pages/Postcard/Components/Form.vue';
import { onMounted } from 'vue';
import { usePage, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
const props = defineProps({
    postcard: Object,
});


const form = useForm({
    recipient_name: '',
    street_1: '',
    street_2: '',
    city: '',
    state: '',
    zip_code: '',
    message: '',
});

onMounted(() => {
    if (usePage().props.env === 'local') {
        //fill in the form with dummy data
        form.recipient_name = 'John Doe';
        form.street_1 = '123 Main St';
        form.city = 'Anytown';
        form.state = 'CA';
        form.zip_code = '12345';
        form.message = 'Happy Birthday!';
    }
});

const submit = () => {
    form.post(route('postcards.store'));
};
</script>
