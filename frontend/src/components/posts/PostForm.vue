<template>
  <div>
    <form @submit.prevent="handleForm">
      <TextInput @disableButton="disableButton" v-model="formData.postContent" :errorMessage="config.errorMessage" inputName="postContent"  inputLabel="Write what's on your mind"/>
      <AppButton :error="buttonConfig.buttonError" :success="buttonConfig.buttonSuccess" :loading="buttonConfig.buttonLoading" :disabled="buttonConfig.isDisabled" >{{ buttonConfig.buttonInnerText }}</AppButton>
    </form>
    <transition name="fade">
      <Success v-if="config.successMessage" :successMessage="config.successMessage" @close="handleCloseSuccessMessage"/>
    </transition>
  </div>
</template>

<script>
import axios from 'axios';
import Success from '@/components/common/Success.vue'
import Loading from '@/components/common/Loading.vue'
import AppButton from '@/components/common/AppButton.vue'
import TextInput from '@/components/common/inputs/TextInput.vue';

export default {
  props: {
    formType : {
      default : 'Edit',
      type: String
    },
    postData : {},
    postID : null
  },
  data() {
    return {
      formTypeData: {
        method: '',
        apiURL: '',
      },
      buttonConfig: {
        isDisabled: false,
        buttonLoading: false,
        buttonSuccess: false,
        buttonError: false,
        buttonInnerText: ''      
      },
      config: {
        successMessage : '',
        errorMessage : '',
      },
      formData: {
        postContent : ''
      },
    }
  },

  components: {
    Error,
    Success,
    Loading,
    AppButton,
    TextInput
  },
  watch: {
    postData : {
      immediate: true,
      handler() {
        this.formData = this.postID ? {...this.postData.data} : this.formData
      }
    }
  },
  mounted(){
    this.chooseForm()
  },
  methods: {
    editForm(){
      this.formTypeData.method = 'PATCH',
      this.formTypeData.apiURL = 'http://127.0.0.1:8000/api/posts/update/' + this.postID,
      this.buttonConfig.buttonInnerText = 'Update'
    },
    addForm(){
      this.formTypeData.method = 'POST'
      this.formTypeData.apiURL = 'http://127.0.0.1:8000/api/posts/store',
      this.buttonConfig.buttonInnerText = 'Submite'
    },
    chooseForm(){
      if (this.formType == 'Edit') {
        this.editForm()
      }else{
        this.addForm()
      }
    },
    disableButton(status){
      this.buttonConfig.isDisabled = status
    },
    async handleForm(){
      this.disableButton(true)
      this.config.successMessage = ''
      this.config.errorMessage = ''
      this.buttonConfig.buttonLoading = true
      const token = localStorage.getItem('token');
      
      console.log(this.formData);
      
      try {
        if (this.formType == 'Edit') {          
          const req = await axios.patch(this.formTypeData.apiURL, this.formData, {
              headers: {
                  'Authorization': `Bearer ${token}`,
              },
          });
          this.config.successMessage = req.data.message
        }else{
          const req = await axios.post(this.formTypeData.apiURL, this.formData, {
              headers: {
                  'Authorization': `Bearer ${token}`,
              },
          });
          this.config.successMessage = req.data.message
        }
        this.buttonConfig.buttonSuccess = true
        this.disableButton(true)

      } catch (err) {
        this.disableButton(false)
        this.config.errorMessage = err.response.data.message
      }finally {
        this.buttonConfig.buttonLoading = false
        if (this.buttonConfig.isDisabled) {
          setTimeout(() => {
            this.$router.push('/')
          }, 2000)
        }
      }
    },
    handleCloseSuccessMessage() {
      this.config.successMessage = ''
    }
  }

  
}
</script>

<style scoped>
  .fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s ease-in-out;
  }
  .fade-enter, .fade-leave-to {
    opacity: 0;
  }

  form{
    width: 90%;
    margin: 30px auto;
    border-radius: 5px;
    background-color: #d6c8fb;
    padding: 10px;
    box-sizing: border-box;
  }
</style>