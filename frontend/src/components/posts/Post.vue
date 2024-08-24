<template>
<div class="post">
    <div class="postHeader">
        <div class="posterDetails">
            <ProfileImage :imgURL="postData.profile_image"/>
            <h3>{{ FullName }}</h3>
        </div>
        <div class="postActions">
            <appCTA :to="'/ShowPost/' + postData.id"><i class="fa-solid fa-eye"></i></appCTA>
            <appCTA :to="'/EditPost/' + postData.id"><i class="fa-solid fa-pen-to-square"></i></appCTA>
            <appCTA to="" @click="deletePost(postData.id)"><i class="fa-solid fa-trash"></i></appCTA>
        </div>
    </div>
    <div class="postContent">
        <p>{{ postData.postContent }}</p>
    </div>
</div>

</template>

<script>
import axios from 'axios';
import AppCTA from '@/components/common/AppCta.vue';
import ProfileImage from '../common/ProfileImage.vue';

export default {
    props : {
        postData : {},
    },
    components : {
        AppCTA,
        ProfileImage
    },
    computed : {
        FullName(){
            return `${this.postData.f_name} ${this.postData.l_name}`
        }
    },
    methods: {
        async deletePost(postID){
            const deleteConfirmation = confirm('are you sure want to delete it?')
            const token = localStorage.getItem('token');
            
            if(deleteConfirmation){
                try {
                    const response = await axios.delete(`http://127.0.0.1:8000/api/posts/delete/${postID}`, {
                        headers: {
                            'Authorization': `Bearer ${token}`,
                        },
                    });
                    this.$emit('fetchPosts')
                } catch (err) {
                    console.error(err);
                }
            }
        },

    },
}
</script>

<style scoped>
.post{
    flex: 1;
    min-width: 300px;
    padding: 10px;
    min-height: 300px;    
    background-color: #b097f7;
    border-radius: 15px;
    margin: 20px 0;
}
.post .postHeader{
    width: 100%;
    height: 50px;
    margin: 18px 0;
    padding: 20px;
    box-sizing: border-box;
    display: flex;
    align-items: center;
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

.postHeader .posterDetails{ 
    display: flex;
    align-items: center;
    gap: 10px;
}
.postHeader .posterDetails .profileImg{ 
    width: 50px;
    height: 50px;
}
</style>