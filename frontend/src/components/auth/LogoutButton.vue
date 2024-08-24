<template>
    <AppCta @click="isLoggedIn && logout()" :to="!isLoggedIn ? '/Login' : ''">{{ !isLoggedIn ? 'Login' : 'Logout' }}</AppCta>
</template>

<script setup>
  import axios from 'axios';
  import { ref, onMounted } from 'vue'
  import { useRouter } from 'vue-router';
  import AppCta from '../common/AppCta.vue'

  const router = useRouter();
  const isLoggedIn = ref(false)
  
  const logout = async () => {
    try {
      const token = localStorage.getItem('token');        
      await axios.post('http://127.0.0.1:8000/api/auth/logout', {}, {
        headers : {
          Authorization : `Bearer ${token}`
        }
      })
      localStorage.removeItem('token')
      isLoggedIn.value = false
      router.push('/login')
    } catch (error) {
      console.error('Failed to log out:', error)
    }
  }

  onMounted(() => {
    const token = localStorage.getItem('token')
    isLoggedIn.value = token ? true : false
  })
    
</script>