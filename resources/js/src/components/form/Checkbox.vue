<template>
    <div class="flex flex-col">
        <label :for="id" class="flex font-medium text-sm text-gray-700 mb-2 space-x-3 items-center">
            <input
                type="checkbox"
                :id="id"
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                :class="{ 'border-red-500': errors }"
                :disabled="disabled"
                :required="required"
                :value="inputValue"
                v-model="model"
                :name="name"
            />
            <div>
                <slot>
                    <span>
                        {{ label }}
                    </span>
                </slot>
            </div>
        </label>
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
    name: {
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
    inputValue: {
        type: [Boolean, String],
        default: null,
    },
});

const id = Math.random().toString(36).substring(7);
const model = defineModel();

onMounted(() => {
    if (props.modelValue) {
        model.value = props.modelValue;
    }
});
</script>
