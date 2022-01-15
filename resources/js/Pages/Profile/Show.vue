<template>
    <AppLayout>
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <FormSection @submitted="updateProfileInformation">
                    <template #title>
                        Profile Information
                    </template>

                    <template #description>
                        Update your account's profile information and email address.
                    </template>

                    <template #form>
                        <div class="col-span-6 sm:col-span-4">
                            <Label for="username" value="Username" />
                            <Input id="username" type="text" class="mt-1 block w-full" v-model="update_profile_information_form.username" autocomplete="off" />
                            <InputError :message="update_profile_information_form.errors.username" class="mt-1 block w-full" />
                        </div>
                    </template>

                    <template #actions>
                        <Button>Save</Button>
                    </template>
                </FormSection>

                <div class="hidden sm:block">
                    <div class="py-8">
                        <div class="border-t border-gray-200"></div>
                    </div>
                </div>

                <FormSection @submitted="updatePassword">
                    <template #title>
                        Update Password
                    </template>

                    <template #description>
                        Ensure your account is using a long, random password to stay secure.
                    </template>

                    <template #form>
                        <div class="col-span-6 sm:col-span-4">
                            <Label for="current_password" value="Current Password" />
                            <Input id="current_password" type="password" class="mt-1 block w-full" v-model="update_password_form.current_password" ref="current_password" />
                            <InputError :message="update_password_form.errors.current_password" />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <Label for="password" value="New Password" />
                            <Input id="password" type="password" class="mt-1 block w-full" v-model="update_password_form.password" ref="password" />
                            <InputError :message="update_password_form.errors.password" />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <Label for="password_confirmation" value="Confirm Password" />
                            <Input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="update_password_form.password_confirmation" />
                            <InputError :message="update_password_form.errors.password_confirmation" />
                        </div>
                    </template>

                    <template #actions>
                        <Button>Save</Button>
                    </template>
                </FormSection>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import Button from "@/Components/Button";
import InputError from "@/Components/InputError";
import Input from "@/Components/Input";
import Label from "@/Components/Label";
import FormSection from "@/Components/FormSection";
import AppLayout from '@/Layouts/Authenticated';
export default {
    components: {
        AppLayout, FormSection, Label, Input, InputError, Button
    },

    props: ['user'],

    data () {
        return {
            update_profile_information_form: this.$inertia.form({
                username: this.user.username,
            }),

            update_password_form: this.$inertia.form({
                current_password: '',
                password: '',
                password_confirmation: ''
            }),
        }
    },

    methods: {
        updateProfileInformation () {
            this.update_profile_information_form.put(route('user-profile-information.update'), {
                errorBag: 'updateProfileInformation',
                preserveScroll: true
            });
        },

        updatePassword () {
            this.update_password_form.put(route('user-password.update'), {
                errorBag: 'updatePassword',
                preserveScroll: true,
                onSuccess: () => this.update_password_form.reset(),
                onError: () => {
                    if (this.update_password_form.errors.password) {
                        this.update_password_form.reset('password', 'password_confirmation');
                        this.$refs.password.focus();
                    }

                    if (this.update_password_form.errors.current_password) {
                        this.update_password_form.reset('current_password');
                        this.$refs.current_password.focus();
                    }
                }
            })
        }
    }
}





</script>
