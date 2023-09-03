<template>
  <q-page>
    <img class="my-img bg5 full-width" src="/Images/letters.png" />

    <div class="full-width absolute-bottom pageBttom q-pt-md">
      <q-list class="bg-primary">
        <q-item clickable v-ripple>
          <q-item-section avatar>
            <q-avatar size="75px" color="indigo-2" class="r11">
              <q-icon color="white" name="menu_book" />
            </q-avatar>
          </q-item-section>

          <q-item-section>
            <q-item-label>The Happy Boy</q-item-label>
            <q-item-label caption lines="1">Aurhor: Username</q-item-label>
          </q-item-section>
        </q-item>
      </q-list>

      <q-list class="bg-primary">
        <q-item clickable v-ripple>
          <q-item-section avatar>
            <q-avatar size="75px" color="indigo-2" class="r11">
              <q-icon color="white" name="menu_book" />
            </q-avatar>
          </q-item-section>

          <q-item-section>
            <q-item-label>The Happy Boy</q-item-label>
            <q-item-label caption lines="1">Aurhor: Username</q-item-label>
          </q-item-section>
        </q-item>
      </q-list>

      <q-list class="bg-primary">
        <q-item clickable v-ripple>
          <q-item-section avatar>
            <q-avatar size="75px" color="indigo-2" class="r11">
              <q-icon color="white" name="menu_book" />
            </q-avatar>
          </q-item-section>

          <q-item-section>
            <q-item-label>The Happy Boy</q-item-label>
            <q-item-label caption lines="1">Aurhor: Username</q-item-label>
          </q-item-section>
        </q-item>
      </q-list>

      <q-list class="bg-primary">
        <q-item clickable v-ripple>
          <q-item-section avatar>
            <q-avatar size="75px" color="indigo-2" class="r11">
              <q-icon color="white" name="menu_book" />
            </q-avatar>
          </q-item-section>

          <q-item-section>
            <q-item-label>The Happy Boy</q-item-label>
            <q-item-label caption lines="1">Aurhor: Username</q-item-label>
          </q-item-section>
        </q-item>
      </q-list>

      <q-list class="bg-primary">
        <q-item clickable v-ripple>
          <q-item-section avatar>
            <q-avatar size="75px" color="indigo-2" class="r11">
              <q-icon color="white" name="menu_book" />
            </q-avatar>
          </q-item-section>

          <q-item-section>
            <q-item-label>The Happy Boy</q-item-label>
            <q-item-label caption lines="1">Aurhor: Username</q-item-label>
          </q-item-section>
        </q-item>
      </q-list>
    </div>
  </q-page>
</template>

<script>
import { ref, onMounted, computed } from "vue";
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

    function fetchStoris() {
      api.get("api/stories").then((r) => {
        stories.value = r.data;
      });
    }

    onMounted(() => {
      fetchStoris();
    });

    return {
      show,
      stories,
      current,
      setCurrentStory,
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
</style>
