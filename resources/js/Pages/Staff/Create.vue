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
                        <Label for="name" value="Staff"></Label>
                        <Input id="name" type="text" v-model="form.name" class="mt-1 py-2.5 block w-full" autocomplete="off" />
                        <InputError class="mt-1" :message="errors.name" />
                    </div>

                    <div class="col-span-3">
                        <Label for="username" value="Username"></Label>
                        <Input id="username" type="text" v-model="form.username" class="mt-1 py-2.5 block w-full" autocomplete="off" />
                        <InputError class="mt-1" :message="errors.username" />
                    </div>

                    <div class="col-span-3">
                        <Label for="password" value="Password"></Label>
                        <Input id="password" type="password" v-model="form.password" class="mt-1 py-2.5 block w-full" autocomplete="off" />
                        <InputError class="mt-1" :message="errors.password" />
                    </div>

                    <div class="col-span-6">
                        <label for="status" class="block">Status</label>
                        <Switch id="status" :status="form.status" v-model="form.status" class="mt-1" />
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

import Switch from '../../Components/Switch';
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
        InputError,
        Switch
    },

    props: {
        errors: Object
    },

    data () {
        return {
            form: {
                name: '',
                username: '',
                password: '',
                status: true
            }
        }
    },

    methods: {
        submit () {
            this.$inertia.post(this.route('staff.store'), this.form);
        }
    },

    watch: {
        'form.name': function (value) {
            this.form.username = value.replace(/\s/g, '').toLowerCase();
            this.form.password = value.replace(/\s/g, '').toLowerCase();
        }
    }
}
</script>
