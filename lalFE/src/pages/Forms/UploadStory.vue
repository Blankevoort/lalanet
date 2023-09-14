<template>
  <q-page class="fit row justify-around items-center content-center">
    <q-card
      flat
      bordered
      class="r-25 col-xs-12 col-sm-12 col-md-7 col-lg-6 col-xl-5"
    >
      <q-card-section>
        <div class="text-h6 text-center">آپلود داستان</div>
      </q-card-section>
      <q-separator inset color="dark-grey-8" />
      <q-card-section class="q-gutter-y-md">
        <q-input
          label-color="black"
          v-model="name"
          label="نام داستان:"
          :rules="[(val) => !!val || 'نام داستان اجباری است']"
        />
        <div>داستان:</div>
        <q-input v-model="story" autogrow />
      </q-card-section>
      <q-card-actions align="around">
        <q-btn
          class="full-width"
          color="accent"
          label="Upload"
          @click="Upload"
        />
      </q-card-actions>
    </q-card>
  </q-page>
</template>

<script>
import { ref } from "vue";
import { api } from "src/boot/axios";

import { useRouter } from "vue-router";
import { useQuasar } from "quasar";

export default {
  setup() {
    const $q = useQuasar();
    const $router = useRouter();
    const nerror = ref(true);

    const name = ref();
    const story = ref();

    const error = ref();

    const destroy = ref(false);

    function Upload() {
      api
        .post("/api/stories", {
          name: name.value,
          story: story.value,
        })
        .then((r) => {
          $router.push("/dashboard");
        })
        .catch((err) => {
          if (err.response) {
            destroy.value = true;
            if (err.response.status === 400) {
              error.value = "با اطلاعات وارد شده نمیتوان وارد شد.";
              triggerError();
            } else if (err.response.status === 401) {
              error.value = "اطلاعات وارد شده معتبر نیستند.";
              triggerError();
            } else if (err.response.status === 403) {
              error.value = "دسترسی غیرمجاز.";
              triggerError();
            } else {
              error.value = "خطای سمت سرور: درخواست نامعتبر.";
              triggerError();
            }
          } else if (err.request) {
            error.value = "خطای سمت سرور: درخواست ارسال نشد.";
            triggerError();
          } else {
            error.value = "خطای سمت سرور: خطای نامشخص رخ داد.";
            triggerError();
          }
        });
    }

    function triggerError() {
      $q.notify({
        position: "top-left",
        type: "negative",
        message: error.value,
        badgeStyle: "opacity: 0",
      });
    }

    // tarife zarf ha va dastorat

    return {
      nerror,
      name,
      story,
      error,
      destroy,
      Upload,
    };
  },
};
</script>
