<template>
  <form class="form" @submit.prevent="handleForm">
    <div class="input">
        <label for="f_name">First Name</label>
        <input id="f_name" v-model="formData.f_name" type="text">
        <Error v-if="config.f_nameErrorMessage" :errorMessage="config.f_nameErrorMessage"/>
    </div>
    <div class="input">
        <label for="l_name">Last Name</label>
        <input id="l_name" v-model="formData.l_name" type="text">
        <Error v-if="config.l_nameErrorMessage" :errorMessage="config.l_nameErrorMessage"/>
    </div>
    <div class="input">
        <label for="Email">Email</label>
        <input id="Email" v-model="formData.email" type="text">
        <Error v-if="config.emailErrorMessage" :errorMessage="config.emailErrorMessage"/>
    </div>
    <div class="input">
        <label for="Password">Password</label>
        <input id="Password" v-model="formData.password" type="password">
        <Error v-if="config.passwordErrorMessage" :errorMessage="config.passwordErrorMessage"/>
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

export default {
components: {
    Error,
    Success,
    Loading,
    AppButton
},
data() {
    return {
        config: {
            successMessage : '',
            emailErrorMessage : '',
            passwordErrorMessage : '',
        },
        buttonConfig: {
            isDisabled: false,
            buttonLoading: false,
            buttonSuccess: false,
            buttonError: false,
            buttonInnerText: 'Sign Up'      
        },
        formData: {
            f_name : '',
            l_name : '',
            email : '',
            password : ''
        }
    }
},
methods: {
    async handleForm(){
        this.buttonConfig.isDisabled = true
        this.buttonConfig.buttonLoading = true
        try {
            const res = await axiosInstance.post('/auth/signup', this.formData)            
            localStorage.setItem('token', res.data.data.token);
            this.buttonConfig.buttonSuccess = true
            this.$router.push('/Profile');
        } catch (err) {
            this.buttonConfig.buttonLoading = false
            this.buttonConfig.isDisabled = false

            const { errors }  = err.response.data 
            this.config.f_name = errors.f_name?.[0] || ''
            this.config.l_name = errors.l_name?.[0] || ''
            this.config.emailErrorMessage = errors.email?.[0] || ''
            this.config.passwordErrorMessage = errors.password?.[0] || ''
            // console.log(err.response.data.errors);
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
</style>