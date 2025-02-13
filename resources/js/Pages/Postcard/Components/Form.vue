<template>
    <div>

        <div class="grid grid-cols-2 gap-4 p-6">

            <div v-auto-animate>
                <div
                v-if="toggleStateSingle === 'front'"
                v-auto-animate>
                    <div>
                        <InputLabel for="recipient_name" value="Recipient Name" />
                        <TextInput id="recipient_name" v-model="modelValue.recipient_name" type="text"
                            class="mt-1 block w-full" required autofocus />
                        <InputError class="mt-2" :message="modelValue.errors.recipient_name" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="street1" value="Street 1" />
                        <TextInput id="street1" v-model="modelValue.street_1" type="text" class="mt-1 block w-full"
                            required />
                        <InputError class="mt-2" :message="modelValue.errors.street_1" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="street2" value="Street 2" />
                        <TextInput id="street2" v-model="modelValue.street_2" type="text" class="mt-1 block w-full"
                            placeholder="OPTIONAL" />
                        <InputError class="mt-2" :message="modelValue.errors.street_2" />
                    </div>

                    <div class="mt-4 grid grid-cols-2 gap-4">
                        <div>
                            <InputLabel for="city" value="City" />
                            <TextInput id="city" v-model="modelValue.city" type="text" class="mt-1 block w-full"
                                required />
                            <InputError class="mt-2" :message="modelValue.errors.city" />
                        </div>

                        <div>
                            <InputLabel for="state" value="State" />
                            <TextInput id="state" v-model="modelValue.state" type="text" class="mt-1 block w-full"
                                required />
                            <InputError class="mt-2" :message="modelValue.errors.state" />
                        </div>
                    </div>

                    <div class="mt-4">
                        <InputLabel for="zip_code" value="Zip Code" />
                        <TextInput id="zip_code" v-model="modelValue.zip_code" type="text" class="mt-1 block w-full"
                            required />
                        <InputError class="mt-2" :message="modelValue.errors.zip_code" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="message" value="Message" />
                        <textarea id="message" v-model="modelValue.message"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            required rows="4" />
                        <InputError class="mt-2" :message="modelValue.errors.message" />
                    </div>
                </div>
                <div v-else>

                    <div v-if="!modelValue?.id">
                        <div class="flex-1 flex items-center justify-center text-gray-300 text-xl">Please save your postcard to add a file to it</div>
                    </div>
                    <div v-else>
                        <UploadFileAndCoverText :postcard="modelValue" />
                    </div>
                </div>
            </div>


            <div class="bg-blue-400 rounded-lg p-6">
                <h3 class="text-blue-200 text-2xl font-bold flex justify-center">Preview</h3>


                <div class="mt-4 bg-white p-4 aspect-[1.4/1] flex" v-auto-animate>
                    <template v-if="toggleStateSingle === 'front'">
                        <div class="w-1/2 flex flex-col">
                            <div class="flex-1 border-r border-gray-300 p-4 flex items-center">
                                {{ modelValue.message }}
                            </div>
                        </div>
                        <div class="w-1/2">
                            <div class="p-4 border-l border-gray-300 h-full flex flex-col justify-center">
                                <p class="font-medium">{{ modelValue.recipient_name }}</p>
                                <p>{{ modelValue.street_1 }}</p>
                                <p v-if="modelValue.street_2">{{ modelValue.street_2 }}</p>
                                <p>{{ modelValue.city }}, {{ modelValue.state }} {{ modelValue.zip_code }}</p>
                            </div>
                        </div>
                    </template>
                    <template v-else>
                        <div class="flex-1 flex items-center justify-center" v-if="!modelValue?.id">Please save your
                            postcard to add a file to it</div>
                        <div class="flex-1 flex items-center justify-center" v-else>
                            <div v-if="modelValue.file" class="relative w-full h-full">
                                <img :src="modelValue.file" alt="Postcard" class="w-full h-full object-cover">
                                <div v-if="modelValue.cover_text" class="absolute bottom-4 right-4 text-white text-lg font-semibold drop-shadow-lg">
                                    {{ modelValue.cover_text }}
                                </div>
                            </div>
                            <div v-else>
                                <div class="flex-1 flex items-center justify-center text-gray-300 text-xl">Upload file to see it here</div>
                            </div>
                        </div>
                    </template>
                </div>


                <div class="flex justify-center mt-2">
                    <ToggleGroupRoot v-model="toggleStateSingle" type="single"
                        class="flex bg-white rounded-lg p-2 gap-4 w-1/3 justify-center">
                        <ToggleGroupItem value="front" aria-label="Toggle italic"
                            :class="{ 'bg-gray-500 px-5 py-1 rounded-lg text-white': toggleStateSingle === 'front' }">
                            Front
                        </ToggleGroupItem>
                        <ToggleGroupItem value="back" aria-label="Toggle italic"
                            :class="{ 'bg-gray-500 px-5 py-1 rounded-lg text-white': toggleStateSingle === 'back' }">
                            Back
                        </ToggleGroupItem>
                    </ToggleGroupRoot>
                </div>
            </div>



        </div>

        <div class="mt-4 col-span-2 flex justify-end p-10">
            <slot></slot>
        </div>

    </div>
</template>

<script setup>
import { ToggleGroupItem, ToggleGroupRoot } from 'radix-vue'
import autoAnimate from "@formkit/auto-animate"
import { usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';
import UploadFileAndCoverText from './UploadFileAndCoverText.vue';

const props = defineProps({
    modelValue: Object,
});

const toggleStateSingle = ref('front');


</script>
