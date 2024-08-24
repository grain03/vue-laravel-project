<template>
  <Navbar/>
  <div class="home">
    <SuggestedPosts />
  </div>
</template>

<script>
import { defineComponent } from 'vue';
import Navbar from '@/components/layouts/Navbar.vue';
import SuggestedPosts from '@/components/posts/PostSuggestions.vue';

export default defineComponent({
  name: 'HomeView',
  components: {
    Navbar,
    SuggestedPosts,
  },
});
</script>
