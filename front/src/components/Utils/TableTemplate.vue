<template>
    <table class="w-full rounded-md">
        <tr class="w-full text-left border border-black divide-x-2 divide-black bg-orange-500">
            <th v-for="(header, index) in headers" :key="index" class="pl-2 h-10 text-lg font-bold text-white bg-orange-500">
                {{ header }}
            </th>
            <th v-if="showActions" class="pl-2 h-10 text-lg font-bold text-white bg-orange-500">
                Actions
            </th>
        </tr>

        <slot></slot>
    </table>
</template>

<script>
export default {
    props: {
        headers: {
            type: Array,
            required: true,
            default: () => []
        },
        showActions: {
            type: Boolean,
            required: true,
            default: true
        }
    },
}
</script>


