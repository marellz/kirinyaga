<template>
  <div class="p-3 rounded my-3" :class="colorVariant.bg">
    <h1 v-if="title" class="text-lg font-bold mb-2" :class="colorVariant.title">
      {{ title }}
    </h1>
    <div>
      <slot />
    </div>
  </div>
</template>
<script lang="ts" setup>
enum VariantsEnum {
  SUCCESS = "success", // green
  INFO = "info", // blue
  WARNING = "warning", // amber
  DANGER = "danger", // red
}

let variantArr = ["success"];

interface VariantColorTypes {
  bg: string;
  title?: string;
}

interface VariantTypes {
  [VariantsEnum.SUCCESS]: VariantColorTypes;
  [VariantsEnum.INFO]: VariantColorTypes;
  [VariantsEnum.WARNING]: VariantColorTypes;
  [VariantsEnum.DANGER]: VariantColorTypes;
}

const variants: VariantTypes = {
  [VariantsEnum.SUCCESS]: { bg: "bg-green-200", title: "text-green-600" },
  [VariantsEnum.INFO]: { bg: "bg-blue-200", title: "text-blue-600" },
  [VariantsEnum.WARNING]: { bg: "bg-amber-200", title: "text-amber-600" },
  [VariantsEnum.DANGER]: { bg: "bg-red-200", title: "text-red-500" },
};

const props = withDefaults(
  defineProps<{
    title?: string;
    variant: string;
  }>(),
  {
    variant: "warning",
  }
);

const colorVariant = computed(
  () => variants[props.variant as keyof VariantTypes]
);
</script>
