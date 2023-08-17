<template>
  <q-page>
    <img class="my-img bg4" src="/Images/introduction.png">

    <div class="full-width absolute-bottom pageBttom q-pt-md">

      <q-list class="bg-primary">
        <q-item clickable v-ripple>
          <q-item-section avatar>
            <q-avatar size="75px" color="indigo-2" class="r11">
              <q-icon color="white" name="star" />
            </q-avatar>
          </q-item-section>

          <q-item-section>
            <q-item-label>The Happy Boy</q-item-label>
            <q-item-label caption lines="1">Category: TK</q-item-label>
          </q-item-section>
        </q-item>
      </q-list>

      <q-list class="bg-primary">
        <q-item clickable v-ripple>
          <q-item-section avatar>
            <q-avatar size="75px" color="indigo-2" class="r11">
              <q-icon color="white" name="star" />
            </q-avatar>
          </q-item-section>

          <q-item-section>
            <q-item-label>The Happy Boy</q-item-label>
            <q-item-label caption lines="1">Category: TK</q-item-label>
          </q-item-section>
        </q-item>
      </q-list>

      <q-list class="bg-primary">
        <q-item clickable v-ripple>
          <q-item-section avatar>
            <q-avatar size="75px" color="indigo-2" class="r11">
              <q-icon color="white" name="star" />
            </q-avatar>
          </q-item-section>

          <q-item-section>
            <q-item-label>The Happy Boy</q-item-label>
            <q-item-label caption lines="1">Category: TK</q-item-label>
          </q-item-section>
        </q-item>
      </q-list>

      <q-list class="bg-primary">
        <q-item clickable v-ripple>
          <q-item-section avatar>
            <q-avatar size="75px" color="indigo-2" class="r11">
              <q-icon color="white" name="star" />
            </q-avatar>
          </q-item-section>

          <q-item-section>
            <q-item-label>The Happy Boy</q-item-label>
            <q-item-label caption lines="1">Category: TK</q-item-label>
          </q-item-section>
        </q-item>
      </q-list>

      <q-list class="bg-primary">
        <q-item clickable v-ripple>
          <q-item-section avatar>
            <q-avatar size="75px" color="indigo-2" class="r11">
              <q-icon color="white" name="star" />
            </q-avatar>
          </q-item-section>

          <q-item-section>
            <q-item-label>The Happy Boy</q-item-label>
            <q-item-label caption lines="1">Category: TK</q-item-label>
          </q-item-section>
        </q-item>
      </q-list>

      <q-list class="bg-primary">
        <q-item clickable v-ripple>
          <q-item-section avatar>
            <q-avatar size="75px" color="indigo-2" class="r11">
              <q-icon color="white" name="star" />
            </q-avatar>
          </q-item-section>

          <q-item-section>
            <q-item-label>The Happy Boy</q-item-label>
            <q-item-label caption lines="1">Category: TK</q-item-label>
          </q-item-section>
        </q-item>
      </q-list>

      <q-list class="bg-primary">
        <q-item clickable v-ripple>
          <q-item-section avatar>
            <q-avatar size="75px" color="indigo-2" class="r11">
              <q-icon color="white" name="star" />
            </q-avatar>
          </q-item-section>

          <q-item-section>
            <q-item-label>The Happy Boy</q-item-label>
            <q-item-label caption lines="1">Category: TK</q-item-label>
          </q-item-section>
        </q-item>
      </q-list>

      <q-list class="bg-primary">
        <q-item clickable v-ripple>
          <q-item-section avatar>
            <q-avatar size="75px" color="indigo-2" class="r11">
              <q-icon color="white" name="star" />
            </q-avatar>
          </q-item-section>

          <q-item-section>
            <q-item-label>The Happy Boy</q-item-label>
            <q-item-label caption lines="1">Category: TK</q-item-label>
          </q-item-section>
        </q-item>
      </q-list>

      <q-list class="bg-primary">
        <q-item clickable v-ripple>
          <q-item-section avatar>
            <q-avatar size="75px" color="indigo-2" class="r11">
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

  </q-page>
</template>

<script>
import { ref, onMounted, computed } from "vue";
import { api } from 'src/boot/axios';

import { currentLalai } from 'stores/appData';
import { storeToRefs } from 'pinia';
export default {
  setup() {
    const store = currentLalai();
    const current = computed(() => store.current);
    const setCurrent = (data) => store.setCurrent(data);
    const showCurrent = computed(() => store.showCurrent);
    const lalaies = ref([])
    function fetchLalaies() {
      api.get('http://127.0.0.1:8000/api/lalaies')
        .then(r => {
          lalaies.value = r.data
        })
    }

    onMounted(() => {
      fetchLalaies()
    })

    return {
      lalaies,
      setCurrent,
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
  width: 390px;
  height: 387px;
  left: 0px;
}

.pageBttom {
  position: absolute;
  height: 452px;

  background: #F0F4F9;
  border-top-left-radius: 35px;
  border-top-right-radius: 35px;
}
</style>
