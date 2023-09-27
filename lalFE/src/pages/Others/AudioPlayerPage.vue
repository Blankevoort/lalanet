<template>
  <q-page class="bg4 q-px-md">
    <img class="my-img full-width" src="/Images/introduction.png" />
    <q-img class="curveStyle q-pb-md full-width" src="/Images/curve.png">
      <div class="bg-transparent mt75 text-black">
        <div class="font-16">توضیحات</div>
        <div class="text-grey-6 q-py-sm">
          {{ current.Description }}
        </div>

        <!-- <div class="font-16">Introduction - 1/5</div>
        <div class="text-grey-5 q-py-sm">
          <div>
            <span class="q-mr-sm">00:00</span><span class="rectangle1"></span
            ><span class="q-ml-md">Introduction about Chapter</span>
          </div>
          <div>
            <span class="q-mr-sm">00:00</span><span class="rectangle2"></span
            ><span class="q-ml-md">Introduction about Chapter</span>
          </div>
          <div>
            <span class="q-mr-sm">00:00</span><span class="rectangle3"></span
            ><span class="q-ml-md">Introduction about Chapter</span>
          </div>
        </div> -->
      </div>
    </q-img>
    <div class="player full-width row justify-center">
      <audio class="podcast col-12"></audio>
      <div class="col-12 row justify-center q-mx-xl q-mt-md">
        <!-- <q-btn class="btn1" round color="blue-grey-9" icon="arrow_forward" /> -->
        <q-btn
          class="btn3"
          round
          v-if="!podPlayed"
          color="indigo-4"
          icon="play_arrow"
          @click="podcastToggle()"
        />

        <q-btn
          class="btn3"
          round
          v-else
          color="indigo-4"
          icon="pause"
          @click="podcastToggle()"
        />
        <!-- <q-btn class="btn2" round color="grey-5" icon="arrow_back" /> -->
      </div>
      <div class="col-12 row justify-center content-center q-pl-md">
        <q-slider
          class="slider col-10"
          v-model="slider"
          @change="setTime"
          @pan="podPause"
          :min="0"
          :max="1"
          :step="0"
          color="orange-4"
        />
        <div class="col-2 text-center">{{ podCurrentTimeDisplay }}</div>
      </div>
    </div>
  </q-page>
</template>

<script>
import { ref, computed, reactive, toRefs, onMounted } from "vue";
import { currentLalai } from "stores/appData";

export default {
  setup() {
    const storeLalai = currentLalai();
    const current = computed(() => storeLalai.current);
    const slider = ref(0);
    const state = reactive({
      currentPod: null,
      podPlayed: false,
      podCurrentTime: 0,
      currentPodDuration: 0,
      podCurrentTimeDisplay: "00:00",
      podOldTime: 0,
      podDurationDisplay: "00:00",
    });

    function loadPod() {
      if (state.currentPod) {
        state.currentPod.pause();
        state.currentPod.currentTime = 0;
        state.podCurrentTime = 0;
        state.currentPodDuration = 0;
        state.podCurrentTimeDisplay = "00:00";
        state.podPlayed = false;
        slider.value = 0;
        state.podOldTime = 0;
      } else {
        state.currentPod = document.querySelector("audio.podcast");
      }

      state.currentPod.src =
        "http://127.0.0.1:8000/storage/Lalaeys/" + current.value.Audio_Path;
      state.currentPod.onended = function () {
        state.currentPod.pause();
        state.podPlayed = false;
        slider.value = 0;
        state.currentPod.currentTime = 0;
        state.podOldTime = 0;
        state.podCurrentTime = 0;
        state.podCurrentTimeDisplay = "00:00";
      };

      state.currentPod.onloadedmetadata = function () {
        state.podDurationDisplay = fmtTime(state.currentPod.duration);
      };

      state.currentPod.addEventListener("timeupdate", () => {
        if (state.currentPod.currentTime - state.podOldTime > 1) {
          state.podOldTime = state.currentPod.currentTime;
          slider.value =
            state.currentPod.currentTime / state.currentPod.duration;
          state.podCurrentTimeDisplay = fmtTime(state.currentPod.currentTime);
        }
      });
    }

    function fmtTime(current) {
      var houres = Math.floor(current / 360);
      var minutes = Math.floor((current - houres * 60) / 60);
      var seconds = Math.floor(current - minutes * 60);
      var x = houres < 10 ? "0" + houres : houres;
      var y = minutes < 10 ? "0" + minutes : minutes;
      var z = seconds < 10 ? "0" + seconds : seconds;
      if (x < 10) {
        return y + ":" + z;
      } else {
        return x + ":" + y + ":" + z;
      }
    }

    function setTime(value) {
      console.log(state.currentPod.duration);
      state.podPlayed = false;
      state.currentPod.pause();
      slider.value = value;
      var duration = state.currentPod.duration;
      var time = value * duration;
      console.log(time);
      console.log("Setting up 'canplay' event listener...");

      function onCanPlay() {
        console.log("Audio is playable/loaded!");

        state.currentPod.currentTime = time;
        console.log(state.currentPod.currentTime);
        state.podOldTime = time;
        state.podCurrentTimeDisplay = fmtTime(time);
        state.currentPod.play();
        state.podPlayed = true;

        state.currentPod.removeEventListener("canplay", onCanPlay);
      }

      console.log("Setting up 'canplay' event listener...");

      state.currentPod.addEventListener("canplay", onCanPlay);
    }

    function podPause(phase) {
      if (phase === "start") {
        state.currentPod.pause();
        state.podPlayed = false;
      } else {
        state.currentPod.play();
        state.podPlayed = true;
      }
    }

    function podcastToggle() {
      if (state.currentPod.paused) {
        state.currentPod.play();
        state.podPlayed = true;
      } else {
        state.currentPod.pause();
        state.podPlayed = false;
      }
    }

    onMounted(() => {
      loadPod();
    });

    return {
      slider,
      setTime,
      current,
      podPause,
      podcastToggle,
      ...toRefs(state),
      alert: ref(false),
    };
  },
};
</script>

<style scoped>
.my-img {
  position: absolute;
  width: 390px;
  height: 387px;
  left: 0px;
  top: 25px;
}

.curveStyle {
  position: absolute;
  width: 390px;
  height: 379px;
  left: 0px;
  top: 305px;
}

.mt75 {
  top: 75px;
}

.rectangle1 {
  position: absolute;
  width: 5px;
  height: 5px;
  top: 222px;
  background: #908c8c;
  border-radius: 50px;
}

.rectangle2 {
  position: absolute;
  width: 5px;
  height: 5px;
  top: 242px;
  background: #908c8c;
  border-radius: 50px;
}

.rectangle3 {
  position: absolute;
  width: 5px;
  height: 5px;
  top: 262px;
  background: #908c8c;
  border-radius: 50px;
}

.player {
  position: absolute;
  height: 130px;
  left: 0px;
  top: 650px;

  background: #e7ecf2;
  backdrop-filter: blur(5px);
}

.btn1 {
  position: absolute;
  width: 45px;
  height: 45px;
  left: 20px;
  top: 25px;
}

.btn2 {
  position: absolute;
  width: 45px;
  height: 45px;
  left: 310px;
  top: 25px;
}

.btn3 {
  position: absolute;
  width: 60px;
  height: 60px;
}

.slider {
  width: 80%;
  height: 5px;
}
</style>
