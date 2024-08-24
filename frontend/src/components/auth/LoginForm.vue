<template>
  <form class="form" @submit.prevent="handleForm">
    <TextInput :validation="emailValidation" v-model="formData.email" :errorMessage="config.emailErrorMessage" inputName="email" inputLabel="Email"/>
    <PasswordInput v-model="formData.password" :errorMessage="config.passwordErrorMessage" inputName="password" inputLabel="Password"/>
    <AppButton :error="buttonConfig.buttonError" :success="buttonConfig.buttonSuccess" :loading="buttonConfig.buttonLoading" :disabled="buttonConfig.isDisabled" >{{ buttonConfig.buttonInnerText }}</AppButton>
    <Error v-if="config.globalError" :errorMessage="config.globalError"/>
    <p>You dont have an account yet? <router-link to="/Signup">Sign up now!</router-link></p>
  </form>
</template>

<script>
import axios from 'axios';
import Error from '@/components/common/Error.vue'
import Success from '@/components/common/Success.vue'
import Loading from '@/components/common/Loading.vue'
import AppButton from '@/components/common/AppButton.vue'
import TextInput from '../common/inputs/TextInput.vue';
import PasswordInput from '../common/inputs/PasswordInput.vue';

export default {
components: {
    Error,
    Success,
    Loading,
    AppButton,
    TextInput,
    PasswordInput
},
data() {
    return {
        emailValidation : ['required', 'min:8', 'email', 'unique'],
        config: {
            successMessage : '',
            emailErrorMessage : '',
            passwordErrorMessage : '',
            globalError: ''
        },
        buttonConfig: {
            isDisabled: false,
            buttonLoading: false,
            buttonSuccess: false,
            buttonError: false,
            buttonInnerText: 'Login'      
        },
        formData: {
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
            const res = await axios.post('http://127.0.0.1:8000/api/auth/login', this.formData)
            localStorage.setItem('token', res.data.data.token);
            this.buttonConfig.buttonSuccess = true
            this.$router.push('/');
        } catch (err) {
            this.buttonConfig.buttonLoading = false
            this.buttonConfig.isDisabled = false

            const { errors }  = err.response.data
            this.config.globalError = errors.message || ''
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
  form p{
    padding: 10px 5px;
    font-size: 0.9em;
    color: #4f4f4f;
  }
  form p a{
    font-size: 1em;
    color: #572fc4;
  }
</style>