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
                    <input id="email" @input="search" v-model="term" class="py-2.5 px-4 bg-white placeholder-gray-400 text-gray-900 rounded-lg shadow appearance-none w-full block pl-12 focus:outline-none" placeholder="Unit name, Owner, UIN, S/N SAR or MMSI" autocomplete="off">
                </div>
                <div class="flex gap-2">

                    <div v-if="can.import">
                        <input id="upload-file" type="file" @input="form.file = $event.target.files[0]" @change="importFile" class="sr-only">
                        <label for="upload-file" class="cursor-pointer">
                            <div class="px-4 py-3 sm:py-2.5 text-white bg-indigo-500 hover:bg-indigo-400 rounded-lg shadow">
                                <div class="flex items-center">
                                    <svg v-if="!importing" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    <i v-else class="fas fa-spinner fa-spin"></i>
                                    <div class="hidden sm:block ml-1">Import</div>
                                </div>
                            </div>
                        </label>
                    </div>
                    <a @click="exporting === true" :href="route('vessels.export')">
                        <div class="px-4 py-3 sm:py-2.5 text-white bg-green-500 hover:bg-green-400 rounded-lg shadow">
                            <div class="flex items-center">
                                <svg v-if="!exporting" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
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
                                        <div class="flex items-center gap-4">
                                            <span>Unit name</span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider whitespace-nowrap">
                                        Port
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider">
                                        Owner
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider">
                                        UIN
                                    </th>
                                    <!--<th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider">
                                        MMSI
                                    </th>-->
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
                                        <div class="flex items-center gap-4">
                                            <!--<input type="checkbox"
                                                   :id="vessel.id"
                                                   :value="vessel.id"
                                                   v-model="checkedVessels"
                                                   class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                            />-->
                                            <div class="flex items-center">
                                                <img src="/ship.svg" alt="Ship">
                                                <div class="ml-4">
                                                    <Link v-if="can.update" :href="route('vessels.edit', vessel.id)" class="text-sm font-medium text-gray-900 hover:text-indigo-500">
                                                        {{ vessel.name }}
                                                    </Link>
                                                    <div v-else class="text-sm font-medium text-gray-900">{{ vessel.name }}</div>
                                                <div>
                                                <span title="Registration number" class="text-sm text-gray-500">
                                                {{ vessel.registration_number }}
                                                </span>
                                                    </div>
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
                                    <!--<td v-if="vessel.mmsi" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ vessel.mmsi }}
                                    </td>
                                    <td v-else class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Undefined
                                    </td>-->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ vessel.activity.name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center">
                                            <a :href="route('vessels.show', vessel.id)" target="_blank" class="flex items-center gap-2 text-indigo-600 hover:text-indigo-900">
                                                <svg class="fill-current h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                                    <path d="M365.256 93.383L290.627 18.746C278.625 6.742 262.348 0 245.373 0H64C28.654 0 0 28.652 0 64L0.02 448C0.02 483.344 28.674 512 64.02 512H320C355.199 512 384 483.199 384 448V138.641C384 121.664 377.258 105.383 365.256 93.383ZM336.002 448C336.002 456.836 328.838 464 320.002 464H64.018C55.18 464 48.018 456.836 48.018 448L48 64.125C48 55.289 55.164 48.125 64 48.125H224.008V128C224.008 145.672 238.334 160 256.008 160H336.002V448ZM202.037 286.133C202.914 283.445 203.777 280.734 204.619 277.988C206.053 272.227 212.107 246.453 212.107 225.516C212.107 207.035 197.074 192 178.594 192C160.117 192 145.082 207.035 145.082 225.516C145.082 225.812 145.246 254.328 158.932 287.812C151.896 307.172 143.365 326.613 133.518 345.742C112.023 355.852 94.277 367.977 80.719 381.816C74.484 388.254 71.352 396.555 71.352 406.539C71.352 424.992 86.361 440 104.812 440C115.617 440 125.793 434.773 132.029 426.023C139.352 415.742 150.41 399.125 162.502 377.078C178.301 370.727 196.381 365.359 216.385 361.078C229.939 370.656 245.287 378.367 262.092 384.027C266.619 385.578 271.494 386.375 276.518 386.375C296.779 386.375 312.648 370.184 312.648 349.516C312.648 329.187 296.111 312.648 275.783 312.648H272.078C269.352 312.773 251.564 313.789 226.707 318.016C216.865 308.938 208.598 298.25 202.037 286.133ZM110.193 410.438C106.92 415.125 98.162 413.215 98.162 405.125C98.162 403.371 98.791 401.695 99.891 400.57C108.91 391.352 119.828 383.523 131.74 376.848C122.25 393.078 114.291 404.703 110.193 410.438ZM178.594 218.812C182.287 218.812 185.297 221.82 185.297 225.516C185.297 240.727 181.188 260.359 179.551 267.617C172.141 245.047 171.893 227.242 171.893 225.516C171.893 221.82 174.902 218.812 178.594 218.812ZM162.283 348.336C168.895 334.852 175.506 319.875 181.658 303.641C188.047 314.559 196.215 325.504 206.623 335.609C192.551 338.75 177.352 342.891 162.283 348.336ZM272.432 339.461H275.783C281.322 339.461 285.838 343.961 285.838 350.246C285.838 355.375 281.662 359.566 276.518 359.566C274.488 359.566 272.459 359.25 270.666 358.625C258.334 354.488 247.559 349.305 238.121 343.438C258.334 340.273 272.145 339.484 272.432 339.461Z" />
                                                </svg>
                                                <span class="text-rose-500">Download</span>
                                            </a>

                                            <!--<Link v-if="can.update" :href="route('vessels.edit', vessel.id)" class="ml-4 text-indigo-600 hover:text-indigo-900">Edit</Link>-->
                                        </div>
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
import _ from 'lodash';
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
        can: Object
    },

    data () {
        return {
            term: '',
            importing: false,
            exporting: false,
            form: this.$inertia.form({
                file: null,
            }),
            checkedVessels: [],
            self: this
        }
    },

    remember: {
        data: ['checkedVessels'],
        key: window.location.href
    },


    methods: {
        search: _.throttle(function () {
            this.$inertia.get(this.route('vessels.index'), {search: this.term}, {preserveState: true});
        }, 500),


        importFile (event) {
            this.importing = true;
            const formData = new FormData();
            formData.append('file', event.target.files[0]);
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
            });
        },

        /*toggleSelectAll () {
            this.checkedVessels = this.vessels.data.map(vessel => vessel.id);
        }*/
    },

    watch: {
        /*checkedVessels () {
            sessionStorage.clear();
            sessionStorage.setItem('checkedVessels', JSON.stringify(this.checkedVessels));
        }*/
    },

    mounted () {
        if (sessionStorage.getItem('checkedVessels')) {
            this.checkedVessels = JSON.parse(sessionStorage.getItem('checkedVessels'));
        }
    }
}
</script>
