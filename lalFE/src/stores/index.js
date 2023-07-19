import { store } from "quasar/wrappers";
import { createPinia } from "pinia";

export default store((/* { ssrContext } */) => {
  const pinia = createPinia();

  // You can add Pinia plugins here
  // pinia.use(SomePiniaPlugin)

  pinia.use((context) => {
    const storeId = context.store.$id;

    const serilizer = {
      serialize: JSON.stringify,
      deserialize: JSON.parse,
    };

    const storage = serilizer.deserialize(window.localStorage.getItem(storeId));

    if (storage) {
      context.store.$patch(storage);
    }

    context.store.$subscribe((mutation, state) => {
      window.localStorage.setItem(storeId, serilizer.serialize(state));
    });
  });

  return pinia;
});
