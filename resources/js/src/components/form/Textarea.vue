<template>
    <div class="flex flex-col">
        <label :for="id" class="block font-medium text-sm text-gray-700 mb-2">
            {{ label }}
        </label>
        <textarea
            :id="id"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            :disabled="disabled"
            :required="required"
            :class="{'border-red-500': errors}"
            :placeholder="placeholder"
            :rows="rows"
            v-model="model"
        ></textarea>

        <slot name="errors" s/>
    </div>
</template>
<script setup>
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
    placeholder: {
        type: String,
        default: null,
    },
    modelValue:{
        type: String,
        default: null
    },
    rows :{
        type: [String, Number],
        default: '3'
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
