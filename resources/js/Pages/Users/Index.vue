<template>
    <Head title="My App - Users"/>
    <div class="flex justify-between mb-6">
        <div class="flex items-center">
            <h1 class="text-3xl">Users</h1>

            <Link href="/users/create" class="text-blue-500 text-sm ml-2">New User</Link>
        </div>

        <input type="text" v-model="search" placeholder="Search..." class="border px-2 rounded-lg">
    </div>


    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <table class="min-w-full divide-y divide-gray-300">
                <tbody class="divide-y divide-gray-200 bg-white">
                <tr v-for="user in users.data" :key="user.id">
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-0">
                        <div class="flex items-center">
                            <div class="font-medium text-gray-900" v-text="user.name"/>
                        </div>
                    </td>
                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                        <Link :href="`/users/${user.id}/edit`" class="text-indigo-600 hover:text-indigo-900">Edit</Link>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <Paginator class="mt-6" :links="users.links"/>

</template>

<script setup>
import Paginator from "../../Shared/Paginator.vue"
import {ref, watch} from "vue"
import {router} from '@inertiajs/vue3'
import debounce from 'lodash/debounce'

let props = defineProps({
    users: Object,
    filters: Object
});

let search = ref(props.filters.search)

watch(search, debounce(function (value) {
        router.get('/users', {search: value}, {
            preserveState: true,
            replace: true
        })
    }, 300)
)
</script>
