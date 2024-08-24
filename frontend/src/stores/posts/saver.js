import { defineStore } from 'pinia';

export const useSavePostStore = defineStore('saver', {
  state: () => ({
    saved: false
  }),
  actions: {
    savePost() {
      setTimeout(() => {
        this.saved = !this.saved;
      },1000)
    }
  }
});