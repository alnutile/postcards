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

                        <div class="text-white">
                            Coming Soon...
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
