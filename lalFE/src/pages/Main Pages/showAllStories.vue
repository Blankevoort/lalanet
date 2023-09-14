<template>
  <q-page>
    <img class="my-img bg5 full-width" src="/Images/letters.png" />

    <q-dialog v-model="showStory">
      <q-card class="my-card bg-primary" flat bordered>
        <q-card-section class="col-5 flex flex-center">
          <q-avatar size="75px" color="indigo-4" class="r11">
            <q-icon color="white" name="menu_book" />
          </q-avatar>
        </q-card-section>

        <q-card-section horizontal>
          <q-card-section class="q-pt-xs">
            <div class="text-h6 q-mt-sm q-mb-xs">{{ current.name }}</div>
            <div class="text-caption text-grey">
              {{ current.story }}
            </div>
          </q-card-section>
        </q-card-section>

        <q-separator />

        <q-card-actions>
          <q-btn flat color="cyan-6"> Reserve </q-btn>
        </q-card-actions>
      </q-card>
    </q-dialog>

    <div class="full-width absolute-bottom pageBttom q-pt-md">
      <q-list class="bg-primary SlideInFromRight">
        <q-item
          v-for="story in stories"
          :key="story.id"
          clickable
          v-ripple
          @click="
            setCurrentStory(story);
            toggleShowStory();
          "
        >
          <q-item-section avatar v-if="story.isVerified">
            <q-avatar size="75px" color="indigo-2" class="r11">
              <q-icon color="white" name="menu_book" />
            </q-avatar>
          </q-item-section>

          <q-item-section v-if="story.isVerified">
            <q-item-label>{{ story.name }}</q-item-label>
            <q-item-label caption lines="1"
              >Author: {{ story.user.name }}</q-item-label
            >
            <!-- <q-item-label caption lines="1">Aurhor: Username</q-item-label> -->
          </q-item-section>
        </q-item>
      </q-list>
    </div>
  </q-page>
</template>

<script>
import { ref, onBeforeMount, computed } from "vue";
import { api } from "src/boot/axios";

import { currentStory } from "stores/theStory";
import { storeToRefs } from "pinia";
export default {
  setup() {
    const store = currentStory();
    const theStory = computed(() => store.theStory);
    const setCurrentStory = (data) => store.setCurrentStory(data);
    const showCurrentStory = computed(() => store.showCurrentStory);
    const storeStory = currentStory();
    const current = computed(() => storeStory.theStory);
    const show = ref(false);
    const showStory = ref(false);

    const stories = ref([]);

    function fetchStoris() {
      api.get("/api/stories").then((r) => {
        stories.value = r.data;
      });
    }

    onBeforeMount(() => {
      fetchStoris();
    });

    function toggleShowStory() {
      if (showStory.value === false) {
        showStory.value = true;
      } else {
        showStory.value = false;
      }
    }

    return {
      show,
      stories,
      current,
      setCurrentStory,
      toggleShowStory,
      showStory,
    };
  },
};
</script>

<style scoped>
.r11 {
  border-radius: 11px;
}

.my-img {
  position: absolute;
  height: 387px;
  left: 0px;
}

.pageBttom {
  position: absolute;
  height: 452px;

  background: #f0f4f9;
  border-top-left-radius: 35px;
  border-top-right-radius: 35px;
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
</style>
