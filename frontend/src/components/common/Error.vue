<template>
  <div class="error">
    <p>{{ errorMessage }}</p>
  </div>
</template>

<script>
export default {
props: {
    errorMessage: {
        type: String,
        default: ''
    }
},
}
</script>

<style>
    .error{
        width: 100%;
        box-sizing: border-box;
    }
    .error p{
        color: red;
        font-size: 0.9em;
        font-weight: 500;
    }
</style>