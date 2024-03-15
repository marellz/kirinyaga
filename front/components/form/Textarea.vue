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
            :class="{'border-red-500': error}"
            :placeholder="placeholder"
            :rows="rows"
            :name="name"
            v-model="model"
        ></textarea>

       <form-error v-if="error">
            {{  error }}
        </form-error>
    </div>
</template>
<script setup>
import { onMounted } from 'vue';
const props = defineProps({
    label: {
        type: String,
        default: null,
    },
    name: {
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
