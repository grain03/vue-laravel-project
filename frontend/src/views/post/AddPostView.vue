<template>
    <Navbar/>
    <div class="AddPost">
        <PostForm formType="Add"/>
    </div>
</template>

<script>
import Navbar from '@/components/layouts/Navbar.vue';
import PostForm from '@/components/posts/PostForm.vue';

export default {
    components: {
    Navbar,
    PostForm
  }
}
</script>