<template>
  <div>
    <img
      v-if="banners[0]"
      v-for="(banner, index) in banners"
      :key="index"
      :src="banner"
      class="w-full"
    />
    <div v-else class="w-full h-[0.01rem]"></div>
    <ListProduct v-if="collection" :data="collection" />
  </div>
</template>
<script setup lang="ts">
import axios from "axios";
useHead({
  title: "BOO | Flex to school",
});
const banners = [
  "https://cdn.boo.vn/media/wysiwyg/Desktop_B2S_1.webp",
  "https://cdn.boo.vn/media/wysiwyg/Desktop_B2S_2.webp",
  "https://cdn.boo.vn/media/wysiwyg/Desktop_B2S_3.webp",
  "https://cdn.boo.vn/media/wysiwyg/Desktop_B2S_4.webp",
  "https://cdn.boo.vn/media/wysiwyg/Desktop_B2S_5.webp",
  "https://cdn.boo.vn/media/wysiwyg/Desktop_B2S_6.webp",
  "https://cdn.boo.vn/media/wysiwyg/Desktop_B2S_7.webp",
  "https://cdn.boo.vn/media/wysiwyg/Desktop_B2S_8_.webp",
  "https://cdn.boo.vn/media/wysiwyg/Desktop_B2S_9.webp",
  "https://cdn.boo.vn/media/wysiwyg/Desktop_B2S_10.webp",
];
const collection = ref(null);
onMounted(async () => {
  try {
    const response = await axios.get(
      "/api/api/products/collection/booxessentials"
    );
    // Handle the response data here
    collection.value = response.data;
    // console.log(response.data);
  } catch (error) {
    // Handle errors here
    console.error("Request failed:", error);
  }
});
</script>
