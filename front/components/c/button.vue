<template>
  <button
    class="inline-flex justify-center align-items-center py-1 font-medium px-4 rounded-lg border-2"
    :type="type"
    :class="colorVariant"
  >
    <slot />
  </button>
</template>
<script lang="ts" setup>

interface BtnProps {
  variant?: string;
  type?: 'submit' | 'button' | 'reset';
}

const props = withDefaults(defineProps<BtnProps>(), {
  type: 'button',
  variant: 'primary'
});

enum VariantEnum {
  PRIMARY = "primary",
  PRIMARY_OUTLINE = "primary-outline",
  SECONDARY = "secondary",
  SECONDARY_OUTLINE = "secondary-outline",
  CANCEL = "cancel",
}

interface VariantTypes {
  primary: string;
  "primary-outline": string;
  secondary: string;
  "secondary-outline": string;
  cancel: string;
}

const variants: VariantTypes = {
  [VariantEnum.PRIMARY]: "border-blue-600 bg-blue-600 text-white",
  [VariantEnum.PRIMARY_OUTLINE]: "border-blue-600 text-blue-600",
  [VariantEnum.SECONDARY]: "border-blue-400 text-black",
  [VariantEnum.SECONDARY_OUTLINE]: "border-blue-400 text-gray-400",
  [VariantEnum.CANCEL]: "border-gray-500 bg-gray-500 text-white",
};

const colorVariant = computed(() => [
  variants[props.variant as keyof VariantTypes],
]);
</script>
