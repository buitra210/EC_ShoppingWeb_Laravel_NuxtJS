<template>
  <div class="flex relative items-center mb-16 slide-container">
    <div class="absolute left-4 top-1/2 transform -translate-y-1/2 z-10">
      <div class="navigation-arrow">
        <v-icon
          class="cursor-pointer text-white text-[1.5rem]"
          @click="previousSlide"
          >mdi-chevron-left</v-icon
        >
      </div>
    </div>

    <div class="relative w-full h-auto overflow-hidden">
      <div class="relative w-full">
        <img
          v-for="(slide, index) in slides"
          :key="index"
          v-show="index === current"
          class="w-full fade-transition"
          :src="slide"
          :class="{
            'opacity-100': index === current,
            'opacity-0': index !== current,
          }"
        />
      </div>
    </div>

    <div class="absolute right-4 top-1/2 transform -translate-y-1/2 z-10">
      <div class="navigation-arrow">
        <v-icon
          class="cursor-pointer text-white text-[1.5rem]"
          @click="nextSlide"
          >mdi-chevron-right</v-icon
        >
      </div>
    </div>

    <!-- Slide indicators -->
    <div
      class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10"
    >
      <button
        v-for="(slide, index) in slides"
        :key="index"
        @click="goToSlide(index)"
        class="w-3 h-3 rounded-full slide-indicator"
        :class="[
          index === current
            ? 'bg-white active'
            : 'bg-white/50 hover:bg-white/75',
        ]"
      ></button>
    </div>
  </div>
</template>
<script setup lang="ts">
const current = ref(0);
const slides = [
  "https://cdn.boo.vn/media/wysiwyg/trang_chu_1209-02-compressed.jpg",
  "https://cdn.boo.vn/media/wysiwyg/1920x950px-3_1.jpg",
  "https://cdn.boo.vn/media/wysiwyg/online_webbanner_pc.png",
  "https://cdn.boo.vn/media/wysiwyg/1920x950px-4_2.png",
];

let autoSlideInterval: NodeJS.Timeout | null = null;

const nextSlide = () => {
  current.value = (current.value + 1) % slides.length;
};

const previousSlide = () => {
  current.value = current.value === 0 ? slides.length - 1 : current.value - 1;
};

const goToSlide = (index: number) => {
  current.value = index;
  resetAutoSlide();
};

const startAutoSlide = () => {
  autoSlideInterval = setInterval(() => {
    nextSlide();
  }, 5000);
};

const resetAutoSlide = () => {
  if (autoSlideInterval) {
    clearInterval(autoSlideInterval);
  }
  startAutoSlide();
};

onMounted(() => {
  startAutoSlide();
});

onUnmounted(() => {
  if (autoSlideInterval) {
    clearInterval(autoSlideInterval);
  }
});
</script>

<style scoped>
.slide-enter-active,
.slide-leave-active {
  transition: all 0.6s cubic-bezier(0.55, 0.085, 0.68, 0.53);
}

.slide-enter-from {
  opacity: 0;
  transform: translateX(100%);
}

.slide-leave-to {
  opacity: 0;
  transform: translateX(-100%);
}

.slide-enter-to,
.slide-leave-from {
  opacity: 1;
  transform: translateX(0%);
}

/* Smooth fade transition for better performance */
.fade-transition {
  transition: opacity 0.5s ease-in-out;
}

/* Hover effects for navigation arrows */
.navigation-arrow {
  transition: all 0.3s ease;
  backdrop-filter: blur(4px);
  background: rgba(0, 0, 0, 0.3);
  border-radius: 50%;
  padding: 8px;
}

.navigation-arrow:hover {
  background: rgba(0, 0, 0, 0.6);
  transform: scale(1.1);
}

/* Slide container */
.slide-container {
  position: relative;
  overflow: hidden;
  border-radius: 8px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

/* Indicator animation */
.slide-indicator {
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  backdrop-filter: blur(4px);
}

.slide-indicator:hover {
  transform: scale(1.2);
}

.slide-indicator.active {
  transform: scale(1.1);
  box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
}
</style>
