<template>
  <div class="bg-blue-100">
    <layout-container>
        <div class="grid lg:grid-cols-2 text-center lg:text-left">
            <div class="py-32 space-y-2">
              <h1 class="text-4xl font-bold">Welcome to Kirinyaga online stores!</h1>
              <h3 class="text-2xl">
                Your Trusted Source for Quality Tools and Equipment.
              </h3>
            </div>
        </div>
    </layout-container>
  </div>
  <layout-container class="py-10">
    <layout-header>
      <layout-title>Latest products</layout-title>
      <c-button @click="store.getProducts()">Refresh</c-button>
    </layout-header>

    <div class="column md:columns-2 lg:columns-3 column-gap">
      <nuxt-link
        :to="`/products/${p.slug}`"
        v-for="p in store.products"
        :key="p.id"
      >
        <div class="border rounded p-3 space-y-2 mb-4">
          <h1 class="text-lg">
            {{ p.name }}
          </h1>
          <p class="text-gray-600">
            {{ p.short_info }}
          </p>
        </div>
      </nuxt-link>
    </div>
  </layout-container>

  <div class="py-10 bg-red-100">
    <layout-container>
      <h1 class="text-3xl font-medium">
        Ready to take your home improvement game to the next level?
      </h1>

      <p class="mt-2 text-lg">
        Start browsing our collection now and discover:
      </p>

      <ul class="flex flex-col space-y-2 mt-10">
        <li>High-quality hand tools for everyday repairs and maintenance.</li>
        <li>
          Power equipment for efficient landscaping, woodworking, and more.
        </li>
        <li>
          Safety gear and accessories to ensure a secure and comfortable working
          environment.
        </li>
        <li>
          Expert advice and resources to guide you through your projects with
          ease.
        </li>
        <li>
          Join thousands of satisfied customers who trust Kirinyaga Online Stores for
          all their home improvement needs. Shop with confidence, knowing that
          each product is backed by our commitment to excellence and customer
          satisfaction. Transform your home into your dream space today with
          Kirinyaga Online Stores - where quality meets affordability.
        </li>
      </ul>
    </layout-container>
  </div>
  <div class="py-10">
    <layout-container>
      <h1 class="text-4xl font-bold mb-3">Contacts</h1>
      <div class="space-y-4 mt-10">
        <div
          v-for="(contact, index) in contacts"
          :key="`contact-${index}`"
          class="flex items-center space-x-3"
        >
          <component :is="contact.icon" class="h-6" />
          <a class="text-lg" :href="`${contact.label}`">
            {{ contact.label }}
          </a>
        </div>
      </div>
    </layout-container>
  </div>

</template>
<script lang="ts" setup>
import { useProductStore } from "@/store/products";
import { PhoneIcon, EnvelopeIcon } from "@heroicons/vue/24/outline";
const store = useProductStore();

const contacts = ref([
  {
    icon: PhoneIcon,
    action: "tel",
    label: "+ 254 712 234123 ",
  },
  {
    icon: EnvelopeIcon,
    action: "mail",
    label: "example@kos.com ",
  },
]);
onMounted(async () => {
  await store.getProducts();
});
</script>
