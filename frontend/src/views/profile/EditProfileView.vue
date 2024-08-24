<template>
    <Navbar/>
    <div class="Profile">
        <EditProfile />
    </div>
</template>

<script>
    import { defineComponent } from 'vue';
    import Navbar from '@/components/layouts/Navbar.vue';
    import EditProfile from '@/components/profile/EditProfile.vue';
    
    export default defineComponent({
    name: 'HomeView',
    components: {
        Navbar,
        EditProfile
    }
    });
</script>
