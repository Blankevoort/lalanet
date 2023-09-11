<template>
  <q-page>
    <div class="top full-width text-center">
      <div class="row justify-center">
        <div class="SlideInFromTop" style="margin-top: 135px">
          <div class="pfp">
            <q-img class="" src="/Images/profile-image.png" />
          </div>
          <div
            class="username q-mt-sm text-center text-weight-bold"
            style="font-size: 18px"
          >
            نام کاربری
          </div>
        </div>
      </div>
    </div>

    <div class="space full-width">
      <q-separator color="grey-6" size="4px" class="q-mb-md" />

      <div class="font-14 text-weight-bold q-ml-md">داستان های شما</div>

      <q-dialog v-model="showStory">
        <q-card class="my-card bg-primary" flat bordered>
          <q-card-section class="col-5 flex flex-center">
            <q-avatar size="75px" color="indigo-4" class="r11">
              <q-icon color="white" name="menu_book" />
            </q-avatar>
          </q-card-section>

          <q-card-section horizontal>
            <q-card-section class="q-pt-xs">
              <div class="text-h6 q-mt-sm q-mb-xs">Title</div>
              <div class="text-caption text-grey">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua.
              </div>
            </q-card-section>
          </q-card-section>

          <q-separator />

          <q-card-actions>
            <q-btn flat color="cyan-6"> Reserve </q-btn>
          </q-card-actions>
        </q-card>
      </q-dialog>

      <q-list class="SlideInFromRight" @click="toggleShowStory()">
        <q-item clickable v-ripple>
          <q-item-section avatar>
            <q-avatar size="75px" color="indigo-4" class="r11">
              <q-icon color="white" name="menu_book" />
            </q-avatar>
          </q-item-section>

          <q-item-section>
            <q-item-label>The Happy Boy</q-item-label>
            <q-item-label caption lines="1">Author: Username</q-item-label>
          </q-item-section>
        </q-item>
      </q-list>

      <q-list class="SlideInFromRight" @click="toggleShowStory()">
        <q-item clickable v-ripple>
          <q-item-section avatar>
            <q-avatar size="75px" color="indigo-4" class="r11">
              <q-icon color="white" name="menu_book" />
            </q-avatar>
          </q-item-section>

          <q-item-section>
            <q-item-label>The Happy Boy</q-item-label>
            <q-item-label caption lines="1">Author: Username</q-item-label>
          </q-item-section>
        </q-item>
      </q-list>

      <q-separator color="grey-6" size="4px" class="q-my-md" />

      <div class="font-14 text-weight-bold q-ml-md">لالایی های شما</div>

      <q-dialog v-model="showLalaey">
        <q-card class="my-card bg-primary" flat bordered>
          <q-card-section class="col-5 flex flex-center">
            <q-avatar size="75px" color="indigo-4" class="r11">
              <q-icon color="white" name="star" />
            </q-avatar>
          </q-card-section>

          <q-card-section horizontal>
            <q-card-section class="q-pt-xs">
              <div class="text-h6 q-mt-sm q-mb-xs">Title</div>
              <div class="text-caption text-grey">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua.
              </div>
            </q-card-section>
          </q-card-section>

          <q-separator />

          <q-card-actions>
            <q-btn flat color="cyan-6"> Reserve </q-btn>
          </q-card-actions>
        </q-card>
      </q-dialog>

      <div class="full-width q-pt-md">
        <q-list class="SlideInFromRight" @click="toggleShowLalaey()">
          <q-item clickable v-ripple>
            <q-item-section avatar>
              <q-avatar size="75px" color="indigo-4" class="r11">
                <q-icon color="white" name="star" />
              </q-avatar>
            </q-item-section>

            <q-item-section>
              <q-item-label>The Happy Boy</q-item-label>
              <q-item-label caption lines="1">Category: TK</q-item-label>
            </q-item-section>
          </q-item>
        </q-list>
      </div>
    </div>
  </q-page>
</template>

<script>
import { ref, onMounted, onBeforeMount, computed } from "vue";
import { api } from "src/boot/axios";

import { currentStory } from "stores/theStory";
import { storeToRefs } from "pinia";
export default {
  setup() {
    const store = currentStory();
    const theStory = computed(() => store.theStory);
    const setCurrentStory = (data) => store.setCurrentStory(data);
    const showCurrentStory = computed(() => store.showCurrentStory);
    const stories = ref([]);
    const storeStory = currentStory();
    const current = computed(() => storeStory.theStory);
    const show = ref(false);
    const userinfo = ref([]);
    const userRegistered = ref(false);
    const profile = ref(false);
    const userName = ref();
    const showLalaey = ref(false);
    const showStory = ref(false);

    function fetchUserStoris() {
      api.get("api/userStories").then((r) => {
        stories.value = r.data;
      });
    }

    function fetchUserData() {
      api.get("api/user").then((r) => {
        userinfo.value = r.data;
        userRegistered.value = true;
      });
    }

    function Profile() {
      api
        .post("api/profile", {
          userName: userName.value,
        })
        .then((r) => {
          if (r.data != null) {
            location.reload();
          }
        })
        .catch((err) => {
          error.value = err;
        });
    }

    function toggleShowLalaey() {
      if (showLalaey.value === false) {
        showLalaey.value = true;
      } else {
        showLalaey.value = false;
      }
    }

    function toggleShowStory() {
      if (showStory.value === false) {
        showStory.value = true;
      } else {
        showStory.value = false;
      }
    }

    onMounted(() => {
      fetchUserStoris();
    });

    onBeforeMount(() => {
      fetchUserData();
    });

    return {
      show,
      userinfo,
      userRegistered,
      stories,
      current,
      setCurrentStory,
      toggleShowLalaey,
      toggleShowStory,
      profile,
      Profile,
      userName,
      showLalaey,
      showStory,
    };
  },
};
</script>

<style scoped>
.r11 {
  border-radius: 11px;
}

.top {
  height: 200px;

  background: #64dddd;
}

.pfp {
  position: relative;
  width: 125px;
  height: 125px;
  background: #bbecfe;
  border: 5px solid #ffffff;
  box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.25);
  border-radius: 50%;
}

.space {
  position: absolute;
  width: 340px;
  top: 352px;
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
  animation-duration: 2s;
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
