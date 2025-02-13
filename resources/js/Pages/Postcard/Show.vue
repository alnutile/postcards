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

        <ToastProvider>


    <ToastRoot
      v-model:open="open"
      class="bg-white rounded-md shadow-[hsl(206_22%_7%_/_35%)_0px_10px_38px_-10px,_hsl(206_22%_7%_/_20%)_0px_10px_20px_-15px] p-[15px] grid [grid-template-areas:_'title_action'_'description_action'] grid-cols-[auto_max-content] gap-x-[15px] items-center data-[state=open]:animate-slideIn data-[state=closed]:animate-hide data-[swipe=move]:translate-x-[var(--radix-toast-swipe-move-x)] data-[swipe=cancel]:translate-x-0 data-[swipe=cancel]:transition-[transform_200ms_ease-out] data-[swipe=end]:animate-swipeOut"
    >
      <ToastTitle class="[grid-area:_title] mb-[5px] font-medium text-slate12 text-[15px]">
       Woot! Share Your Postcard the link is Copied to clipboard
      </ToastTitle>
    </ToastRoot>
    <ToastViewport class="[--viewport-padding:_25px] fixed bottom-0 right-0 flex flex-col p-[var(--viewport-padding)] gap-[10px] w-[390px] max-w-[100vw] m-0 list-none z-[2147483647] outline-none" />

        </ToastProvider>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PostcardForm from '@/Pages/Postcard/Components/Form.vue';
import { usePage, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { ToastAction, ToastDescription, ToastProvider, ToastRoot, ToastTitle, ToastViewport } from 'radix-vue'
import { ref } from 'vue';

const props = defineProps({
    postcard: Object,
});
const open = ref(false)

const form = useForm(props.postcard);

const submit = () => {
    form.post(route('postcards.store'));
};

const copyLink = () => {
    axios.get(route('postcards.copy-link', props.postcard)).then(response => {
        const url = response.data.url;

        // Try using clipboard API first
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(url);
        } else {
            // Fallback: Create temporary textarea element
            const textarea = document.createElement('textarea');
            textarea.value = url;
            textarea.style.position = 'fixed';  // Avoid scrolling to bottom
            textarea.style.opacity = '0';
            document.body.appendChild(textarea);
            textarea.select();

            try {
                document.execCommand('copy');
                textarea.remove();
            } catch (err) {
                console.error('Failed to copy text:', err);
            }
        }

        open.value = true;

    });
};
</script>
