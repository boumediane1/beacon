<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between px-2 sm:px-0">
                <div class="sm:w-1/3 relative text-blue-400 focus-within:text-blue-600">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input id="email" @input="search" v-model="term" class="py-2.5 px-4 bg-white placeholder-gray-400 text-gray-900 rounded-lg shadow appearance-none w-full block pl-12 focus:outline-none" placeholder="Staff" autocomplete="off">
                </div>
                <div>
                    <Link :href="route('staff.create')">
                        <div class="px-4 py-3 sm:py-2.5 text-white bg-blue-500 hover:bg-blue-400 rounded-lg shadow">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
                                </svg>
                                <div class="hidden sm:block ml-1">Add new</div>
                            </div>
                        </div>
                    </Link>
                </div>
            </div>
            <div class="mt-4 flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-600">
                                <tr>
                                    <th scope="col" class="w-1/3 px-6 py-3 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider">
                                        Staff
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="user in users.data" :key="user.id">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <!--<i class="fas fa-satellite text-gray-600 text-lg"></i>-->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            <!--<img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">-->
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ user.name }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ user.username }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span :class="[user.status === 1 ? 'text-lime-800 bg-lime-100' : 'text-pink-800 bg-pink-100']" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                                            {{ user.status === 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <Link :href="route('staff.edit', user.id)" class="text-indigo-600 hover:text-indigo-900">Edit</Link>
                                    </td>
                                </tr>
                                <tr v-if="users.data.length === 0">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        No results found.
                                    </td>
                                    <td v-for="i in 2" :key="i"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <Pagination class="mt-4" :links="users.links" />

        </div>
    </AppLayout>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import Pagination from "@/Components/Pagination";
import Input from "@/Components/Input";
import AppLayout from "@/Layouts/Authenticated";
export default {
    components: {
        AppLayout, Input, Pagination, Link
    },

    props: {
        users: Object
    },

    data () {
        return {
            term: ''
        }
    },

    methods: {
        search () {
            this.$inertia.get(this.route('staff.index'), {search: this.term}, {preserveState: true})
        }
    }
}
</script>
