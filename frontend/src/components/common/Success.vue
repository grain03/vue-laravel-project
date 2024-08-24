<template>
<div class="success">
    <div class="successContainer">
        <p>{{ successMessage }}</p>
        <AppCTA link="" @click="closeSuccessMessage" >X</AppCTA>
    </div>
</div>
</template>

<script>
import AppCTA from '@/components/common/AppCta.vue';

export default {
props: {
    successMessage: {
        type: String,
        default: ''
    }
},
methods: {
    closeSuccessMessage(){
        this.$emit('close')
    }
},
components : {
    AppCTA
}
}
</script>

<style>

.success{
    position: relative;
    width: 100%;
    box-sizing: border-box;
}
.success .successContainer{
    position: fixed;
    bottom: 50px;
    right: 50px;
    max-width: 500px;
    padding: 15px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    border-radius: 7px;
    background-color: #9ce59c;
    border-left: 8px solid #24c924;
    box-sizing: border-box;
}

.success .successContainer .d-btn{
    padding: 10px;
    width: 10px;
    height: 10px;
    background-color: #24c924;
    cursor: pointer;
}
.success .successContainer p{
    color: #24c924;
    font-size: 0.9em;
    font-weight: 500;
}
</style>