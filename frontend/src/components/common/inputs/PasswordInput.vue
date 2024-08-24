<template>
    <div class="input">
        <label :for="inputName">{{ inputLabel }}</label>
        <div class="passwordInput">
            <input :id="inputName" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" :type="isShow ? 'text' : 'password'">
            <i @click="showPassword" :class="!isShow ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash'"></i>
        </div>
        <Error v-if="errorMessage" :errorMessage="errorMessage"/>
    </div>
</template>

<script>
import Error from '@/components/common/Error.vue'

export default {
    emits: ['update:modelValue'],
    props : {
        modelValue : '',
        inputLabel: '',
        inputName: '',       
        inputPlaceHolder : '',
        errorMessage : '',
    },
    components: {
        Error
    },
    data() {
        return {
            isShow: false
        }
    },
    methods: {
        showPassword(){
            this.isShow = !this.isShow
        }
    }
}
</script>

<style scoped>
.input{
    width: 100%;
    display: grid;
    gap: 10px;
    margin: 10px auto;
}

.input input{
    width: 100%;
    box-sizing: border-box;
    padding: 10px;
    border-radius: 5px;
    border: none;
}
.input .passwordInput{
    position: relative;
}
.passwordInput i {
    position: absolute;
    right: 15px;
    padding: 8px;
    font-size: 0.8em;
    color: #585858;
    border-radius: 999px;
    box-sizing: border-box;
    bottom: 50%;
    transform: translateY(50%);
    transition: 0.7s;
    cursor: pointer;
}
.passwordInput i:hover{
    background-color: #5f5f5f54;
}
</style>