<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <FormSection @submit.prevent="submit">
                <template #title>New owner</template>
                <template #description>
                    Add new barque and associate it to an owner, city and port.
                </template>
                <template #form>
                    <div class="col-span-3">
                        <Label for="name" value="Owner"></Label>
                        <Input id="name" type="text" v-model="form.name" class="mt-1 py-2.5 block w-full" autocomplete="off" />
                        <InputError class="mt-1" :message="errors.name" />
                    </div>

                    <div class="col-span-3">
                        <Label for="email" value="Email"></Label>
                        <Input id="email" type="text" v-model="form.email" class="mt-1 py-2.5 block w-full" autocomplete="off" />
                        <InputError class="mt-1" :message="errors.email" />

                    </div>

                    <div class="col-span-3">
                        <Label for="phone-number" value="Phone number" />
                        <Input id="phone-number" type="text" v-model="form.phone_number" class="mt-1 py-2.5 block w-full" autocomplete="off" />
                        <InputError class="mt-1" :message="errors.phone_number" />
                    </div>

                    <div class="col-span-3">
                        <Label for="secondary-phone-number">Secondary phone number <span class="text-gray-500">(optional)</span></Label>
                        <Input id="secondary-phone-number" type="text" v-model="form.secondary_phone_number" class="mt-1 py-2.5 block w-full" autocomplete="off" />
                        <InputError class="mt-1" :message="errors.secondary_phone_number" />
                    </div>

                    <div class="col-span-6">
                        <Label for="address">Address <span class="text-gray-500">(optional)</span></Label>
                        <Textarea id="address" v-model="form.address" class="mt-1 py-2.5 block w-full" />
                        <InputError class="mt-1" :message="errors.address" />
                    </div>


                </template>

                <template #actions>
                    <!--<button @click.prevent="destroy" class="text-red-600 hover:underline">Delete barque</button>-->
                    <Button class="ml-auto">Save</Button>
                </template>
            </FormSection>
        </div>
    </AppLayout>
</template>

<script>

import Textarea from "@/Components/Textarea";
import InputError from "@/Components/InputError";
import FormSection from "@/Components/FormSection";
import Multiselect from '@vueform/multiselect';
import Listbox from "@/Components/Listbox";
import AppLayout from '@/Layouts/Authenticated';
import Label from "@/Components/Label";
import Input from "@/Components/Input";
import Button from "@/Components/Button";
export default {
    components: {
        Textarea,
        Button,
        Input,
        Label,
        AppLayout,
        Listbox,
        Multiselect,
        FormSection,
        InputError
    },

    props: {
        errors: Object
    },

    data () {
        return {
            form: {
                name: '',
                email: '',
                phone_number: '',
                secondary_phone_number: '',
                address: ''
            }
        }
    },

    methods: {
        submit () {
            this.$inertia.post(this.route('users.store'), this.form);
        }

    },

    watch: {
        'form.city_id': function () {
            this.ports = this.ports.filter(port => port.city_id === this.form.city_id);
        },

        'form.user_id': function () {

        }
    }
}
</script>
