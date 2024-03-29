<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <FormSection @submit.prevent="update">
                <template #title>Owner information</template>
                <template #description>
                    Update owner information.
                </template>
                <template #form>
                    <div class="col-span-3">
                        <Label for="name" value="Owner"></Label>
                        <Input id="name" type="text" v-model="form.name" class="mt-1 py-2.5 block w-full" autocomplete="off" />
                        <InputError class="mt-2" :message="errors.name" />
                    </div>

                    <div class="col-span-3">
                        <Label for="email">Email <span class="text-gray-500">(optional)</span></Label>
                        <Input id="email" type="text" v-model="form.email" class="mt-1 py-2.5 block w-full" autocomplete="off" />
                        <InputError class="mt-2" :message="errors.email" />
                    </div>

                    <div class="col-span-3">
                        <Label for="phone-number">Phone number <span class="text-gray-500">(optional)</span></Label>
                        <Input id="phone-number" type="text" v-model="form.phone_number" class="mt-1 py-2.5 block w-full" autocomplete="off" />
                        <InputError class="mt-2" :message="errors.phone_number" />
                    </div>

                    <div class="col-span-3">
                        <Label for="secondary-phone-number" value="Secondary phone number" />
                        <Input id="secondary-phone-number" type="text" v-model="form.secondary_phone_number" class="mt-1 py-2.5 block w-full" autocomplete="off" />
                        <InputError class="mt-2" :message="errors.secondary_phone_number" />
                    </div>

                    <div class="col-span-3">
                        <Label for="country" value="Country"></Label>
                        <select id="country" v-model="form.country_id" class="mt-1 block w-full py-2.5 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <option v-for="country in countries" :key="country.id" :value="country.id" v-text="country.name"></option>
                        </select>
                        <InputError class="mt-2" :message="errors.country_id" />
                    </div>

                    <div class="col-span-3">
                      <Label for="cin">CIN <span class="text-gray-500">(optional)</span></Label>
                      <Input id="cin" type="text" v-model="form.cin" class="mt-1 py-2.5 block w-full" autocomplete="off" />
                      <InputError class="mt-1" :message="errors.cin" />
                    </div>

                    <div class="col-span-6">
                        <Label for="address" value="Address" />
                        <Textarea id="address" v-model="form.address" class="mt-1 py-2.5 block w-full" />
                        <InputError class="mt-2" :message="errors.address" />
                    </div>

                    <div class="col-span-3">
                        <Label for="name">Emergency contact name <span class="text-gray-500">(optional)</span></Label>
                        <Input id="name" type="text" v-model="form.emergency_contact_name" class="mt-1 py-2.5 block w-full" autocomplete="off" />
                        <InputError class="mt-1" :message="errors.emergency_contact_name" />
                    </div>

                    <div class="col-span-3">
                        <Label for="name">Emergency contact phone number <span class="text-gray-500">(optional)</span></Label>
                        <Input id="name" type="text" v-model="form.emergency_contact_phone_number" class="mt-1 py-2.5 block w-full" autocomplete="off" />
                        <InputError class="mt-1" :message="errors.emergency_contact_phone_number" />
                    </div>

                    <div class="col-span-3">
                        <Label for="name">Secondary emergency contact name <span class="text-gray-500">(optional)</span></Label>
                        <Input id="name" type="text" v-model="form.secondary_emergency_contact_name" class="mt-1 py-2.5 block w-full" autocomplete="off" />
                        <InputError class="mt-1" :message="errors.secondary_emergency_contact_name" />
                    </div>

                    <div class="col-span-3">
                        <Label for="name">Secondary emergency contact phone number <span class="text-gray-500">(optional)</span></Label>
                        <Input id="name" type="text" v-model="form.secondary_emergency_contact_phone_number" class="mt-1 py-2.5 block w-full" autocomplete="off" />
                        <InputError class="mt-1" :message="errors.secondary_emergency_contact_phone_number" />
                    </div>


                </template>

                <template #actions>
                    <button @click.prevent="destroy" class="text-red-600 hover:underline">Delete owner</button>
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
        Multiselect,
        FormSection,
        InputError
    },

    props: {
        user: Object,
        countries: Array,
        errors: Object
    },

    data () {
        return {
            form: {
                name: this.user.name,
                email: this.user.email,
                phone_number: this.user.phone_number,
                secondary_phone_number: this.user.secondary_phone_number,
                country_id: this.user.country_id,
                cin: this.user.cin,
                address: this.user.address,
                emergency_contact_name: this.user.emergency_contact_name,
                emergency_contact_phone_number: this.user.emergency_contact_phone_number,
                secondary_emergency_contact_name: this.user.secondary_emergency_contact_name,
                secondary_emergency_contact_phone_number: this.user.secondary_emergency_contact_phone_number
            }
        }
    },

    methods: {
        update () {
            this.$inertia.put(this.route('users.update', this.user.id), this.form);
        },

        destroy () {
            if (confirm('Are you sure?')) {
                this.$inertia.delete(this.route('users.destroy', this.user.id));
            }
        }

    }
}
</script>
