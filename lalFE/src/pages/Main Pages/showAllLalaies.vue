<template>
  <q-page>
    <img class="my-img bg4 full-width" src="/Images/introduction.png" />

    <div class="full-width absolute-bottom pageBttom q-pt-md">
      <q-list class="bg-primary SlideInFromRight">
        <q-item
          v-for="lalaey in lalaies"
          :key="lalaey.id"
          clickable
          v-ripple
          :to="'/player/' + lalaey.id"
        >
          <q-item-section avatar>
            <q-avatar size="75px" color="indigo-2" class="r11">
              <q-icon color="white" name="star" />
            </q-avatar>
          </q-item-section>

          <q-item-section>
            <q-item-label>{{ lalaey.Name }}</q-item-label>
            <!-- <q-item-label caption lines="1">Category: TK</q-item-label> -->
          </q-item-section>
        </q-item>
      </q-list>
    </div>
  </q-page>
</template>

<script>
import { ref, onBeforeMount, computed } from "vue";
import { api } from "src/boot/axios";
import { useRouter } from "vue-router";

import { currentLalai } from "stores/appData";
import { storeToRefs } from "pinia";
export default {
  setup() {
    const store = currentLalai();
    const current = computed(() => store.current);
    const setCurrent = (data) => store.setCurrent(data);
    const showCurrent = computed(() => store.showCurrent);

    const lalaies = ref([]);

    function fetchLalaies() {
      api.get("/api/lalaies").then((r) => {
        lalaies.value = r.data;
      });
    }

    onBeforeMount(() => {
      fetchLalaies();
    });

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
  height: 387px;
  left: 0px;
}

.pageBttom {
  position: absolute;
  height: 450px;

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
