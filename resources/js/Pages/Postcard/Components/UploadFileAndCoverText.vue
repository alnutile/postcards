<template>
    <div>
        <form @submit.prevent="submit">
            <div class="space-y-4">
            <!-- Cover Text Input -->
            <div>
                <InputLabel for="cover_text" value="Cover Text" />
                <TextInput
                    id="cover_text"
                    v-model="form.cover_text"
                    placeholder="OPTIONAL"
                    type="text"
                    class="mt-1 block w-full"
                    @input="debouncedSubmit"
                />
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
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref, computed, onMounted } from 'vue';
import { debounce } from 'lodash';

const props = defineProps({
    postcard: Object,
});

const form = useForm({
    file: null,
    cover_text: props.postcard?.cover_text || null,
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
        submit();
    }
};

const submit = () => {
    form.post(route('postcards.upload-file', props.postcard), {
        forceFormData: true,
        onSuccess: () => {
            fileInput.value.value = null;
        },
    });
};

const debouncedSubmit = debounce(() => {
    console.log('Debounced submit triggered', form.cover_text); // Debug log
    if (form.cover_text !== props.postcard.cover_text) {
        console.log('Submitting form...'); // Debug log
        form.post(route('postcards.upload-file', props.postcard), {
            preserveScroll: true,
            preserveState: true,
            only: ['postcard'],
        });
    }
}, 500);
</script>

