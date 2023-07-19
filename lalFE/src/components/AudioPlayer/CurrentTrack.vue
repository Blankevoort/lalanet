<template>
  <q-page>

    <q-card class="fixed-bottom full-width mb-73 text-black z-max">
      <q-linear-progress :value="0.6" color="pink" />

      <q-card-section class="row items-center no-wrap">
        <div>
          <div class="text-weight-bold">The Walker</div>
          <div class="text-grey">Fitz & The Tantrums</div>
        </div>

        <q-space />

        <q-btn flat round icon="play_arrow" />
        <q-btn flat round icon="pause" />
        <q-btn flat round icon="close" />
      </q-card-section>
    </q-card>

  </q-page>
</template>
