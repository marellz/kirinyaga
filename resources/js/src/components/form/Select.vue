<template>
    <div class="flex flex-col">
        <label :for="id" class="block font-medium text-sm text-gray-700 mb-2">
            {{ label }}
        </label>
        <select
            :id="id"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            :class="{ 'border-red-500': errors }"
            :disabled="disabled"
            :required="required"
            v-model="model"
            @change="onSelect"
        >
            <slot />
        </select>

        <slot name="errors" />
    </div>
</template>
<script lang="ts" setup>
import { onMounted } from "vue";
const props = defineProps({
    label: {
        type: String,
        default: null,
    },
    required: {
        type: Boolean,
        default: false,
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    errors: {
        type: Boolean,
        default: false,
    },
    modelValue: {
        type: String,
        default: null,
    },
});

const emit = defineEmits(['select'])
const id = Math.random().toString(36).substring(7);
const model = defineModel();
const onSelect = () => {
    emit('select', model.value)
}

onMounted(() => {
    if (props.modelValue) {
        model.value = props.modelValue;
    }
});
</script>
