<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="flex justify-between px-2 sm:px-0">
                <div class="sm:w-1/3 relative text-blue-400 focus-within:text-blue-600">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input id="email" @input="search" v-model="term" class="py-2.5 px-4 bg-white placeholder-gray-400 text-gray-900 rounded-lg shadow appearance-none w-full block pl-12 focus:outline-none" placeholder="Owner, Unit name or S/N sar" autocomplete="off">
                </div>
                <div class="flex gap-2">

                    <input id="upload-file" type="file" @input="form.file = $event.target.files[0]" @change="submit" class="sr-only">
                    <label for="upload-file" class="cursor-pointer">
                        <div class="px-4 py-3 sm:py-2.5 text-white bg-indigo-500 hover:bg-indigo-400 rounded-lg shadow">
                            <div class="flex items-center">
                                <svg v-if="!importing" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                <i v-else class="fas fa-spinner fa-spin"></i>
                                <div class="hidden sm:block ml-1">Import</div>
                            </div>
                        </div>
                    </label>
                    <a target="_blank" @click="exporting === true" :href="route('vessels.export')">
                        <div class="px-4 py-3 sm:py-2.5 text-white bg-green-500 hover:bg-green-400 rounded-lg shadow">
                            <div class="flex items-center">
                                <svg v-if="!exporting" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                <i v-else class="fas fa-spinner fa-spin"></i>
                                <div class="hidden sm:block ml-1">Export</div>
                            </div>
                        </div>
                    </a>
                    <Link v-if="can.create" :href="route('vessels.create')">
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
                                    <th scope="col" class="w-1/4 px-6 py-3 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider">
                                        Unit name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider whitespace-nowrap">
                                        Port
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider">
                                        Owner
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider">
                                        Beacon Hex ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider">
                                        MMSI
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider">
                                        Activity type
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="vessel in vessels.data" :key="vessel.id">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img src="/ship.svg" alt="Ship">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ vessel.name }}
                                                </div>
                                                <div>
                                                    <span title="Registration number" class="text-sm text-gray-500">
                                                    {{ vessel.registration_number }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ vessel.port.city.name }}</div>
                                        <div class="text-sm text-gray-500">{{ vessel.port.name }}</div>
                                    </td>
                                    <td v-if="vessel.user" class="px-6 py-4 whitespace-nowrap">
                                        <Link :href="route('users.index', {id: vessel.user.id})" class="text-sm text-gray-900 hover:text-indigo-600">{{ vessel.user.name }}</Link>
                                    </td>
                                    <td v-else class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Undefined
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <Link :href="route('beacons.index', {id: vessel.beacon.id})" class="text-sm text-gray-900 hover:text-indigo-600">{{ vessel.beacon.uin }}</Link>
                                    </td>
                                    <td v-if="vessel.mmsi" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ vessel.mmsi }}
                                    </td>
                                    <td v-else class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Undefined
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ vessel.activity.name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a :href="route('vessels.show', vessel.id)" target="_blank" class="text-indigo-600 hover:text-indigo-900">View</a>
                                        <Link v-if="can.update" :href="route('vessels.edit', vessel.id)" class="ml-4 text-indigo-600 hover:text-indigo-900">Edit</Link>
                                    </td>
                                </tr>
                                <tr v-if="vessels.data.length === 0">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        No results found.
                                    </td>
                                    <td v-for="i in 6" :key="i"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <Pagination class="mt-4" :links="vessels.links" />
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
        vessels: Object,
        can: Array
    },

    data () {
        return {
            term: '',
            importing: false,
            exporting: false,
            form: this.$inertia.form({
                file: null
            })
        }
    },

    methods: {
        search () {
            this.$inertia.get(this.route('vessels.index'), {search: this.term}, {preserveState: true})
        },

        submit (e) {
            this.importing = true;
            const formData = new FormData();
            formData.append('file', e.target.files[0]);
            axios.post(this.route('vessels.import'), formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
                if (response.status === 200) {
                    this.importing = false;
                    location.reload();
                }
            }).catch(error => {
                this.importing = false;
            })
        }
    }
}
</script>
