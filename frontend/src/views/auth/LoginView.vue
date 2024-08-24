<template>
  <Navbar/>
  <div class="loginForm">
    <LoginForm/>
  </div>
</template>

<script>
import Navbar from '@/components/layouts/Navbar.vue';
import LoginForm from '@/components/auth/LoginForm.vue';

export default {

components: {
    Navbar,
    LoginForm,
},

}
</script>

<style>

</style>