<template>
    <Navbar/>
    <div class="EditPost">
        <PostForm :postID="postID" :postData="postData" formType="Edit"/>
    </div>
</template>

<script>
import axios from 'axios';

import Navbar from '@/components/layouts/Navbar.vue';
import PostForm from '@/components/posts/PostForm.vue';

export default {
    components: {
    Navbar,
    PostForm
  },
  data() { 
    return  {
        postData : {
            postContent : '',
            user_id : 1
        },
        postID: null
    }
  },
  created() {
    this.postID = this.$route.params.id,
    this.fetchPostData(this.postID)
  },
  methods: {
    async fetchPostData(id) {
        try {
            const response = await axios.get(`http://127.0.0.1:8000/api/posts/show/${id}`)
            this.postData = {...response.data}
        } catch (err) {
            console.log(err)
        }
    },
  },

}
</script>