<template>
  <Navbar/>
  <div class="ShowPost">
    <PostDetail/>
  </div>
</template>

<script>
import Navbar from '@/components/layouts/Navbar.vue';
import PostDetail from '@/components/posts/PostDetail.vue'

export default {
  components: { 
    Navbar,
    PostDetail 
},
}

</script>

<style>

</style>