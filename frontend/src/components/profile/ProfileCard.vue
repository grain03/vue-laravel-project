<template>
  <div class="profileCard">
    <div class="profileCardHeader">
        <h2>Profile</h2>
        <div class="profileActions">
            <AppCta to="/EditProfile"><i class="fa-solid fa-pen"></i></AppCta>
            <LogoutButton/>
        </div>
    </div>
    <div class="profileCardContent">
        <ProfileImage :imgURL="profileImg"/>
        <h3>{{ fullName }}</h3>
        <span>{{ totalPosts }} posts</span>
    </div>
  </div>
</template>

<script>
import AppCta from '../common/AppCta.vue';
import axios from 'axios';
import ProfileImage from '../common/ProfileImage.vue';
import LogoutButton from '../auth/LogoutButton.vue';

export default {
components : {
    AppCta,
    ProfileImage,
    LogoutButton
},
data(){
    return {
        fName : '',
        lName : '',
        profileImg : null,
        totalPosts : null,
    }
},
created(){
    this.profileData()
},
computed : {
    fullName(){
        return `${this.fName} ${this.lName}`
    }
},
methods : {
    async profileData(){
        const token = localStorage.getItem('token');
        try {
            const res = await axios.get('http://127.0.0.1:8000/api/profile', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                },
            });
            this.fName = res.data.data.f_name
            this.lName = res.data.data.l_name
            this.profileImg = res.data.data.profile_image;
            this.totalPosts = res.data.meta.totalPosts
        } catch (err) {
            console.log(err)
        }
    }
}
}
</script>

<style scoped>
    .profileCard{
        width: 90%;
        min-height: 300px;
        margin: 30px auto;
        border-radius: 5px;
        background-color: #d6c8fb;
        padding: 10px;
        box-sizing: border-box;        
    }

    .profileCard .profileCardHeader {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px;
    }

    .profileCard .profileCardContent {
        gap: 20px;
        display: grid;
        justify-items: center;
    }

    .profileCard .profileCardHeader .profileActions{
        display: flex;
        gap: 10px;
    }

</style>