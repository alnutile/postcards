<template>
    <div>
        <form @submit.prevent="submit">
            <div class="grid grid-cols-2 gap-4 p-6">

                <div>
                    <div>
                        <InputLabel for="recipient_name" value="Recipient Name" />
                        <TextInput id="recipient_name" v-model="form.recipient_name" type="text"
                            class="mt-1 block w-full" required autofocus />
                        <InputError class="mt-2" :message="form.errors.recipient_name" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="street1" value="Street 1" />
                        <TextInput id="street1" v-model="form.street_1" type="text" class="mt-1 block w-full" required />
                        <InputError class="mt-2" :message="form.errors.street_1" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="street2" value="Street 2" />
                        <TextInput id="street2" v-model="form.street_2" type="text" class="mt-1 block w-full"
                            placeholder="OPTIONAL" />
                        <InputError class="mt-2" :message="form.errors.street_2" />
                    </div>

                    <div class="mt-4 grid grid-cols-2 gap-4">
                        <div>
                            <InputLabel for="city" value="City" />
                            <TextInput id="city" v-model="form.city" type="text" class="mt-1 block w-full" required />
                            <InputError class="mt-2" :message="form.errors.city" />
                        </div>

                        <div>
                            <InputLabel for="state" value="State" />
                            <TextInput id="state" v-model="form.state" type="text" class="mt-1 block w-full" required />
                            <InputError class="mt-2" :message="form.errors.state" />
                        </div>
                    </div>

                    <div class="mt-4">
                        <InputLabel for="zip_code" value="Zip Code" />
                        <TextInput id="zip_code" v-model="form.zip_code" type="text" class="mt-1 block w-full"
                            required />
                        <InputError class="mt-2" :message="form.errors.zip_code" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="message" value="Message" />
                        <textarea id="message" v-model="form.message"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            required rows="4" />
                        <InputError class="mt-2" :message="form.errors.message" />
                    </div>
                </div>


                <div class="bg-blue-400 rounded-lg p-6">
                    <h3>Preview</h3>
                </div>

            </div>

            <div class="mt-4 col-span-2 flex justify-end p-10">
                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </PrimaryButton>
            </div>
        </form>
    </div>
</template>

<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { onMounted } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

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
