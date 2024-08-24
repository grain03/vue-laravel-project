<template>
<router-link :to="link" class="d-btn">
    <slot></slot>
</router-link>
</template>

<script>
export default {
props : {
    link : {
        default : "#",
        type: String
    }
}
}
</script>

<style>
.d-btn{
    padding: 10px 15px;
    background-color: #48308a;
    text-decoration: none;
    border-radius: 999px;
    transition: 0.5s ease;
    list-style: none;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 10%;
    max-width: 120px;
    min-width: fit-content;
    color: #fff;
    z-index: 1;
    font-size: 0.9em;
    outline: none;
    border: none;
    cursor: pointer;
}

.d-btn:hover{
    background-color: #8c74ce;
}
.d-btn i{
    font-size: 0.8em;
}
.d-btn:disabled{
    background-color: #d6d6d6;
    color: #a1a1a1;
    cursor: not-allowed;
    pointer-events: none;
}
</style>