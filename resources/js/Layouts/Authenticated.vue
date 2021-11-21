<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <Navbar></Navbar>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>

<script>
import Navbar from "@/Components/Navbar";
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import BreezeDropdown from '@/Components/Dropdown.vue'
import BreezeDropdownLink from '@/Components/DropdownLink.vue'
import BreezeNavLink from '@/Components/NavLink.vue'
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeApplicationLogo,
        BreezeDropdown,
        BreezeDropdownLink,
        BreezeNavLink,
        BreezeResponsiveNavLink,
        Link, Navbar
    },

    data() {
        return {
            showingNavigationDropdown: false,
            showingProfileDropdown: false
        }
    },

    computed: {
        barquesRouteIsActive () {
            return route().current('barques.index') || route().current('barques.create') || route().current('barques.edit');
        },

        beaconsRouteIsActive () {
            return route().current('beacons.index') || route().current('beacons.create') || route().current('beacons.edit');
        },

        usersRouteIsActive () {
            return route().current('users.index') || route().current('users.create') || route().current('users.edit');
        }
    }
}
</script>
