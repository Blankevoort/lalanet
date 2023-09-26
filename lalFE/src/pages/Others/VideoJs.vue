<template>
  <q-page class="row justify-center content-center">
    <audio
      ref="audioPlayer"
      controls
      preload="auto"
      class="video-js vjs-default-skin"
    >
      <source :src="audioSource" type="audio/mp3" />
    </audio>
    <q-slider
      style="width: 50%"
      v-model="currentTime"
      :min="0"
      :max="duration"
      @change="seekTo"
  /></q-page>
</template>

<script>
import { ref, onMounted } from "vue";
import "video.js/dist/video-js.min.css";
import videojs from "video.js";

export default {
  setup() {
    const audioPlayer = ref(null);
    const audioSource = ref(
      "http://127.0.0.1:8000/storage/Lalaeys/1694683122-%D9%84%D8%A7%D9%84%D8%A7%DB%8C%DB%8C%20%D8%AA%D8%B1%DA%A9%D9%85%D9%86%DB%8C.mp3"
    );
    const duration = ref(0);
    const currentTime = ref(0);

    function loadPlayer() {
      const player = audioPlayer.value;

      player.addEventListener("loadedmetadata", () => {
        duration.value = player.duration;
      });

      return player;
    }

    function seekTo() {
      const player = loadPlayer();
      console.log(player.currentTime);
      player.currentTime = currentTime.value;
    }

    onMounted(() => {
      loadPlayer();
    });

    return {
      audioPlayer,
      audioSource,
      duration,
      currentTime,
      seekTo,
    };
  },
};
</script>
