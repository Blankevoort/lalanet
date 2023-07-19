<template>
  <q-page class="bg4 q-px-md">
    <img class="my-img" src="/Images/introduction.png">
    <q-img class="curveStyle q-pb-md" src="/Images/curve.png">
      <div class="bg-transparent mt75 text-black">
        <div class="font-16">Description</div>
        <div class="text-grey-5 q-py-sm">Lorem ipsum dolor sit amet consectetur. A amet tortor enim adipiscing sed sit
          nisl donec
          tellus. Massa
          tincidunt pharetra orci integer aenean ac nunc. Sit neque platea aenean in quis proin donec quis lacus quis
          proin donec quis lacus quis lacus proin donec quis lacus quis lacus proin donec quis </div>
        <div class="font-16">Introduction - 1/5</div>
        <div class="text-grey-5 q-py-sm">
          <div><span class="q-mr-sm">00:00</span><span class="rectangle1"></span><span class="q-ml-md">Introduction about
              Chapter</span></div>
          <div><span class="q-mr-sm">00:00</span><span class="rectangle2"></span><span class="q-ml-md">Introduction about
              Chapter</span></div>
          <div><span class="q-mr-sm">00:00</span><span class="rectangle3"></span><span class="q-ml-md">Introduction about
              Chapter</span></div>
        </div>
      </div>
    </q-img>
    <div class="player">
      <div class="row justify-between q-mx-xl q-mt-md">
        <q-btn class="btn1" round color="blue-grey-9" icon="arrow_forward" />
        <q-btn class="btn3" round color="indigo-4" icon="play_arrow" />
        <q-btn class="btn2" round color="grey-5" icon="arrow_back" />
      </div>
      <q-slider class="slider" v-model="standard" color="orange-4" :min="0" :max="10" />
    </div>
  </q-page>
</template>

<script>
import { ref, computed, reactive, toRefs, onMounted } from 'vue'
import { currentLalai } from 'stores/appData';

export default {
  setup() {
    const storeLalai = currentLalai()
    const current = computed(() => storeLalai.current);
    const slider = ref(0)
    const state = reactive({
      currentPod: null,
      podPlayed: false,
      podCurrentTime: 0,
      currentPodDuration: 0,
      podCurrentTimeDisplay: '00:00',
      podOldTime: 0,
      podDurationDisplay: '00:00'
    })
    function loadPod() {
      if (state.currentPod) {
        state.currentPod.pause()
        state.currentPod.currentTime = 0
        state.podCurrentTime = 0
        state.currentPodDuration = 0
        state.podCurrentTimeDisplay = '00:00'
        state.podPlayed = false
        slider.value = 0
        state.podOldTime = 0
      } else {
        state.currentPod = document.querySelector('audio.podcast')
      }
      state.currentPod.src = 'http://127.0.0.1:8000/storage/Lalaeys/' + current.value.Audio_Path
      state.currentPod.onended = function () {
        state.currentPod.pause()
        state.podPlayed = false
        slider.value = 0
        state.currentPod.currentTime = 0
        state.podOldTime = 0
        state.podCurrentTime = 0
        state.podCurrentTimeDisplay = '00:00'
      }
      state.currentPod.onloadedmetadata = function () {
        state.podDurationDisplay = fmtTime(state.currentPod.duration)
      }
      state.currentPod.addEventListener('timeupdate', () => {
        if (state.currentPod.currentTime - state.podOldTime > 1) {
          state.podOldTime = state.currentPod.currentTime
          slider.value =
            state.currentPod.currentTime / state.currentPod.duration
          state.podCurrentTimeDisplay = fmtTime(state.currentPod.currentTime)
        }
      })
    }
    function fmtTime(current) {
      var houres = Math.floor(current / 360)
      var minutes = Math.floor((current - houres * 60) / 60)
      var seconds = Math.floor(current - minutes * 60)
      var x = houres < 10 ? '0' + houres : houres
      var y = minutes < 10 ? '0' + minutes : minutes
      var z = seconds < 10 ? '0' + seconds : seconds
      if (x < 10) {
        return y + ':' + z
      } else {
        return x + ':' + y + ':' + z
      }
    }
    function setTime(value) {
      state.podPlayed = false
      state.currentPod.pause()
      slider.value = value
      var time = value * state.currentPod.duration
      state.currentPod.currentTime = time
      state.podOldTime = time
      state.podCurrentTimeDisplay = fmtTime(time)
      state.currentPod.play()
      state.podPlayed = true
    }
    function podPause(phase) {
      if (phase === 'start') {
        state.currentPod.pause()
        state.podPlayed = false
      } else {
        state.currentPod.play()
        state.podPlayed = true
      }
    }
    function podcastToggle() {
      if (state.currentPod.paused) {
        state.currentPod.play()
        state.podPlayed = true
      } else {
        state.currentPod.pause()
        state.podPlayed = false
      }
    }

    // onMounted(() => {
    //   loadPod()
    // })

    return {
      slider,
      setTime,
      current,
      podPause,
      alert: ref(false),
      podcastToggle,
      ...toRefs(state),
      standard: ref(0)
    }
  }
}
</script>

<style>
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
  background: #908C8C;
  border-radius: 50px;
}

.rectangle2 {
  position: absolute;
  width: 5px;
  height: 5px;
  top: 242px;
  background: #908C8C;
  border-radius: 50px;
}

.rectangle3 {
  position: absolute;
  width: 5px;
  height: 5px;
  top: 262px;
  background: #908C8C;
  border-radius: 50px;
}

.player {
  position: absolute;
  width: 390px;
  height: 130px;
  left: 0px;
  top: 680px;

  background: #E7ECF2;
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
  left: 152px;
}

.slider {
  width: 327px;
  height: 5px;
  left: 30px;
  top: 65px;
}
</style>
