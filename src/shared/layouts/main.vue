<template>
    <div class="layout overflow-hidden">
        <navbar />
        <div class="d-flex" style="height: calc(100% - 56px);">
            <menuLeft />
            <RouterView />
        </div>
    </div>
</template>

<script setup>
import navbar from '../components/navbar.vue';
import menuLeft from '../components/menuLeft.vue';

</script>

<style lang="scss" scoped>
.layout{
    height: 100vh;
    width: 100vw;
}
</style>