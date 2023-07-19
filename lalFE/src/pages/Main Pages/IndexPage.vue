<template>
  <q-page class="q-mt-md">
    <div class="row justify-between">
      <q-avatar color="white" size="60px" class="border">
        <img class="absolute-center" src="/Images/bell.png">
      </q-avatar>
      <q-avatar color="white" size="60px" class="border">
        <img class="absolute-center icon" src="/Images/fire.png">
      </q-avatar>
      <q-avatar color="white" size="60px" class="border">
        <img class="absolute-center icon" src="/Images/gift.png">
      </q-avatar>
      <q-avatar color="white" size="60px" class="border">
        <img class="absolute-center icon" src="/Images/heart.png">
      </q-avatar>
    </div>



    <div class="q-mt-xl">
      <div class="font-15 text-weight-bold">Popular Topics</div>
      <div class="q-mt-md">
        <q-card class="bg7 round14" flat bordered>
          <q-card-section horizontal>
            <q-card-section class="q-pt-xs q-mt-sm">
              <div class="text-white font-15 q-pa-md">
                Find Amazing Lessons For Your Kid
              </div>
            </q-card-section>

            <q-card-section class="col-5 flex flex-center">
              <q-img class="rounded-borders absolute-top-right" src="/Images/about.png" />
            </q-card-section>
          </q-card-section>

          <q-card-actions>
            <q-btn unelevated rounded class="bg9 text-white font-12 text-weight-medium btn text-center"
              label="Find Now" />
          </q-card-actions>
        </q-card>
      </div>
    </div>



    <div class="q-mt-xl q-mb-sm row justify-between">
      <q-card class="bg4 round15 card text-center col-6">
        <div class="absolute-center">
          <img class="my-img " src="/Images/introduction.png">
        </div>

        <q-card-section class="absolute-bottom">
          <div class="font-13 text-weight-bold">Introduction</div>
          <div class="text-subtitle2 text-grey">5/5</div>
        </q-card-section>
      </q-card>

      <q-card class="bg5 round15 card text-center col-6">
        <div class="absolute-center">
          <img class="my-img " src="/Images/letters.png">
        </div>

        <q-card-section class="absolute-bottom">
          <div class="font-13 text-weight-bold">Letters</div>
          <div class="text-subtitle2 text-grey">6/6</div>
        </q-card-section>
      </q-card>
    </div>

  </q-page>
</template>

<script>
import { useRouter } from 'vue-router';

export default {
  setup() {

    return {
    };
  },
};
</script>

<style>
.border {
  border-style: solid;
  border-color: #E6E8EB;
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

.card {
  width: 155px !important;
  height: 160px !important;
}

.q-card__section--vert {
  padding: 0;
}

.btn {
  width: 78px !important;
  height: 38px !important;
}
</style>
