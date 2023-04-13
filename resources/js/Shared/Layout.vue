<template>
    <Head>
        <title>Your page title</title>
        <meta name="description" content="Your page description">
    </Head>

    <section class="p-6 bg-gray-200">
        <header class="flex justify-between">
            <div class="flex items-center space-x-2">
                <h1 class="font-bold text-lg">
                    My App
                </h1>

                <p>Welcome Back {{ username }}</p>
            </div>

            <Nav/>
        </header>
    </section>

    <section class="p-6">
        <div class="max-w-3xl mx-auto">
            <slot/>
        </div>
    </section>
</template>
<script>
import Nav from './Nav.vue'


export default {
    components: {Nav},
    computed: {
        username() {
            return this.$page.props.auth.user.name
        }
    }
}
</script>
