import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import AddPost from '@/views/post/AddPostView.vue'
import EditPost from '@/views/post/EditPostView.vue'
import ShowPost from '@/views/post/ShowPostView.vue'
import Profile from '@/views/profile/ProfileView.vue'
import Login from '@/views/auth/LoginView.vue'
import Signup from '@/views/auth/SignUpView.vue'
import EditProfile from '@/views/profile/EditProfileView.vue'


const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    name: 'Home',
    component: HomeView
  },
  {
    path: '/AddPost',
    name: 'AddPost',
    component: AddPost,
    beforeEnter: (to, from, next) => {
      const token = localStorage.getItem('token');
      if (!token) {
        next({ name: 'Login' });
      } else {
        next();
      }
    }
  },
  {
    path: '/EditPost/:id',
    name: 'EditPost',
    component: EditPost,
    beforeEnter: (to, from, next) => {
      const token = localStorage.getItem('token');
      if (!token) {
        next({ name: 'Login' });
      } else {
        next();
      }
    }
  },
  {
    path: '/ShowPost/:id',
    name: 'ShowPost',
    component: ShowPost
  },
  {
    path: '/Profile',
    name: 'Profile',
    component: Profile,
    beforeEnter: (to, from, next) => {
      const token = localStorage.getItem('token');
      if (!token) {
        next({ name: 'Login' });
      } else {
        next();
      }
    }
  },
  {
    path: '/EditProfile',
    name: 'EditProfile',
    component: EditProfile,
    beforeEnter: (to, from, next) => {
      const token = localStorage.getItem('token');
      if (!token) {
        next({ name: 'Login' });
      } else {
        next();
      }
    }
  },
  {
    path: '/Login',
    name: 'Login',
    component: Login,
    beforeEnter: (to, from, next) => {
      const token = localStorage.getItem('token');
      if (token) {
        next({ name: 'Home' });
      } else {
        next();
      }
    }
  },
  {
    path: '/Signup',
    name: 'Signup',
    component: Signup,
    beforeEnter: (to, from, next) => {
      const token = localStorage.getItem('token');
      if (token) {
        next({ name: 'Home' });
      } else {
        next();
      }
    }
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
