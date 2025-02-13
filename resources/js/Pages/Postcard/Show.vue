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
                            <SecondaryButton
                                type="button"
                                @click="copyLink"
                                class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Copy Link
                            </SecondaryButton>
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
import { usePage, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
const props = defineProps({
    postcard: Object,
});


const form = useForm(props.postcard);

const submit = () => {
    form.post(route('postcards.store'));
};

const copyLink = () => {
    axios.get(route('postcards.copy-link', props.postcard)).then(response => {
        console.log(response.data.url);
        //navigator.clipboard.writeText(response.data.url);
    });
};
</script>
