<template>
    <div class="w-100 h-100">
        <div class="border-end w-345px h-100">
            <div class="d-flex gap-1 border-bottom py-4 px-2">
                <div class="icon-hover-blue rounded-circle cr-pointer d-middle-center wh-32" @click="toGoRouteBack">
                    <el-tooltip content="Regresar" placement="bottom" effect="light">
                        <i class="icon-chevron-left f-25" />
                    </el-tooltip>
                </div>
                <div>
                    <p class="f-medium f-16">Para cualquier ocasión</p>
                    <p class="f-light text-whitesmoke f-12">Grupo activo</p>
                </div>
                <div class="d-middle ms-auto">
                    <i class="icon-dots-vertical f-25" />
                    <i class="icon-add-square f-27" />
                </div>
            </div>
            <div class="w-100 position-relative p-3">
                <el-input v-model="searchPromotion" placeholder="Buscar" />
                <i class="icon-buscar position-absolute end-0 pe-3 f-25" />
            </div>
            <cardPromotions v-for="(coupon, i) in informationCoupon" :key="i" :data="coupon" />
        </div>
    </div>
</template>

<script setup>
import cardPromotions from '../components/cardPromotions.vue';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const searchPromotion = ref('')
let router = useRouter()

const informationCoupon = ref([
    { text: 'Todo a 10k', notificacion: 15, restaurants: 5 },
    { text: 'Para compartir en familia', notificacion: 0, restaurants: 8 },
    { text: 'No importa donde estés', notificacion: 23, restaurants: 7 },
])

function toGoRouteBack(){
    router.push({ name: 'promotions.groups' })
}

</script>

<style lang="scss" scoped>

</style>