import { defineStore } from "pinia";

export const currentStory = defineStore("theStory", {
  state: () => ({
    theStory: [],
  }),

  getters: {
    showCurrentStory(state) {
      return state.theStory;
    },
  },

  actions: {
    setCurrentStory(data) {
      this.theStory = data;
    },
  },
});
