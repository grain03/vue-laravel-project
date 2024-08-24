<template>
    <Navbar/>
    <div class="Profile">
        <ProfileCard />
    </div>
</template>

<script>
    import { defineComponent } from 'vue';
    import Navbar from '@/components/layouts/Navbar.vue';
    import ProfileCard from '@/components/profile/ProfileCard.vue';

    export default defineComponent({
    name: 'HomeView',
    components: {
        Navbar,
        ProfileCard
    }
    });
</script>
