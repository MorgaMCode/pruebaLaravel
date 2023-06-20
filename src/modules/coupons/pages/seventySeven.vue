<template>
    <div class="w-100 d-flex">
        <main class="w-345px">
            <div class="border-end border-bottom h-80px p-3">
                <div class="d-middle-bt">
                    <div class="d-flex gap-2">
                        <el-tooltip content="regresar" placement="bottom" effect="light">
                            <div class="wh-32 d-middle icon-hover-blue rounded-circle cr-pointer" @click="routeBack">
                                <i class="icon-chevron-left f-20" />
                            </div>
                        </el-tooltip>
                        <main class="mt-1">
                            <p class="f-16 f-medium">Para los más fieles</p>
                            <p class="f-12 f-light">Grupo activo</p>
                        </main>
                    </div>
                    <div>
                        <i class="icon-dots-vertical f-27" />
                        <i class="icon-add-square f-25" />
                    </div>
                </div>
            </div>
            <div class="border-end border-bottom h-100">
                <main class="position-relative py-3">
                    <div class="px-3 pb-3">
                        <el-input v-model="search" placeholder="Buscar" />
                        <i class="icon-buscar position-absolute end-0 f-24 me-3" />
                    </div>
                    <CardCoupon v-for="(data, index) in pagesImplements" :key="index" :data="data" />
                </main>
            </div>
        </main>
        <main style="width: calc(100% - 345px);">
            <router-view />
        </main>
    </div>
</template>

<script setup>
import CardCoupon from '../components/cardCoupon.vue';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter()
const search = ref('')

const pagesImplements = ref([
    {
        id: 1,
        text: 'Compra hoy',
        users: 15,
        restaurants: 5
    },
    {
        id: 2,
        text: 'Locos por el sushi',
        users: 41,
        restaurants: 7
    },
    {
        id: 3,
        text: 'Para un antojito',
        users: 25,
        restaurants: 8
    },
    {
        id: 4,
        text: 'Compras 2022',
        users: 63,
        restaurants: 15
    },
    {
        id: 5,
        text: 'Te descontamos 20k',
        users: 54,
        restaurants: 6
    },
])

function routeBack(){
    router.push({ name: 'coupons' })
}

</script>

<style lang="scss" scoped>

</style>