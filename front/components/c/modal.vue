<template>
  <div
    class="fixed inset-0 h-full w-full invisible opacity-0 z-40"
    :class="{ '!opacity-100 !visible': show }"
  >
    <div
      class="bg-black opacity-40 fixed inset-0 h-full w-full"
      @click="close"
    ></div>
    <div class="p-20 flex justify-center relative z-50">
      <div class="bg-white rounded-lg w-1/2" :class="width">
        <div v-if="title || $slots.header" class="border-b py-5 px-5 flex">
            <slot name="header">
                <div class="flex-auto">
                    <h1 class="text-2xl font-bold">{{ title }}</h1>
                </div>
            </slot>
          <button type="button" @click="close">
            <x-mark-icon class="h-8" />
          </button>
        </div>
        <div class="p-5">
          <template v-if="!title && !$slots.header">
            <div class="flex justify-end pb-3">
                <button type="button" @click="close">
                  <x-mark-icon class="h-8" />
                </button>
            </div>
          </template>
          <slot />
        </div>
      </div>
    </div>
  </div>
</template>
<script lang="ts" setup>
import { XMarkIcon } from "@heroicons/vue/24/solid";
defineProps({
  title: {
    type: String,
    default: null,
  },
  show: {
    type: Boolean,
    default: false,
  },
  width:{
    type: String,
    default: 'max-w-[50vw]'
  }
});

const emit = defineEmits(["close"]);
const close = () => emit("close");
</script>
