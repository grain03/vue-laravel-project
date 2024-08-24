
<template>
    <div class="input">
        <label :for="inputName">{{ inputLabel }}</label>
        <input :id="inputName" :value="modelValue" @input="handleInput" type="text">
        <Error v-if="addErrorMessage || errorMessage" :errorMessage="addErrorMessage || errorMessage"/>
    </div>
</template>

<script>
 
import Error from '@/components/common/Error.vue'

export default {
    emits: ['update:modelValue', 'disableButton'],
    props : {
        modelValue : '',
        inputLabel: '',
        inputName: '',       
        inputPlaceHolder : '',
        errorMessage : '',
        validation: {
            type: Array,
            default: () => []
        }
    },
    components: {
        Error
    },
    data() {
        return {
            addErrorMessage : ''
        }
    },
    methods: {
        handleInput(e){
            const inputValue = e.target.value
            this.$emit('update:modelValue', inputValue);
            for (let r of this.validation) { // r stands for rules
                let err = this.validate(inputValue, 'email', r)
                if (err) {
                    break;
                }
            }
        },
        validate(inputValue, validationName, validationRule){
            this.addErrorMessage = ''
            if (validationRule == 'required' && !inputValue) {
                this.addErrorMessage = `The ${validationName} field is required.`
                this.$emit('disableButton', true)
                return true
            }else if (validationRule.startsWith('min:') && inputValue.length < parseInt(validationRule.split(':')[1])) {
                this.addErrorMessage = `The ${validationName} must be at least ${parseInt(validationRule.split(':')[1])} characters.`
                this.$emit('disableButton', true)
                return true
            }else if (validationRule === 'email' && !/^\S+@\S+\.\S+$/.test(inputValue)) {
                this.addErrorMessage = `The ${validationName} must be a valid email address.`
                this.$emit('disableButton', true)
                return true
            }else {
                this.$emit('disableButton', false)
            }
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
</style>