<template>
  <div>
    <SlideWebBanner />
    <GroupProduct
      v-if="newArrival"
      title="NEW ARRIVAL"
      :type="0"
      :data="newArrival"
    />
    <CardLoadingSkeleton />
    <GroupProduct
      v-if="bestSeller"
      title="BEST SELLER"
      :type="0"
      :data="bestSeller"
    />
    <GroupProduct
      v-if="bestPrice"
      title="BEST PRICE"
      :type="1"
      :data="bestPrice"
    />
    <ModernTitle name="MIX & MATCH" />
    <img
      class="mb-16"
      src="https://cdn.boo.vn/media/wysiwyg/Ivory_Silver_Clean_Grid_Wedding_Instagram_Story_Video_2_.jpg"
    />
    <ModernTitle name="NEW COLLECTION" />
    <GroupCollection />
    <ModernTitle name="BOO | BRAND" />
    <GroupBrand class="mb-16" />
  </div>
</template>
<script setup lang="ts">
import axios from "axios";
import ModernTitle from "~/components/title/ModernTitle.vue";
import { ProductApiService } from "~/server/api/product";
useHead({
  title: "BOO | Home",
});
const newArrival = ref(null);
const bestPrice = ref(null);
const bestSeller = ref(null);
onMounted(async () => {
  try {
    const [resNewArrivals, resBestSellers, resBestPrice] = await Promise.all([
      ProductApiService.getProductNewArrivals(),
      ProductApiService.getProductBestSellers(),
      ProductApiService.getProductBestPrice(),
    ]);
    newArrival.value = resNewArrivals;
    bestSeller.value = resBestSellers;
    bestPrice.value = resBestPrice;
  } catch (error) {
    // Handle errors here
    console.error("Request failed:", error);
  }
});
</script>
<style>
v-icon {
  cursor: pointer;
}
</style>
