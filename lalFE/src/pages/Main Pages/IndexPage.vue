<template>
  <q-page class="q-mt-md">
    <div class="row justify-between">
      <q-avatar color="white" size="60px" class="border">
        <img class="absolute-center" src="/Images/bell.png" />
      </q-avatar>
      <q-avatar color="white" size="60px" class="border">
        <img class="absolute-center icon" src="/Images/fire.png" />
      </q-avatar>
      <q-avatar color="white" size="60px" class="border">
        <img class="absolute-center icon" src="/Images/gift.png" />
      </q-avatar>
      <q-avatar color="white" size="60px" class="border">
        <img class="absolute-center icon" src="/Images/heart.png" />
      </q-avatar>
    </div>

    <div class="q-mt-xl">
      <div class="font-15 text-weight-bold SlideInFromTop">موضوعات</div>
      <div class="q-mt-md SlideInFromTop">
        <q-card
          class="bg7 round14 row wrap justify-between items-center content-center"
          style="height: 155px;!important"
          flat
          bordered
        >
          <div class="col-6">
            <div class="q-pt-xs q-mt-sm">
              <div class="text-white font-15 q-pa-md">
                خواندن و شندیدن داستان ها و لالایی های متنوع!
              </div>
            </div>

            <q-btn
              unelevated
              rounded
              class="bg9 text-white font-12 text-weight-medium btn q-ml-sm q-mb-sm"
              label="اکنون ببینید"
            />
          </div>

          <div class="col-6">
            <q-img
              class="rounded-borders absolute-top-right"
              src="/Images/about.png"
              style="width: 150px; height: 150px"
            />
          </div>
        </q-card>
      </div>
    </div>

    <div
      class="q-mt-xl q-mb-sm row justify-between content-center align-center text-center"
    >
      <q-card
        style="width: 140px; height: 140px"
        class="bg4 round15 text-center col-6 SlideInFromRight"
        @click="$router.push('/intro')"
      >
        <div class="absolute-center">
          <img class="my-img" src="/Images/introduction.png" />
        </div>

        <q-card-section class="absolute-bottom q-mb-xs">
          <div class="font-13 text-weight-bold">توضیحات</div>
        </q-card-section>
      </q-card>

      <q-card
        style="background-color: #d5f8e5; width: 140px; height: 140px"
        class="round15 text-center col-6 SlideInFromRight"
        @click="$router.push('/all-lalaies')"
      >
        <div class="absolute-center">
          <img class="my-img q-mb-md" src="/Images/Lalaies.png" />
        </div>

        <q-card-section class="absolute-bottom q-mb-xs">
          <div class="font-13 text-weight-bold">لالایی ها</div>
        </q-card-section>
      </q-card>

      <q-card
        v-if="userRegistered"
        style="width: 140px; height: 140px"
        class="bg5 round15 text-center col-6 SlideInFromRight q-mt-md"
        @click="$router.push('/all-stories')"
      >
        <div class="absolute-center">
          <img class="my-img q-mb-sm" src="/Images/letters.png" />
        </div>

        <q-card-section class="absolute-bottom q-mb-xs">
          <div class="font-13 text-weight-bold">داستان ها</div>
        </q-card-section>
      </q-card>

      <q-card
        v-if="userRegistered"
        style="background-color: #fff3d1; width: 140px; height: 140px"
        class="round15 text-center col-6 SlideInFromRight q-mt-md"
        @click="$router.push('/dashboard')"
      >
        <div class="absolute-center">
          <img class="my-img q-mb-md" src="/Images/profile.png" />
        </div>

        <q-card-section class="absolute-bottom q-mb-xs">
          <div class="font-13 text-weight-bold">پروفایل</div>
        </q-card-section>
      </q-card>
    </div>
  </q-page>
</template>

<script>
import { ref, onBeforeMount } from "vue";
import { api } from "src/boot/axios";

import { useRouter } from "vue-router";

export default {
  setup() {
    const userinfo = ref([]);
    const userRegistered = ref(false);

    function fetchUserData() {
      api.get("api/user").then((r) => {
        userinfo.value = r.data;
        userRegistered.value = true;
      });
    }

    onBeforeMount(() => {
      fetchUserData();
    });

    return {
      userinfo,
      userRegistered,
    };
  },
};
</script>

<style scoped>
.border {
  border-style: solid;
  border-color: #e6e8eb;
}

.q-avatar__content,
.q-avatar img:not(.q-icon):not(.q-img__image) {
  height: auto;
}

.q-avatar__content,
.q-avatar img:not(.q-icon):not(.q-img__image) {
  border-radius: unset !important;
}

.icon {
  width: 30px !important;
  height: 30px !important;
}

.round14 {
  border-radius: 14px;
}

.round15 {
  border-radius: 15px;
}

.my-img {
  width: 122px !important;
  height: 121px !important;
}

.q-card__section--vert {
  padding: 0;
}

.btn {
  width: 100px !important;
  height: 38px !important;
}

@keyframes SlideInRight {
  from {
    transform: translateX(300px);
  }

  to {
    transform: translateX(0px);
  }
}

.SlideInFromRight {
  animation-name: SlideInRight;
  animation-duration: 1s;
  animation-timing-function: ease-in;
}

@keyframes SlideInTop {
  from {
    transform: translateY(-450px);
  }

  to {
    transform: translateY(0px);
  }
}

.SlideInFromTop {
  animation-name: SlideInTop;
  animation-duration: 2s;
  animation-timing-function: ease-in;
}
</style>
