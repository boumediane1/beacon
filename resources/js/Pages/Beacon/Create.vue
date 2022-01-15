<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <FormSection @submit.prevent="submit">
                <template #title>New beacon</template>
                <template #description>
                    Add new barque and associate it to an owner, city and port.
                </template>
                <template #form>
                    <div class="col-span-3">
                        <Label for="uin" value="Beacon HEX ID"></Label>
                        <Input id="uin" type="text" v-model="form.uin" class="mt-1 py-2.5 block w-full" autocomplete="off" />
                        <InputError class="mt-2" :message="errors.uin" />
                    </div>

                    <div class="col-span-3">
                        <Label for="serial-number" value="S/N Manufacturer"></Label>
                        <Input id="serial-number" type="text" v-model="form.serial_number_manufacturer" class="mt-1 py-2.5 block w-full" autocomplete="off" />
                        <InputError class="mt-2" :message="errors.serial_number_manufacturer" />
                    </div>

                    <div class="col-span-3">
                        <Label for="serial-number-sar">S/N SAR <span class="text-gray-500">(optional)</span></Label>
                        <Input id="serial-number-sar" type="text" v-model="form.serial_number_sar" class="mt-1 py-2.5 block w-full" autocomplete="off" />
                        <InputError class="mt-2" :message="errors.serial_number_sar" />
                    </div>

                    <div class="col-span-3">
                        <Label for="registration-date" value="Registration date" />
                        <Input id="registration-date" type="date" v-model="form.registration_date" class="mt-1 py-2.5 block w-full" autocomplete="off" />
                        <InputError class="mt-2" :message="errors.registration_date" />
                    </div>

                    <div class="col-span-3">
                        <Label for="expiration-date" value="Battery expiration date" />
                        <Input id="expiration-date" type="date" v-model="form.expiration_date" class="mt-1 py-2.5 block w-full" autocomplete="off" />
                        <InputError class="mt-2" :message="errors.expiration_date" />
                    </div>

                    <div class="col-span-3">
                        <Label for="manufacturer" value="Manufacturer"></Label>
                        <select id="manufacturer" v-model="form.manufacturer_id" class="mt-1 block w-full py-2.5 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <option v-for="manufacturer in manufacturers" :key="manufacturer.id" :value="manufacturer.id" v-text="manufacturer.name"></option>
                        </select>
                        <InputError class="mt-2" :message="errors.manufacturer_id" />
                    </div>

                    <div class="col-span-3">
                        <Label for="type" value="Beacon type"></Label>
                        <select id="type" v-model="form.type_id" class="mt-1 block w-full py-2.5 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <option v-for="type in types" :key="type.id" :value="type.id" v-text="type.name"></option>
                        </select>
                        <InputError class="mt-2" :message="errors.type_id" />
                    </div>

                    <div class="col-span-3">
                        <Label for="model" value="Model"></Label>
                        <select :disabled="filteredModels.length === 0" id="model" v-model="form.model_id" :class="{'cursor-not-allowed': filteredModels.length === 0}" class="mt-1 block w-full py-2.5 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <option v-for="model in filteredModels" :key="model.id" :value="model.id" v-text="model.name"></option>
                        </select>
                        <InputError class="mt-2" :message="errors.model_id" />
                    </div>

                    <div class="col-span-3">
                        <Label for="status" value="Beacon status" />
                        <select v-model="form.status_id" id="status" class="mt-1 block w-full py-2.5 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <option v-for="status in statuses" :key="status.id" :value="status.id">{{ status.name }}</option>
                        </select>
                        <InputError class="mt-2" :message="errors.status_id" />
                    </div>

                    <div class="col-span-3">
                        <Label for="tac">TAC <span class="text-gray-500">(optional)</span></Label>
                        <Input id="tac" type="text" v-model="form.tac" class="mt-1 py-2.5 block w-full" autocomplete="off" />
                        <InputError class="mt-2" :message="errors.tac" />
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

import Switch from '@/Components/Switch';
import Textarea from "@/Components/Textarea";
import FormSection from "@/Components/FormSection";
import Multiselect from '@vueform/multiselect';
import Listbox from "@/Components/Listbox";
import AppLayout from '@/Layouts/Authenticated';
import Label from "@/Components/Label";
import Input from "@/Components/Input";
import Button from "@/Components/Button";
import InputError from "@/Components/InputError";
export default {
    components: {
        InputError,
        Textarea,
        Button,
        Input,
        Label,
        AppLayout,
        Listbox,
        Multiselect,
        FormSection, Switch
    },

    props: {
        manufacturers: Array,
        types: Array,
        models: Array,
        errors: Object,
        statuses: Array
    },

    data () {
        return {
            filteredModels: this.models,
            form: {
                uin: '',
                serial_number_manufacturer: '',
                serial_number_sar: '',
                registration_date: '',
                expiration_date: '',
                manufacturer_id: 1,
                type_id: 1,
                model_id: 1,
                status_id: 1,
                tac: ''
            }
        }
    },

    methods: {
        submit () {
            this.$inertia.post(this.route('beacons.store'), this.form);
        }
    },

    watch: {
        'form.type_id': function (value) {
            this.filteredModels = this.models.filter(model => model.type_id === this.form.type_id);
            this.form.model_id = '';
        },
        'type': function () {

        }
    },

    // created () {
    //     this.filteredModels = this.models.filter(model => model.type_id === this.form.type_id);
    // }
}
</script>
