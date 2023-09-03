<template>
  <q-page
    class="flex justify-center align-center items-center content-center text-center"
  >
    <swiper :pagination="true" :modules="modules">
      <swiper-slide
        class="row justify-center align-center items-center content-center text-center"
      >
        <div class="col-12" style="width: 250px">
          Lorem, ipsum dolor sit amet consectetur adipisicing elit. Adipisci
          consequatur pariatur ratione delectus.
        </div>
      </swiper-slide>

      <swiper-slide
        class="row justify-center align-center items-center content-center text-center"
      >
        <div class="col-12" style="width: 250px">
          Lorem, ipsum dolor sit amet consectetur adipisicing elit. Adipisci
          consequatur pariatur ratione delectus.
        </div>
      </swiper-slide>

      <swiper-slide
        class="row justify-center align-center items-center content-center text-center q-mt-lg"
      >
        <div class="col-12 q-mt-lg" style="width: 250px">
          Lorem, ipsum dolor sit amet consectetur adipisicing elit. Adipisci
          consequatur pariatur ratione delectus.
        </div>
        <div class="col-12 q-mt-lg">
          <q-btn class="q-mx-md" to="/" flat label="صفحه اصلی" />
          <q-btn class="q-mx-md" to="/login" flat label="ورود" />
        </div>
      </swiper-slide>
    </swiper>
  </q-page>
</template>
<script>
import { Swiper, SwiperSlide } from "swiper/vue";

import { Pagination } from "swiper";

import "swiper/css";

import "swiper/css/pagination";

export default {
  components: {
    Swiper,
    SwiperSlide,
  },
  setup() {
    return {
      modules: [Pagination],
    };
  },
};
</script>

<style>
.swiper-pagination {
  position: fixed !important;
  bottom: 0px !important;
}
.swiper-horizontal > .swiper-pagination-bullets,
.swiper-pagination-bullets.swiper-pagination-horizontal,
.swiper-pagination-custom,
.swiper-pagination-fraction {
  bottom: 0 !important;
}
</style>
