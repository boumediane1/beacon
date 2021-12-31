<template>
    <div class="flex items-center min-h-screen bg-gray-100">
        <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl">
            <div class="flex flex-col md:flex-row">
                <div class="hidden  h-32 md:h-auto md:w-1/2 md:flex items-center bg-gray-200">
                    <img class="object-cover w-56 mx-auto" src="images/plb.png"
                         alt="img" />
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        <div class="flex justify-center">
                            <img src="images/logo.svg" alt="">
                        </div>
                        <h1 class="my-4 text-2xl font-bold text-center text-gray-700 capitalize">
<!--                            Outil de traçabilité des PLB-->
                            Beacons tracking tool
                        </h1>
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeApplicationLogo,
        Link,
    }
}
</script>
