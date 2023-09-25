<template>
  <q-page>
    <audio controls preload="auto" class="video-js">
      <source
        src="http://127.0.0.1:8000/storage/Lalaeys/1694683122-%D9%84%D8%A7%D9%84%D8%A7%DB%8C%DB%8C%20%D8%AA%D8%B1%DA%A9%D9%85%D9%86%DB%8C.mp3"
        type="video/mp4"
      />

      <q-slider v-model="currentTime" :min="0" :max="duration" @input="seekTo" />
    </audio>
  </q-page>
</template>

<script>
import { ref, computed, reactive, toRefs, onMounted } from "vue";
import "video.js/dist/video-js.min.css";

export default {
  setup() {
    const player = ref();
    const videoPlayer = ref(document.getElementById("videoPlayer"));
    const videoSource = ref("../../../public/video.mp4");
    const duration = ref();
    const currentTime = ref();

    function loadPlayer() {
      player = videojs(audioPlayer.value, {}, function () {});
      player.on('loadedmetadata', () => {
        duration.value = player.duration();
      });
    }

    function seekTo() {
      player.currentTime(currentTime.value);
    }

    onMounted(() => {
      loadPlayer;
    });

    return {
      player,
      loadPlayer,
      videoSource,
      videoPlayer,
      duration,
      currentTime,
    };
  },
};
</script>
