import { defineStore } from "pinia";
export const useProductStore = defineStore("products", () => {
  interface Product {
    id: number;
    name: string;
    slug: string;
    short_info: string;
    category_id: number;
    subcategory_id?: number;
    price: number;
    description: string;
    in_stock: boolean;
    visible: boolean;
  }

  const products = ref<Product[]>([])

  const dummyProducts = () => {
    return [
      {
        id: 1,
        name: "Product 1",
      },
      {
        id: 2,
        name: "Product 2",
      },
      {
        id: 3,
        name: "Product 3",
      },
    ];
  };

  const getProducts = async () => {
    const { data } : { data: _AsyncData<Product[]>} = await useApi("/products");
    
    console.log(data.value);
    
    products.value = data.value
        
  };

  return { products, getProducts, dummyProducts };
});
