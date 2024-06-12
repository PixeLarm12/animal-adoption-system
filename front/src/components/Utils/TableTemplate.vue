<template>
    <table class="w-full">
        <tr class="text-white font-semibold bg-orange-500">
            <th v-for="(header, index) in headers" :key="index">
                {{ header }}
            </th>
            <th v-if="showActions">
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


