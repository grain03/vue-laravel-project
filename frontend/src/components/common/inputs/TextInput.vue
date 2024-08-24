
<template>
    <div class="input">
        <label :for="inputName">{{ inputLabel }}</label>
        <input :id="inputName" :value="modelValue" @input="e => $emit('update:modelValue', e.target.value)" type="text">
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
</style>