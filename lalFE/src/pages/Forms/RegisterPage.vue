<template>
  <q-page
    class="fit row justify-around items-center content-center"
    style="color: black"
  >
    <div
      class="q-my-md col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 flex justify-center content-center align-center"
    >
      <q-form @submit="Register">
        <div class="text-h4 text-center">ساخت حساب</div>

        <div class="q-mt-xl full-width">
          <div class="q-my-md" style="font-size: 18px">نام</div>
          <q-input
            autofocus
            class="text-wieght-bold"
            filled
            :rules="[(val) => !!val || 'نام اجباری است']"
            v-model="name"
            type="text"
            label="نام را وارد کنید"
            style="width: 350px; height: 68px"
          >
            <template v-slot:append> <q-icon name="person" /> </template
          ></q-input>
        </div>

        <div class="q-mt-lg full-width">
          <div class="q-my-md" style="font-size: 18px">ایمیل</div>
          <q-input
            autofocus
            class="text-wieght-bold"
            filled
            :rules="[(val) => !!val || 'ایمیل اجباری است']"
            v-model="email"
            type="email"
            label="ایمیل خود را وارد کنید"
            style="width: 350px; height: 68px"
          >
            <template v-slot:append> <q-icon name="person" /> </template
          ></q-input>
        </div>

        <div class="q-mt-md full-width">
          <div class="q-my-md" style="font-size: 18px">رمز عبور</div>
          <q-input
            v-model="password"
            filled
            :rules="[(val) => !!val || 'رمز عبور اجباری است']"
            :type="isPwd ? 'password' : 'text'"
          >
            <template v-slot:append>
              <q-icon
                :name="isPwd ? 'visibility_off' : 'visibility'"
                class="cursor-pointer"
                @click="isPwd = !isPwd"
              />
            </template>
          </q-input>

          <div class="q-my-md" style="font-size: 18px">تایید رمز عبور</div>

          <q-input
            v-model="passConfirm"
            filled
            :rules="[(val) => !!val || 'تایید رمز عبور اجباری است']"
            :type="isPwd ? 'password' : 'text'"
          >
            <template v-slot:append>
              <q-icon
                :name="isPwd ? 'visibility_off' : 'visibility'"
                class="cursor-pointer"
                @click="isPwd = !isPwd"
              />
            </template>
          </q-input>
        </div>

        <div class="q-mt-md">
          <q-btn
            label="ساخت حساب"
            type="submit"
            color="accent"
            style="width: 350px; height: 55px; font-size: 22px"
            @click="Register()"
          />
        </div>
      </q-form>
    </div>
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
    const email = ref();
    const password = ref();
    const passConfirm = ref();

    const error = ref();

    const destroy = ref(false);

    function Register() {
      api
        .post("/api/register", {
          name: name.value,
          email: email.value,
          password: password.value,
          password_confirmation: passConfirm.value,
        })
        .then((r) => {
          console.log(r.data);
          $router.push("/login");
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
      email,
      password,
      passConfirm,
      error,
      destroy,
      isPwd: ref(true),
      Register,
    };
  },
};
</script>
