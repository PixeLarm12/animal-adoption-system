<template>
    <table class="w-full rounded-md">
        <tr class="w-full text-left border border-gray-400 divide-x-2 divide-gray-400 bg-gray-300">
            <th v-for="(header, index) in headers" :key="index" class="pl-1 h-6 text-sm font-semibold text-default-gray bg-gray-300">
                {{ header }}
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
    },
}
</script>


