<template>
  <div class="hidden lg:block min-h-screen" style="background-image: url('images/login-background.jpg'); background-size: cover">
    <div class="flex justify-center items-end fixed bottom-0 w-full">
      <div class="w-1/4 bg-white rounded-lg shadow-xl p-5">
        <slot />
      </div>
    </div>
  </div>

  <div class="lg:hidden flex items-center min-h-screen" style="background-image: url('images/login-background.jpg'); background-size: cover">-->
    <div class="flex-1 h-full max-w-lg mx-auto bg-white rounded-lg shadow-xl p-5">
      <slot />
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
