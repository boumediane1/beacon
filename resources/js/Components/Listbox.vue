<template>
    <Listbox v-model="selectedItem">
        <div class="relative">
            <ListboxButton class="relative w-full py-3 pl-3 pr-10 text-left bg-white rounded-lg shadow-md cursor-default focus:outline-none focus-visible:ring-2 focus-visible:ring-opacity-75 focus-visible:ring-white focus-visible:ring-offset-orange-300 focus-visible:ring-offset-2 focus-visible:border-indigo-500 sm:text-sm">
                <span class="block truncate">{{ selectedItem.name }}</span>
                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </span>
            </ListboxButton>

            <ListboxOptions class="z-10 absolute w-full py-1 mt-1 overflow-auto text-base bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                <ListboxOption
                    v-slot="{ active, selected }"
                    v-for="item in items"
                    :key="item.name"
                    :value="item"
                    as="template">
                    <li :class="[ active ? 'text-amber-900 bg-amber-100' : 'text-gray-900', 'cursor-default select-none relative py-2 pl-10 pr-4',]">
                        <span :class="[ selected ? 'font-medium' : 'font-normal', 'block truncate']">{{ item.name }}</span>
                        <span v-if="selected" class="absolute inset-y-0 left-0 flex items-center pl-3 text-amber-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    </li>
                </ListboxOption>
            </ListboxOptions>
        </div>
    </Listbox>
</template>

<script>
import { ref } from 'vue'
import {
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from '@headlessui/vue'

export default {
    components: { Listbox, ListboxButton, ListboxOptions, ListboxOption },

    props: {
        items: Array
    },

    setup(props) {
        const items = props.items;
        const selectedItem = ref(items[0]);
        // const people = [
        //     { id: 1, name: 'Durward Reynolds', unavailable: false },
        //     { id: 2, name: 'Kenton Towne', unavailable: false },
        //     { id: 3, name: 'Therese Wunsch', unavailable: false },
        //     { id: 4, name: 'Benedict Kessler', unavailable: true },
        //     { id: 5, name: 'Katelyn Rohan', unavailable: false },
        // ]
        // const selectedPerson = ref(people[0])

        return {
            items,
            selectedItem,
        }
    },
}
</script>
