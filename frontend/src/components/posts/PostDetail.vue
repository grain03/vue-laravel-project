<template>
  <div class="postDetail">
    <div class="post">
        <div class="postHeader">
            <h3>{{ postData.postOwner }}</h3>
            <div class="postActions">
                <appCTA :to="'/EditPost/' + postData.postID"><i class="fa-solid fa-pen-to-square"></i></appCTA>
                <appCTA to="" @click="deletePost(postData.postID)"><i class="fa-solid fa-trash"></i></appCTA>
            </div>
        </div>
        <div class="postContent">
            <p>{{ postData.postContent }}</p>
        </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import AppCTA from '@/components/common/AppCta.vue';

export default {
    data() {
    return {
        postData : {
            postID : null,
            postContent : '',
            postOwner : '',
        }
    }
},
components : {
    AppCTA
},
created(){
    this.postData.postID = this.$route.params.id
    this.fetchPostData(this.postData.postID)
},
methods: {
    token(){
        const token = localStorage.getItem('token');
        return token
    },
    async fetchPostData(postID) {
        try {
            const res = await axios.get(`http://127.0.0.1:8000/api/posts/show/${postID}`, {
                headers: {
                    'Authorization': `Bearer ${this.token()}`,
                },
            });            
            this.postData.postContent = res.data.data.postContent
            this.postData.postOwner = res.data.data.f_name + ' ' + res.data.data.l_name
        } catch (err) {
            console.error(err);
        }
    },
    async deletePost(postID){
        const deleteConfirmation = confirm('are you sure want to delete it?')
        if(deleteConfirmation){
            try {
                const response = await axios.delete(`http://127.0.0.1:8000/api/posts/delete/${postID}`, {
                    headers: {
                        'Authorization': `Bearer ${this.token()}`,
                    },
                });
                this.$router.push('/')
            } catch (err) {
                console.log(err)
            }
        }
    },
},

}
</script>

<style scoped>
.post{
    width: 100%;
    padding: 10px;
    min-height: 300px;    
    background-color: #b097f7;
    margin: 20px 0;
}
.post .postHeader{
    width: 100%;
    height: 50px;
    padding: 20px;
    box-sizing: border-box;
    display: flex;
    justify-content: space-between;
}
.post .postHeader h3{
    color: #48308a;
}
.post .postHeader .postActions{
    display: flex;
    gap: 5px;
}
.post .postHeader .postActions .d-btn{
    border-radius: 999px;
    width: 10px;
    height: 10px;
    padding: 10px;
}
.post .postContent{
    display: flex;
    align-items: center;
    justify-content: center;
    height: calc(100% - 70px);
}

.post .postContent p{
    color: #48308a;
}
</style>