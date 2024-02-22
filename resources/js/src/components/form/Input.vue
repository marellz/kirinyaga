<template>
    <div class="flex flex-col">
        <label v-if="label" :for="id" class="block font-medium text-sm text-gray-700 mb-2">
            {{ label }}
        </label>
        <input
            :type="type"
            :id="id"
            :name="name"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            :disabled="disabled"
            :required="required"
            :class="{'border-red-500': error}"
            :placeholder="placeholder"
            :autocomplete="autocomplete"
            v-model="model"
        />

        <form-error v-if="error">
            {{  error }}
        </form-error>
    </div>
</template>
<script lang="ts" setup>
import { onMounted } from 'vue';
const props = defineProps({
    label: {
        type: String,
        default: null,
    },
    type: {
        type: String,
        default: "text",
    },
    name: {
        type: String,
        default: "",
    },
    autocomplete: {
        type: String,
        default: "off",
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
    placeholder: {
        type: String,
        default: null,
    },
    modelValue:{
        type: String,
        default: null
    }
});

const id = Math.random().toString(36).substring(7);
const model = defineModel();

onMounted(() => {
  if(props.modelValue){
    model.value = props.modelValue
  }
})

</script>
