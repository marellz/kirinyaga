<template>
    <div class="flex flex-col">
        <label :for="id" class="block font-medium text-sm text-gray-700 mb-2">
            {{ label }}
        </label>
        <select
            :id="id"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            :class="{ 'border-red-500': error }"
            :disabled="disabled"
            :required="required"
            :name="name"
            v-model="model"
            @change="onSelect"
        >
        <option :value="null" disabled>{{ placeholder }}</option>
            <slot />
        </select>

        <form-error v-if="error">
            {{  error }}
        </form-error>
    </div>
</template>
<script lang="ts" setup>
import { onMounted } from "vue";
const props = defineProps({
    label: {
        type: String,
        default: null,
    },
    name: {
        type: String,
        default: null,
    },
    placeholder: {
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
    error: {
        type: String,
        default: null,
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
    } else {
        model.value = null
    }
});
</script>
