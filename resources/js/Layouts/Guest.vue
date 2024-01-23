<template>
  <div class="flex items-center min-h-screen" style="background-image: url('images/bg.png'); background-size: cover;">
        <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl">
            <div class="flex flex-col md:flex-row">
                <div class="hidden h-32 md:h-auto md:w-1/2 md:flex items-center bg-gray-200">
                  <img class="object-cover w-80 mx-auto" src="images/logo.png" alt="Logo">
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        <div class="flex justify-center">
                            <img class="w-72" src="images/cospa.png" alt="">
                        </div>
                        <div class="my-6 text-2xl font-bold text-center text-gray-700 capitalize">
                          <div>
                            Beacons tracking tool 406
                          </div>
                          <div style="font-family: 'Cairo Play', sans-serif">
                            رصد أجهزة الإنذار 406
                          </div>
                        </div>
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import {Link} from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeApplicationLogo,
        Link,
    }
}
</script>
