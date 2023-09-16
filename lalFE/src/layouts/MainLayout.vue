<template>
  <q-layout view="hHh lpR lFf">
    <q-header
      v-if="userRegistered"
      class="bg-primary text-black q-pa-md absolute"
    >
      <q-toolbar>
        <q-btn flat round dense icon="menu" @click="toggleLeftDrawer" />
        <q-toolbar-title class="font-16 text-center">
          سلام <span class="text-weight-bold">{{ userinfo.name }}!</span>
        </q-toolbar-title>
        <q-avatar class="bg2" @click="$router.push('/dashboard')">
          <img
            src="/Images/profile-image.png"
            class="absolute-center"
            alt="pfp"
          />
        </q-avatar>
      </q-toolbar>
    </q-header>

    <q-header v-else class="bg-primary text-black q-pa-md absolute">
      <q-btn
        class="float-left"
        flat
        round
        dense
        icon="menu"
        @click="toggleLeftDrawer"
      />

      <q-btn
        outline
        color="secondary"
        class="float-right"
        to="/login"
        label="ورود"
      />
    </q-header>

    <q-drawer
      class="text-center"
      v-model="leftDrawerOpen"
      side="left"
      behavior="mobile"
    >
      <q-list class="q-my-lg q-mx-sm" :horizontal-thumb-style="{ opacity: 0 }">
        <q-item to="/" class="q-my-sm" clickable v-ripple>
          <q-item-section avatar>
            <q-icon name="home" />
          </q-item-section>

          <q-item-section>صفحه اصلی</q-item-section>
        </q-item>
      </q-list>

      <q-list class="q-my-lg q-mx-sm" :horizontal-thumb-style="{ opacity: 0 }">
        <q-item to="/all-lalaies" class="q-my-sm" clickable v-ripple>
          <q-item-section avatar>
            <q-icon name="graphic_eq" />
          </q-item-section>

          <q-item-section>لالایی ها</q-item-section>
        </q-item>
      </q-list>

      <q-list
        class="q-my-lg q-mx-sm"
        v-if="userRegistered"
        :horizontal-thumb-style="{ opacity: 0 }"
      >
        <q-item to="/all-stories" class="q-my-sm" clickable v-ripple>
          <q-item-section avatar>
            <q-icon name="book" />
          </q-item-section>

          <q-item-section>داستان ها</q-item-section>
        </q-item>
      </q-list>

      <q-list
        class="q-my-lg q-mx-sm"
        v-if="userRegistered"
        :horizontal-thumb-style="{ opacity: 0 }"
      >
        <q-item to="/dashboard" class="q-my-sm" clickable v-ripple>
          <q-item-section avatar>
            <q-icon name="person" />
          </q-item-section>

          <q-item-section>پروفایل</q-item-section>
        </q-item>
      </q-list>

      <q-separator color="grey-4" inset size="4px" class="q-my-md" />

      <q-list
        class="q-my-lg q-mx-sm"
        v-if="userRegistered"
        :horizontal-thumb-style="{ opacity: 0 }"
      >
        <q-item to="/add-story" class="q-my-sm" clickable v-ripple>
          <q-item-section avatar>
            <q-icon name="add" />
          </q-item-section>

          <q-item-section>افزودن داستان</q-item-section>
        </q-item>
      </q-list>

      <div
        class="absolute-bottom q-ma-md flex justify-center content-center align-center"
      >
        <q-btn
          round
          unelevated
          color="red"
          icon="chevron_right"
          @click="toggleLeftDrawer"
        />
      </div>
    </q-drawer>

    <q-page-container class="bg-primary q-pa-md">
      <router-view />
    </q-page-container>

    <q-footer reveal class="q-mt-xl absolute">
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

<style scoped>
.q-item.q-router-link--active,
.q-item--active {
  color: black;
}
</style>
