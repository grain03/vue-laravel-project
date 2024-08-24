<template>
  <Navbar/>
  <div class="SignupForm">
    <SignupForm/>
  </div>
</template>

<script>
import Navbar from '@/components/layouts/Navbar.vue';
import SignupForm from '../../components/auth/SignupForm.vue';

export default {

components: {
    Navbar,
    SignupForm
},

}
</script>

<style>

</style>