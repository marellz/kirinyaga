import { defineStore } from "pinia";
import type { Product as ProductType } from "~/types/product";
export const useProductStore = defineStore("products", () => {
  const products = ref<ProductType[]>([]);

  const { $api } = useNuxtApp();

  const getProducts = async () => {
    let { items }: { items: ProductType[] } = await $api.get("/products");
    products.value = items;
  };

  const getProduct = async (slug: string | string[]) => {
    let { item }: { item: ProductType } = await $api.get(`/products/${slug}`);
    return item;
  };

  return { products, getProducts, getProduct };
});
