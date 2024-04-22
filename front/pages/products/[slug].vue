<template>
  <layout-container>
    <template v-if="product">
        <layout-title>
          {{ product.name }}
        </layout-title>
    </template>
  </layout-container>
</template>
<script lang="ts" setup>
import { useProductStore } from "~/store/products";
import { useRoute } from "vue-router";
import {type Product as ProductType} from '~/types/product'
const route = useRoute();
const slug = computed(() => route.params.slug);
onMounted(() => {
  store.getProduct(slug.value);
});

const store = useProductStore();
const product = ref<ProductType>()
</script>
