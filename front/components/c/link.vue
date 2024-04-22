<template>
    <a :href class="inline-flex place-items-center py-1 font-medium px-4">
        <slot />
    </a>
</template>
<script lang="ts" setup>
defineProps({
    href: {
        type: String,
        default: "#"
    }
})
</script>