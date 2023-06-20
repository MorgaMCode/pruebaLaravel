<script setup>
import { computed } from 'vue';
import { useRoute } from 'vue-router';
import defaultLayout from './shared/layouts/main.vue';

const layouts = {
    defaultLayout
}
const route = useRoute();

const layout = computed(() => {
    if(route?.name && route?.meta?.layout) return layouts[route.meta.layout];
    else if (route?.name) return layouts.defaultLayout;
    else return null;
})

</script>

<template>
    <component :is="layout" />
</template>

<style lang="scss">
@import './assets/scss/main.scss';
</style>
