<template>
    <Link class="text-black underline" :class="{ 'font-bold': active }">
        <slot/>
    </Link>
</template>
<script>
import {Link} from '@inertiajs/vue3'

export default {
    components: {Link},
    props: {
        active: Boolean
    }

}
</script>
