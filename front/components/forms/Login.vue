<template>
<div>
    <form @submit.prevent="attemptLogin">
        <div class="space-y-5">
            <form-input label="Email" type="email"></form-input>
            <form-input label="Password" type="password"></form-input>
            <c-button class="w-full" type="submit">Login</c-button>
        </div>
    </form>
</div>
</template>
<script lang="ts" setup>
const attemptLogin = () => {}
</script>