<template>

  <!-- <div class="row justify-center items-center q-mt-md">
    <q-toolbar style="width: 80%">
      <q-toolbar-title class="q-pa-md">
        Current Lalaey
      </q-toolbar-title>
    </q-toolbar>
  </div>

  <div class="row justify-center items-center">
    <q-card style="width: 80%" flat bordered>
      <q-card-section horizontal>
        <q-card-section class="q-pt-xs">
          <div class="text-h6 q-mt-sm q-mb-xs">Lalaey Title</div>
          <div class="text-caption text-weight-regular text-grey">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit
          </div>
        </q-card-section>

        <q-card-section class="col-5 flex flex-center">
          <q-img class="rounded-borders" src="https://cdn.quasar.dev/img/parallax2.jpg" />
        </q-card-section>
      </q-card-section>
    </q-card>
  </div> -->

  <div class="row justify-center items-center q-my-md">
    <div>
      <q-btn v-if="checkIfPlayed == false" flat round icon="play_circle" @Click="checkIfPlayed" />
      <q-btn v-else flat round icon="pause" @Click="checkIfPlayed" />
      <q-btn flat round icon="skip_next" @click="nextTrack" />
    </div>
    <!-- <q-slider class="full-width q-px-lg" style="bottom: 8px" v-model="slider" @change="setTime" color="accent" label
      track-size="5px" track-color="white" reverse /> -->
    <div> Current Time: <span id="current_time"></span></div>
    <div>Duration: <span id="current_duration"></span></div>
  </div>

  <audio id="audio" class="video-js" width="250px" height="150px">
    <source :src='currentTrack' type='audio/mp3' />
  </audio>

</template>

<script>
import videojs from 'video.js';
import { onMounted, reactive, ref, toRefs } from 'vue';

import 'video.js/dist/video-js.min.css'

export default {
  setup() {
    const slider = ref(0)
    const currentTrackIndex = ref(0)
    const currentTrack = ref(null)

    const props = reactive({
      player: null,
      playerPlaying: false,
      currentplayerDuration: 0,
      playerCurrentTime: 0,
      playerOldTime: 0,
      options: {
        responsive: true,
        controlBar: {
          playToggle: false,
          captionsButton: false,
          chaptersButton: false,
          subtitlesButton: false,
          remainingTimeDisplay: false,
          muted: false,
          progressControl: {
            seekBar: false
          },
          fullscreenToggle: false,
          playbackRateMenuButton: false,
        }
      }
    })

    onMounted(() => {
      props.player = videojs('audio', props.options, () => {
        console.log("Player Is Ready");
      })

      var myPlayer = videojs('audio');

      setInterval(function () {
        var whereYouAt = myPlayer.currentTime();
        var minutes = Math.floor(whereYouAt / 60);
        var seconds = Math.floor(whereYouAt - minutes * 60)
        var x = minutes < 10 ? "0" + minutes : minutes;
        var y = seconds < 10 ? "0" + seconds : seconds;

        document.getElementById("current_time").innerHTML = x + ":" + y;
      });

      setInterval(function () {
        var whereYouAt = myPlayer.duration();
        var minutes = Math.floor(whereYouAt / 60);
        var seconds = Math.floor(whereYouAt - minutes * 60)
        var x = minutes < 10 ? "0" + minutes : minutes;
        var y = seconds < 10 ? "0" + seconds : seconds;

        document.getElementById("current_duration").innerHTML = x + ":" + y;
      });
    })

    function prevTrack() {
      if (currentTrackIndex.value > 0) {
        currentTrackIndex.value--;
      } else {
        currentTrackIndex.value = tracks.length - 1;
      }
      currentTrack = tracks[currentTrackIndex.value];
      load()
    }

    function nextTrack() {
      if (currentTrackIndex.value < tracks.length - 1) {
        currentTrackIndex.value++;
      } else {
        currentTrackIndex = 0;
      }
      currentTrack = tracks[currentTrackIndex];
      load();
    }

    function loadplayer(name) {
      if (props.player) {
        props.player.pause()
        props.playerCurrentTime = 0
        props.playerDuration = 0
        props.playerPlaying = false
        slider.value = 0
        props.playerOldTime = 0
      } else {
        props.player = document.getElementById('audio')
      }
      props.player.src = '../src/assets/audio/Let_Me_Down_Slowly.mp3'
      props.player.onended = function () {
        props.player.pause()
        props.playerPlaying = false
        slider.value = 0
        props.player.currentTime = 0
        props.playerOldTime = 0
        props.playerCurrentTime = 0
      }
      props.player.addEventListener('timeupdate', () => {
        if (props.player.currentTime - props.playerOldTime > 1) {
          props.playerOldTime = props.player.currentTime
          slider.value =
            props.player.currentTime / props.player.duration
        }
      })
    }

    function current() {
      var whereYouAt = props.player.currentTime();
      props.playerCurrentTime = fmtTime(whereYouAt);
    };

    function duration() {
      var whereYouAt = props.player.duration();
      props.currentplayerDuration = fmtTime(whereYouAt);
    };

    function setTime(value) {
      props.playerPlaying = false
      props.player.pause()
      slider.value = value;
      var value = props.player.currentTime / props.player.duration
      props.player.play()
      props.playerPlaying = true
    }

    function checkIfPlayed() {
      if (props.playerPlaying) {
        props.player.play()
        props.playerPlaying = false;
      } else {
        props.player.pause()
        props.playerPlaying = true;
      }
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

    return {
      slider,
      tracks,
      current,
      setTime,
      fmtTime,
      duration,
      prevTrack,
      nextTrack,
      loadplayer,
      currentTrack,
      checkIfPlayed,
      currentTrackIndex,
      ...toRefs(props),
    };
  },
};
</script>

<style>
.video-js,
.vjs-paused,
.audio-dimensions,
.vjs-controls-disabled,
.vjs-audio,
.vjs-touch-enabled,
.vjs-workinghover,
.vjs-v7,
.vjs-user-active,
.vjs-layout-x-small {
  display: none;
  visibility: hidden;
}
</style>
