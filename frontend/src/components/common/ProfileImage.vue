<template>
  <div class="profileImg">
    <img v-if="profileImg" :src="profileImg" alt="profile image"/>
  </div>
</template>

<script>
export default {
    props: {
        imgURL : '',
        displayedImg: ''
    },
    computed: {
        profileImg(){
            return this.displayedImg || `http://127.0.0.1:8000/profileImages/${this.imgURL || 'default.jpg'}` 
        }
    }
}
</script>

<style scoped>
    .profileImg {
        width: 100px;
        height: 100px;
        border-radius: 999px;
        border: 1px solid #454545;
    }
    .profileImg img{
        width: 100%;
        height: 100%;        
        object-fit: cover;
        border-radius: 999px;
    }
</style>