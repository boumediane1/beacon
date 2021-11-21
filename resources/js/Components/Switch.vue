<template>
    <Switch
        v-model="enabled"
        :class="enabled ? 'bg-blue-500' : 'bg-blue-300'"
        class="relative inline-flex items-center h-6 rounded-full w-11 transition-colors ease-in-out duration-200"
    >
        <span class="sr-only">Enable notifications</span>
        <span
            :class="enabled ? 'translate-x-6' : 'translate-x-1'"
            class="inline-block w-4 h-4 transform bg-white rounded-full transition ease-in-out duration-200"
        />
    </Switch>
</template>

<script>
import { ref } from 'vue';
import { Switch } from '@headlessui/vue';

export default {
    components: { Switch },

    props: ['status'],

    setup(props) {
        const enabled = ref(props.status);

        return { enabled }
    },
}
</script>
