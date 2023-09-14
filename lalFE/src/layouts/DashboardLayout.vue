<template>
  <q-layout view="hHh lpR lFf">
    <q-page-container class="bg-primary">
      <router-view />
    </q-page-container>

    <q-footer reveal class="q-mt-xl absolute-bottom">
      <div
        indicator-color="transparent"
        active-color="deep-purple-3"
        class="bg-white text-grey-5 bg52 q-ma-md q-py-md flex justify-around"
      >
        <q-btn
          name="home"
          icon="home"
          style="font-size: 18px"
          no-caps
          flat
          to="/"
        />

        <q-btn
          name="stories_list"
          icon="graphic_eq"
          style="font-size: 18px"
          to="/all-lalaies"
          no-caps
          flat
        />

        <q-btn
          name="lalaies_list"
          icon="book"
          style="font-size: 18px"
          to="/all-stories"
          no-caps
          flat
          v-if="userRegistered"
        />

        <q-btn
          name="profile"
          icon="person"
          style="font-size: 18px"
          to="/dashboard"
          no-caps
          flat
          v-if="userRegistered"
        />
      </div>
    </q-footer>
  </q-layout>
</template>

<script>
import { ref, onBeforeMount } from "vue";
import { api } from "src/boot/axios";
import { useRouter } from "vue-router";

export default {
  setup() {
    const userinfo = ref([]);
    const userRegistered = ref(false);
    const leftDrawerOpen = ref(false);

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
      leftDrawerOpen,
      toggleLeftDrawer() {
        leftDrawerOpen.value = !leftDrawerOpen.value;
      },
    };
  },
};
</script>
