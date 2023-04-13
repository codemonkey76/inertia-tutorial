import {createInertiaApp, Head, Link} from '@inertiajs/vue3'
import {createApp, h} from 'vue'
import Layout from './Shared/Layout.vue'


createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', {eager: true})
        let page = pages[`./Pages/${name}.vue`].default

        if (page.layout === undefined) {
            page.layout = Layout
        }

        return pages[`./Pages/${name}.vue`]

    },
    setup({el, App, props, plugin}) {
        createApp({render: () => h(App, props)})
            .use(plugin)
            .component('Head', Head)
            .component('Link', Link)
            .mount(el)
    },

    progress: {
        showSpinner: true,
    },
})
