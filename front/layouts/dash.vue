<template>
  <div class="flex h-[100vh]">
    <div class="w-64 bg-black text-white p-10 border flex flex-col">
      <nav class="flex flex-col">
        <nuxt-link
          :to="link.path"
          v-for="(link, index) in links"
          :key="index"
          class="px-2 py-3 text-lg"
        >
          {{ link.label }}
        </nuxt-link>
      </nav>

       <nav class="flex flex-col mt-auto">
        <nuxt-link
          to="/"
          class="px-2 py-3 text-lg"
        >
          Back to client
        </nuxt-link>
      </nav>
    </div>
    <div class="flex-auto border overflow-auto">
        <header class="py-5">
            <layout-container>
                <images-logo />

            </layout-container>

        </header>

        <main class="py-5">
            <layout-container>
                <slot />

            </layout-container>

        </main>

    </div>
  </div>
</template>
<script lang="ts" setup>
const links = [
  {
    label: "Home",
    path: "/dash",
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
</script>
