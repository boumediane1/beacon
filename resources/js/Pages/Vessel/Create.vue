<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <FormSection @submit.prevent="submit">
                <template #title>New vessel</template>
                <template #description>
                    Add new vessel and associate it to an owner, city and port.
                </template>
                <template #form>
                    <div class="col-span-3">
                        <Label for="vessel" value="Unit name"></Label>
                        <Input id="vessel" type="text" v-model="form.name" class="mt-1 py-2.5 block w-full" autocomplete="off" />
                        <InputError class="mt-2" :message="errors.name" />
                    </div>

                    <div class="col-span-3">
                        <Label value="Registration number"></Label>
                        <Input id="registration-number" type="text" v-model="form.registration_number" class="mt-1 py-2.5 block w-full" autocomplete="off" />
                        <InputError class="mt-2" :message="errors.registration_number" />
                    </div>

                    <div class="col-span-3">
                        <Label for="user" />
                        <Label>Owner <span class="text-gray-500">(optional)</span></Label>
                        <div class="mt-1">
                            <Multiselect
                                v-model="form.user_id"
                                :filter-results="true"
                                :min-chars="1"
                                :options="users"
                                :searchable="true"
                                label="name"
                                track-by="name"
                                value-prop="id"
                                :caret="false"
                                :clear-on-search="true"
                            >
                            </Multiselect>
                        </div>
                        <InputError class="mt-2" :message="errors.user_id" />
                    </div>

                    <div class="col-span-3">
                        <Label for="uin" value="Beacon Hex ID" />
                        <div class="mt-1">
                            <Multiselect
                                v-model="form.beacon_id"
                                :filter-results="true"
                                :min-chars="1"
                                :options="beacons"
                                :searchable="true"
                                label="uin"
                                track-by="uin"
                                value-prop="id"
                                :caret="false"
                                :clear-on-search="true"
                            >
                            </Multiselect>
                            <InputError class="mt-2" :message="errors.beacon_id" />
                        </div>
                    </div>

                    <div class="col-span-3">
                        <Label for="mmsi">MMSI <span class="text-gray-500">(optional)</span></Label>
                        <Input id="mmsi" type="text" v-model="form.mmsi" class="mt-1 py-2.5 block w-full" autocomplete="off" />
                        <InputError class="mt-2" :message="errors.mmsi" />
                    </div>

                    <div class="col-span-3">
                        <Label for="activity" value="Activity type"></Label>
                        <select v-model="form.activity_id" id="activity" class="mt-1 block w-full py-2.5 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <option v-for="activity in activities" :key="activity.id" :value="activity.id" v-text="activity.name"></option>
                        </select>
                        <InputError class="mt-2" :message="errors.activity_id" />
                    </div>

                    <div class="col-span-3">
                        <Label for="city" value="City"></Label>
                        <select v-model="form.city_id" id="city" class="mt-1 block w-full py-2.5 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <option v-for="city in cities" :key="city.id" :value="city.id" v-text="city.name"></option>
                        </select>
                        <InputError class="mt-2" :message="errors.city_id" />
                    </div>

                    <div class="col-span-3">
                        <Label for="port" value="Port of registration"></Label>
                        <select :disabled="!form.city_id" v-model="form.port_id" id="port" :class="{'cursor-not-allowed': !form.city_id}" class="mt-1 block w-full py-2.5 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <option v-for="port in ports" :key="port.id" :value="port.id" v-text="port.name"></option>
                        </select>
                        <InputError class="mt-2" :message="errors.port_id" />
                    </div>

                </template>

                <template #actions>
                    <Button class="ml-auto">Save</Button>
                </template>
            </FormSection>
        </div>
    </AppLayout>
</template>

<script>

import InputError from '@/Components/InputError';
import FormSection from "@/Components/FormSection";
import Multiselect from '@vueform/multiselect';
import Listbox from "@/Components/Listbox";
import AppLayout from '@/Layouts/Authenticated';
import Label from "@/Components/Label";
import Input from "@/Components/Input";
import Button from "@/Components/Button";
export default {
    components: {
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
        errors: Object,
        cities: Array,
        ports: Array,
        activities: Array,
        users: Array,
        beacons: Array
    },

    data () {
        return {
            ports: this.ports,
            form: {
                name: '',
                registration_number: '',
                user_id: '',
                city_id: '',
                port_id: '',
                beacon_id: '',
                activity_id: 1,
                mmsi: ''
            }
        }
    },

    methods: {
        submit () {
            this.$inertia.post(this.route('vessels.store'), this.form);
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
