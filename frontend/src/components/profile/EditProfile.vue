<template>
    <form class="form" @submit.prevent="handleForm">
        <div class="input">
            <label for="ProfileImage">
                <ProfileImage :displayedImg="displayedImg" :imgURL="imgURL"/>
            </label>
            <input id="ProfileImage" @change="onFileChange" type="file">
            <Error v-if="config.profileImgErrorMessage" :errorMessage="config.profileImgErrorMessage"/>
        </div>
        <div class="input">
            <label for="f_name">First name</label>
            <input id="f_name" v-model="formData.f_name" type="text">
            <Error v-if="config.f_nameErrorMessage" :errorMessage="config.f_nameErrorMessage"/>
        </div>
        <div class="input">
            <label for="l_name">Last name</label>
            <input id="l_name" v-model="formData.l_name" type="text">
            <Error v-if="config.l_nameErrorMessage" :errorMessage="config.l_nameErrorMessage"/>
        </div>
        <div class="input">
            <label for="Email">Email</label>
            <input id="Email" v-model="formData.email" type="text">
            <Error v-if="config.emailErrorMessage" :errorMessage="config.emailErrorMessage"/>
        </div>
        <AppButton :error="buttonConfig.buttonError" :success="buttonConfig.buttonSuccess" :loading="buttonConfig.buttonLoading" :disabled="buttonConfig.isDisabled" >{{ buttonConfig.buttonInnerText }}</AppButton>
    </form>
</template>
  
<script>
import axios from 'axios';
import Error from '@/components/common/Error.vue'
import Success from '@/components/common/Success.vue'
import Loading from '@/components/common/Loading.vue'
import AppButton from '@/components/common/AppButton.vue'
import axiosInstance from '@/services/axiosConfig';
import ProfileImage from '../common/ProfileImage.vue';

export default {

    components: {
        Error,
        Success,
        Loading,
        AppButton,
        ProfileImage
    },

    data() {
        return {
            imgURL: '',
            displayedImg: '',
            config: {
                successMessage : '',
                emailErrorMessage : '',
                profileImgErrorMessage : '',
                f_nameErrorMessage : '',
                l_nameErrorMessage : '',
            },
            buttonConfig: {
                isDisabled: false,
                buttonLoading: false,
                buttonSuccess: false,
                buttonError: false,
                buttonInnerText: 'Edit'      
            },
            formData: {
                email : '',
                f_name : '',
                l_name : '',
                profile_image : null
            }
        }
    },

    created() {
        this.getFormData()
    },

    methods: {
        
        async getFormData(){
            try {
                const res = await axiosInstance.get('/profile', {
                    headers: {
                        'auth': true
                    }
                })        
                this.imgURL = res.data.data.profile_image;
                this.formData.email = res.data.data.email;
                this.formData.f_name = res.data.data.f_name;
                this.formData.l_name = res.data.data.l_name;
            } catch (err) {
                console.log(res);
            }
        },

        onFileChange(e){
            this.formData.profile_image = e.target.files[0];
            this.displayedImg = URL.createObjectURL(e.target.files[0])
        },

        async handleForm(){
            this.buttonConfig.isDisabled = true
            this.buttonConfig.buttonLoading = true
            try {
                const res = await axiosInstance.post('/profile/EditProfile', this.formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'auth': true
                    }
                })
                this.buttonConfig.buttonSuccess = true
                this.$router.push('/Profile');
            } catch (err) {
                this.buttonConfig.buttonLoading = false
                this.buttonConfig.isDisabled = false
                const { errors }  = err.response.data 
                this.config.emailErrorMessage = errors.email?.[0] || ''
                this.config.profileImgErrorMessage = errors.profile_image?.[0] || ''
                this.config.f_nameErrorMessage = errors.f_name?.[0] || ''
                this.config.l_nameErrorMessage = errors.l_name?.[0] || ''
            }
        }
    },
}
</script>

<style>
    form{
        width: 90%;
        margin: 30px auto;
        border-radius: 5px;
        background-color: #d6c8fb;
        padding: 10px;
        box-sizing: border-box;
    }

    form .input{
        width: 100%;
        display: grid;
        gap: 10px;
        margin: 10px auto;
    }
    form .input input{
        width: 100%;
        box-sizing: border-box;
        padding: 10px;
        border-radius: 5px;
        border: none;
    }

    form .input label[for = 'ProfileImage'] {
        width: 100%;
        height: 100px;
        position: relative;
        display: flex;
        justify-content: center;
        cursor: pointer;
    }

    .form .input #ProfileImage{
        visibility: hidden;
        position: absolute;
    }
</style>