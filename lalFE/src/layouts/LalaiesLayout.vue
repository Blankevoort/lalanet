<template>
  <q-layout view="hHh lpR lFf">
    <q-header class="bg4 text-black q-pa-md">
      <div class="row justify-between">
        <q-avatar class="bg2" v-if="userRegistered">
          <img
            src="/Images/profile-image.png"
            class="absolute-center"
            alt="pfp"
            @click="$router.push('/dashboard')"
          />
        </q-avatar>

        <q-btn
          v-else
          outline
          color="secondary"
          class="float-right"
          to="/login"
          label="ورود"
        />

        <div class="font-16 text-weight-bold q-mt-sm">لالایی ها</div>

        <q-btn to="/" flat>
          <q-icon name="arrow_back" />
        </q-btn>
      </div>
    </q-header>

    <q-page-container class="bg-primary">
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { ref, onBeforeMount } from "vue";
import { api } from "src/boot/axios";

import { useRouter } from "vue-router";

export default {
  setup() {
    const $router = useRouter();

    const userinfo = ref([]);
    const userRegistered = ref(false);

    function fetchUserData() {
      api.get("/api/user").then((r) => {
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

<style lang="sass" scoped>
.YL
  &__toolbar-input-container
    min-width: 100px
    width: 55%
  &__toolbar-input-btn
    border-radius: 0
    border-style: solid
    border-width: 1px 1px 1px 0
    border-color: rgba(0,0,0,.24)
    max-width: 60px
    width: 100%
</style>

<style scoped>
.mt-xl {
  margin-top: 59px;
}

#q-app > div > header {
  position: absolute;
}

#q-app > div > footer {
  position: absolute;
}
</style>
