<template>
    <div>
        <template v-for="link in links">
            <Component
                :is="link.url ? 'Link' :'span'"
                :href="link.url"
                v-html="link.label"
                class="px-1"
                :class="{'text-gray-500': !link.url, 'font-bold': link.active }"
            />
        </template>
    </div>
</template>
<script>
export default {
    props: {
        links: Array
    }
}
</script>
