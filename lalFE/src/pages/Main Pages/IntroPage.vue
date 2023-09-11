<template>
  <q-page
    class="flex justify-center align-center items-center content-center text-center bg-primary"
  >
    <swiper :pagination="true" :modules="modules">
      <swiper-slide
        class="row justify-center align-center items-center content-center text-center q-mt-lg"
      >
        <div class="col-12 text-h4">لالانینی چیه؟</div>
        <div class="col-12 q-mt-md" style="width: 250px; font-size: 15px">
          لالانینی برنامه ای برای آرامش کودکانتونه که میتونید باهاش برای کودک
          خودتون لالایی پخش کنید یا براش داستان بخونید.
        </div>
      </swiper-slide>

      <swiper-slide
        class="row justify-center align-center items-center content-center text-center q-mt-lg"
      >
        <div class="col-12 text-h4">چیکارا میکنه؟</div>
        <div class="col-12 q-mt-md" style="width: 250px">
          این برنامه لیستی از لالایی ها و داستان ها رو براتون قرار میده که
          میتونید بستگی به زبان یا حتی حالتی که کودکتون هست (غمگین و شاد
          و...)انتحاب کنید و پخش کنید یا برای بچه هاتون بخونید.
        </div>
      </swiper-slide>

      <swiper-slide
        class="row justify-center align-center items-center content-center text-center q-mt-lg"
      >
        <div class="col-12 text-h4">چطور کار میکنه؟</div>
        <div class="col-12 q-mt-lg" style="width: 250px">
          شما میتونید به صورت مهمان این برنامه رو ببینید و در حالت مهمان شما
          تنها به بخش لالایی ها دسترسی دارید ولی بعد ورود شما میتونید خودتون
          لالایی و داستان قرار بدین و دسترسی کامل به برنامه دارید.
        </div>
        <div class="col-12 q-mt-lg">
          <q-btn color="warning" class="q-mx-md" to="/" label="حالت مهمان" />
          <q-btn
            outline
            color="accent"
            class="q-mx-md"
            to="/login"
            label="ورود"
          />
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
