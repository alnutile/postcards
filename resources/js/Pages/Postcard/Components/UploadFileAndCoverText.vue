<template>
    <div>
        <form @submit.prevent="submit">
            <div class="space-y-4">
            <!-- Cover Text Input -->
            <div>
                <InputLabel for="recipient_name" value="Cover Text" />
                <TextInput id="recipient_name" v-model="form.cover_text"
                placeholder="OPTIONAL"
                type="text"
                class="mt-1 block w-full" required autofocus />
            </div>

            <!-- File Upload -->
            <div>
                <InputLabel for="recipient_name" value="Post Card Photo" />
                <div class="mt-1 flex items-center gap-3">
                    <button
                        type="button"
                        @click="$refs.fileInput.click()"
                        class="rounded bg-gray-200 px-3 py-1 text-sm font-medium uppercase"
                    >
                        Browse
                    </button>
                    <span class="text-sm text-gray-600">{{ fileName || 'No file selected' }}</span>
                    <input
                        ref="fileInput"
                        type="file"
                        @input="handleFileUpload"
                        class="hidden"
                        accept="image/*"
                    />

                </div>
                <div class="mt-2">
                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">
            {{ form.progress.percentage }}%
            </progress>
                </div>
            </div>
        </div>
        </form>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref, computed } from 'vue';

const props = defineProps({
    postcard: Object,
});

const form = useForm({
    file: null,
    cover_text: null,
});

const fileInput = ref(null);

const fileName = computed(() => {
    if (form.file) {
        return form.file.name;
    }
    return null;
});

const handleFileUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
        form.file = file;
    }

    console.log("submit");

    submit();
};

const submit = () => {
    form.post(route('postcards.upload-file', props.postcard), {
        forceFormData: true,
        onSuccess: () => {
            fileInput.value.value = null;
        },
    });
};
</script>

