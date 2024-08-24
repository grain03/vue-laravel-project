<template>
  <div class="suggestedPosts">
    <div class="header">
        <h1>{{ totalPosts }} New Posts</h1>
        <AppCTA :to="'/AddPost'">+ Add new post</AppCTA>
    </div>
    <div class="posts">
        <Post v-for="post in posts" :postData="post" :key="post.id" @fetchPosts="fetchPosts"/>
    </div>
  </div>
</template>

<script>
import AppCTA from '@/components/common/AppCta.vue';
import Post from '@/components/posts/Post.vue';
import axiosInstance from '@/services/axiosConfig';

export default {
    data() {
        return {
            posts : [],
            totalPosts: 0
        }
    },
    created() {
        this.fetchPosts()
    },
    components: {
        AppCTA,
        Post
    },
    methods: {
        async fetchPosts(){
            try {
                const response = await axiosInstance.get('/posts')
                this.posts = response.data.data                
                this.totalPosts = response.data.meta.total
            } catch (err) {
                console.log(err)
            }
        },
    },

}
</script>

<style scoped>

.suggestedPosts{
    width: 80%;
    margin: 50px auto;
}

.suggestedPosts .header {
    display: flex;
    justify-content: space-between;
    padding: 10px;
}

.suggestedPosts h1{
    font-size: 1.5em;
}
.suggestedPosts .posts{
    display: flex;
    flex-wrap: wrap;
    gap:10px;
}
</style>