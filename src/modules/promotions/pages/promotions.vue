<template>
    <section class="w-100">
        <router-view v-model="boxPromocionesInformation" />
    </section>
</template>

<script setup>
import { ref } from 'vue';

const boxPromocionesInformation = ref([
    { id: 1, text: 'Para cualquier ocasión', promo: 5, activePromotions: 2, state: 'Activo', active: 1 },
    { id: 2, text: 'Juernes de locura', promo: 2, activePromotions: 2, state: 'Activo', active: 0 },
    { id: 3, text: 'Precios insuperables en tus productos favoritos', promo: 5, activePromotions: 0, state: 'Inactivo', active: 1 },
])

</script>

<style lang="scss" scoped>

</style>