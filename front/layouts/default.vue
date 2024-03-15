<template>
  <div class="h-[100vh] flex flex-col">
    <header class="py-6">
      <layout-container>
        <div class="flex items-center">
          <images-logo />

          <div class="mx-auto">
            <nav class="flex">
              <nuxt-link
                :to="link.path"
                v-for="(link, index) in links"
                :key="index"
                class="px-2"
              >
                {{ link.label }}
              </nuxt-link>
            </nav>
          </div>

          <div class="flex space-x-3">
            <c-link href="#" variant="primary-outline" class="space-x-2">
              <magnifying-glass-icon class="h-4" />
              <span>Search</span>
            </c-link>
            <c-button variant="primary" @click="authModalActive = true">
              <span>Login</span>
            </c-button>
          </div>
        </div>
      </layout-container>
    </header>

    <main class="flex-auto">
      <slot />
    </main>
    
    <footer class="py-3">
      <layout-container>
        <p class="text-center text-gray-500">Designed and Developed by <a href="#">this cool dude.</a></p>
      </layout-container>
    </footer>

    <c-modal
      width="max-w-[480px]"
      :show="authModalActive"
      @close="authModalActive = false"
      title="Login"
    >
      <forms-login />
    </c-modal>
  </div>
</template>
<script lang="ts" setup>
import { MagnifyingGlassIcon } from "@heroicons/vue/24/outline";
const links = [
  {
    label: "Home",
    path: "/",
  },
  {
    label: "Products",
    path: "/products",
  },
  {
    label: "Categories",
    path: "/categories",
  },
];

const authModalActive = ref(false);
</script>
