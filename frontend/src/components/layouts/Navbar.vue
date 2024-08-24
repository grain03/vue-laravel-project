<template>
  <nav class="Navbar">
    <div class="logo">
      Prototype
    </div>
    <ul>
      <li><router-link to="/">Home</router-link></li>
      <li><router-link to="/Profile">Profile</router-link></li>
      <li><LogoutButton/></li>
    </ul>
  </nav>
</template>

<script>
import axios from 'axios'
import { defineComponent } from 'vue';
import LogoutButton from '../auth/LogoutButton.vue';

export default defineComponent({
  name: 'Navbar',
  props: {
    message: String,
  },
  components: {
    LogoutButton
  },
  data() {
    return {
      isLoggedIn : false,
      EmitText: ''
    }
  },
  created() {
    const token = localStorage.getItem('token')
    this.isLoggedIn = token ? true : false
  },
  methods: {
    async logout() {
      try {
        const token = localStorage.getItem('token');        
        await axios.post('http://127.0.0.1:8000/api/auth/logout', {}, {
          headers : {
            Authorization : `Bearer ${token}`
          }
        })
        localStorage.removeItem('token')
        this.isLoggedIn = false
        this.$router.push('/login');
      } catch (error) {
        console.error('Failed to log out:', error);
      }
    },
  },
});
</script>

<style scoped>
.Navbar {
  width: 100%;
  height: 100px;
  background-color: #b097f7;
  padding: 10px;
  box-sizing: border-box;
  display: flex;
  align-items: center;
  justify-content: space-around;
}

.Navbar .logo {
  font-size: 1.3em;
  font-weight: 500;
  color: #48308a;
}

.Navbar ul {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 50px;
  list-style: none;
}

.Navbar ul li a:not(.d-btn){
  text-decoration: none;
  font-size: 1em;
  font-weight: 400;
  padding: 10px;
  border: 1px solid transparent;
  color: #48308a;
}

.Navbar ul li a:hover:not(.d-btn) {
  border-bottom: 2px solid #48308a;
}
</style>
