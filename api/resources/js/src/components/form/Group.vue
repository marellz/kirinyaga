
<template>
    <div class="flex flex-col">
            <div v-if="label" class="block font-medium text-sm text-gray-700 mb-2">
                {{ label }}
            </div>
            <div>
                <slot />
            </div>
    </div>
</template>
<script lang="ts" setup>
import { onMounted } from 'vue';
const props = defineProps({
    label: {
        type: String,
        default: null,
    },
})
</script>