<template>
  <q-page padding class="row justify-center">
    <q-card flat bordered class="r-25 col-xs-12 col-sm-12 col-md-7 col-lg-6 col-xl-5">
      <q-card-section>
        <div class="text-h6 text-center">آپلود داستان</div>
      </q-card-section>
      <q-separator inset color="grey-8" />
      <q-card-section class="q-gutter-y-md">
        <q-input v-model="Name" label="نام داستان:" :rules="[val => !!val || 'نام داستان اجباری است']" />
        <div>داستان:</div>
        <q-input v-model="Story" autogrow :error="!isValid" />
      </q-card-section>
      <q-card-actions align="around">
        <q-btn class="full-width" color="positive" label="Upload" @click="Upload" />
      </q-card-actions>
    </q-card>
  </q-page>
</template>

<script>
import { ref, computed } from "vue";
import { api } from 'src/boot/axios';
import { useQuasar } from 'quasar'
import { useRouter } from 'vue-router'

export default {
  setup() {
    const $q = useQuasar();
    const router = useRouter();
    const Name = ref("");
    const Story = ref("");
    const isValid = ref(computed(() => Story.value.length <= 5000))

    function Upload() {
      api.post("/api/stories", {
        name: Name.value,
        story: Story.value,
      })
        .then(r => {
          if (r.data != null) {
            router.push({ path: '/' })
            $q.notify({
              message: "داستان شما فرستاده شد و در دست تایید است.",
              color: "info",
            });
          } else {
            $q.notify({
              message: "مشکلی پیش آمده است",
              color: "negative",
            });
          }
        });
    }

    return {
      Name,
      Story,
      Upload,
      isValid,
    }
  },
};
</script>
