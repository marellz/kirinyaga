<template>
<layout-container>

    <layout-title>Products</layout-title>

    <div class="grid lg:grid-cols-3 gap-10 mt-10">
        <nuxt-link class="flex flex-col space-y-3 rounded-lg p-5 bg-gray-50 hover:bg-blue-50" :to="`/products/${p.id}`" v-for="p in products" :key="p.id">
            <div class="flex items-center space-x-2">
                <h1 class="text-xl font-medium">
                    {{  p.name }}
                </h1>
                <span class="bg-blue-100 px-3 py-1 text-sm rounded-full text-center max-w-96 line-clamp-1" :title="p.category.name">{{ p.category.name }}</span>
            </div>
            <p class="text-gray-600">
                {{ p.short_info }}
            </p>
            <p class="font-bold" v-if="p.price">
                Ksh. {{  p.price.toLocaleString() }}
            </p>
        </nuxt-link>
    </div>
</layout-container>
</template>
<script lang="ts" setup>
import { useProductStore } from '~/store/products';
const store = useProductStore()
const products = computed(()=>store.products)

onMounted(()=>{
    store.getProducts()
})
</script>