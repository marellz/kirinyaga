<template>
    <form-select
        label="Category"
        :model-value="categoryId"
        @select="onSelectCategory"
        v-model:category="selectedCategory"
        name="category_id"
        placeholder="Select product category"
        :error="categoryError"
    >
        <template v-if="categories.length">
            <option
                :value="cat.id"
                v-for="(cat, index) in categories"
                :key="index"
            >
                {{ cat.name }}
            </option>
        </template>
    </form-select>

    <form-select
        label="Subcategory"
        :model-value="subcategoryId"
        v-model:subcategory="selectedSubcategory"
        :disabled="loadingSubcategories"
        name="subcategory_id"
        placeholder="Select product subcategory"
    >
        <option
            :value="subcategory.id"
            v-for="(subcategory, index) in subcategories"
            :key="index"
        >
            {{ subcategory.name }}
        </option>
    </form-select>
</template>
<script lang="ts" setup>
import axios from "axios";
import { onMounted, ref } from "vue";
const props = defineProps({
    product: {
        type: String,
        default: null,
    },
    categoryId: {
        type: String,
        default: null,
    },
    categoryError: {
        type: String,
        default: null,
    },
    subcategoryId: {
        type: String,
        default: null,
    },
});

interface Category {
    id: number;
    slug: string;
    name: string;
}

interface Subcategory {
    id: number;
    category_id: number;
    slug: string;
    name: string;
}

const categories = ref<Category[]>([]);
const subcategories = ref<Subcategory[]>([]);

const loadingSubcategories = ref(false);

const selectedCategory = defineModel("category");
const selectedSubcategory = defineModel("subcategory");

const onSelectCategory = (c: string | number) => {
    subcategories.value = [];
    loadSubcategories(c);
};

const loadCategories = async () => {
    const {
        data: { categories: items },
    } = await axios.get("/api/categories");
    categories.value = items;
};

const loadSubcategories = async (category: string | number) => {
    loadingSubcategories.value = true;

    const {
        status,
        data: { subcategories: list },
    } = await axios.get(`/api/categories/${category}`);
    subcategories.value = list;


    if(status){
        loadingSubcategories.value = false
    }
};

onMounted(() => {
    loadCategories();

    if (props.categoryId) {
        selectedCategory.value = props.categoryId

        loadSubcategories(props.categoryId);

        if(props.subcategoryId){
            selectedSubcategory.value = props.subcategoryId
        }
    }
});
</script>
