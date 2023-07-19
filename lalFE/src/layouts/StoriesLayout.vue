<template>
  <q-layout view="hHh lpR lFf">

    <q-header class="bg5 text-black q-pa-md">
      <div class="row justify-between">
        <q-avatar class="bg2">
          <img src="/Images/profile-image.png" class="absolute-center" alt="pfp">
        </q-avatar>

        <div class="font-16 text-weight-bold q-mt-sm">Stories</div>

        <q-btn flat>
          <q-icon name="arrow_back" />
        </q-btn>
      </div>
    </q-header>

    <q-drawer v-model="leftDrawerOpen" side="left" behavior="mobile" elevated>
      <!-- drawer content -->
    </q-drawer>

    <q-page-container class="bg-primary">
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { ref, computed, onBeforeMount } from "vue";
import { api } from 'src/boot/axios';
import { useRouter } from 'vue-router';

import { currentLalai } from 'stores/appData';
import { storeToRefs } from 'pinia';

export default {
  name: 'SecondaryLayout',
  setup() {
    const caris = ref([])
    const search = ref('')
    const userinfo = ref([])
    const router = useRouter();
    const store = currentLalai();
    const userRegistered = ref(false)
    const matchingLalaiNames = ref(false)
    const current = computed(() => store.current);
    const setCurrent = (data) => store.setCurrent(data);
    const showCurrent = computed(() => store.showCurrent);
    const auth = ref(true)
    const email = ref("")
    const username = ref("")
    const password = ref("")
    const toggle = ref(false)
    const leftDrawerOpen = ref(false)

    function fetchUserData() {
      api.get('api/user')
        .then(r => {
          userinfo.value = r.data;
          userRegistered.value = true
        })
    }

    function searchLalaey() {
      fetch('http://127.0.0.1:8000/api/lalaies/search?q=' + search.value)
        .then(res => res.json())
        .then(res => {
          caris.value = res;
          search.value = '';
          matchingLalaiNames.value = true;
        })
        .catch(err => {
          console.log(err);
        })
    }

    function logout() {
      api.post('/api/logout')
        .then(localStorage.removeItem('token'))
        .then(window.location.reload())
    }

    onBeforeMount(() => {
      fetchUserData()
    })

    function register() {
      api.post("api/register", {
        name: username.value,
        email: email.value,
      })
        .then(r => {
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
        .catch(err => {
          error.value = err;
        });
    }

    function toggleAuth() {
      if (auth.value === true) {
        auth.value = false
      } else {
        auth.value = true
      }
    }

    function toggleAuthForm() {
      if (toggle.value === true) {
        toggle.value = false
      } else {
        toggle.value = true
      }
    }

    function login() {
      api.post("api/login", {
        email: email.value,
        password: password.value,
      })
        .then(r => {
          if (r.data.data.token) {
            localStorage.setItem("token", r.data.data.token);
            toggle.value = false;
            location.reload();
          }
        })
        .catch(err => {
          error.value = err;
        })
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
        leftDrawerOpen.value = !leftDrawerOpen.value
      },
    }
  }
}
</script>

<style lang="sass">
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

<style>
.mt-xl {
  margin-top: 59px;
}

#q-app>div>header {
  position: absolute;
}

#q-app>div>footer {
  position: absolute;
}
</style>
