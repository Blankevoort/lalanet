<template>
  <q-layout view="hHh lpR lFf">
    <q-header class="bg-primary text-black q-pa-md absolute">
      <q-toolbar>
        <q-btn flat round dense icon="menu" @click="toggleLeftDrawer" />
        <q-toolbar-title class="font-16 text-center">
          سلام <span class="text-weight-bold">آدام</span>
        </q-toolbar-title>
        <q-avatar class="bg2">
          <img
            src="/Images/profile-image.png"
            class="absolute-center"
            alt="pfp"
          />
        </q-avatar>
      </q-toolbar>
    </q-header>

    <q-drawer class="text-center" v-model="leftDrawerOpen" side="left" behavior="mobile">
      <q-list class="q-my-lg q-mx-sm" :horizontal-thumb-style="{ opacity: 0 }">
        <q-item to="/classes" class="q-my-sm" clickable v-ripple>
          <q-item-section avatar>
            <q-icon name="home" />
          </q-item-section>

          <q-item-section>صفحه اصلی</q-item-section>
        </q-item>
      </q-list>

      <q-list class="q-my-lg q-mx-sm" :horizontal-thumb-style="{ opacity: 0 }">
        <q-item to="/classes" class="q-my-sm" clickable v-ripple>
          <q-item-section avatar>
            <q-icon name="graphic_eq" />
          </q-item-section>

          <q-item-section>لالایی ها</q-item-section>
        </q-item>
      </q-list>

      <q-list class="q-my-lg q-mx-sm" :horizontal-thumb-style="{ opacity: 0 }">
        <q-item to="/classes" class="q-my-sm" clickable v-ripple>
          <q-item-section avatar>
            <q-icon name="book" />
          </q-item-section>

          <q-item-section>داستان ها</q-item-section>
        </q-item>
      </q-list>

      <q-list class="q-my-lg q-mx-sm" :horizontal-thumb-style="{ opacity: 0 }">
        <q-item to="/classes" class="q-my-sm" clickable v-ripple>
          <q-item-section avatar>
            <q-icon name="person" />
          </q-item-section>

          <q-item-section>پروفایل</q-item-section>
        </q-item>
      </q-list>

      <div
        class="absolute-bottom q-ma-md flex justify-center content-center align-center"
      >
        <q-btn
          round
          unelevated
          color="red"
          icon="chevron_left"
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
          name="lalaies_list"
          icon="graphic_eq"
          style="font-size: 18px"
          to="/all-stories"
          no-caps
          flat
        />

        <q-btn
          name="stories_list"
          icon="book"
          style="font-size: 18px"
          to="/all-lalaies"
          no-caps
          flat
        />

        <q-btn
          name="profile"
          icon="person"
          style="font-size: 18px"
          to="/dashboard"
          no-caps
          flat
        />
      </div>
    </q-footer>
  </q-layout>
</template>

<script>
import { ref } from "vue";

export default {
  setup() {
    const leftDrawerOpen = ref(false);

    return {
      leftDrawerOpen,
      toggleLeftDrawer() {
        leftDrawerOpen.value = !leftDrawerOpen.value;
      },
    };
  },
};
</script>

<!-- <script>
import { ref, computed, onBeforeMount } from "vue";
import { api } from "src/boot/axios";
import { useRouter } from "vue-router";

import { currentLalai } from "stores/appData";
import { storeToRefs } from "pinia";

export default {
  name: "MyLayout",
  setup() {
    const caris = ref([]);
    const search = ref("");
    const userinfo = ref([]);
    const router = useRouter();
    const store = currentLalai();
    const userRegistered = ref(false);
    const matchingLalaiNames = ref(false);
    const current = computed(() => store.current);
    const setCurrent = (data) => store.setCurrent(data);
    const showCurrent = computed(() => store.showCurrent);
    const auth = ref(true);
    const email = ref("");
    const username = ref("");
    const password = ref("");
    const toggle = ref(false);
    const leftDrawerOpen = ref(false);

    function fetchUserData() {
      api.get("api/user").then((r) => {
        userinfo.value = r.data;
        userRegistered.value = true;
      });
    }

    function searchLalaey() {
      fetch("http://127.0.0.1:8000/api/lalaies/search?q=" + search.value)
        .then((res) => res.json())
        .then((res) => {
          caris.value = res;
          search.value = "";
          matchingLalaiNames.value = true;
        })
        .catch((err) => {
          console.log(err);
        });
    }

    function logout() {
      api
        .post("/api/logout")
        .then(localStorage.removeItem("token"))
        .then(window.location.reload());
    }

    onBeforeMount(() => {
      fetchUserData();
    });

    function register() {
      api
        .post("api/register", {
          name: username.value,
          email: email.value,
        })
        .then((r) => {
          if (r.data.status == true) {
            toggle.value = false;
            $q.notify({
              message: "رمز به ایمیل شما فرستاده شد",
              color: "info",
            });
          } else {
            $q.notify({
              message: "چیزی اشتباه است.",
              color: "negative",
            });
          }
        })
        .catch((err) => {
          error.value = err;
        });
    }

    function toggleAuth() {
      if (auth.value === true) {
        auth.value = false;
      } else {
        auth.value = true;
      }
    }

    function toggleAuthForm() {
      if (toggle.value === true) {
        toggle.value = false;
      } else {
        toggle.value = true;
      }
    }

    function login() {
      api
        .post("api/login", {
          email: email.value,
          password: password.value,
        })
        .then((r) => {
          if (r.data.data.token) {
            localStorage.setItem("token", r.data.data.token);
            toggle.value = false;
            location.reload();
          }
        })
        .catch((err) => {
          error.value = err;
        });
    }

    return {
      caris,
      search,
      logout,
      userinfo,
      setCurrent,
      searchLalaey,
      userRegistered,
      matchingLalaiNames,
      auth,
      email,
      login,
      username,
      password,
      register,
      toggleAuth,
      toggle,
      toggleAuthForm,
      leftDrawerOpen,
      toggleLeftDrawer() {
        leftDrawerOpen.value = !leftDrawerOpen.value;
      },
    };
  },
};
</script> -->
