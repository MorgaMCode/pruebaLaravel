<template>
    <div class=" px-5 mt-5 d-middle gap-5">
        <template v-for="(mosaic, index) in tableInformationRestaurant" :key="index">
            <el-badge :value="mosaic.contarTiendas" class="f-14">
                <div class="text-center bg-pill p-3 box-shadowBox br-5">
                    <p class="f-14 f-semibold mb-1">{{ mosaic.restaurante }}</p>
                    <img class="wh-100" :src="mosaic.fotoLogo" alt="image-alRock" @click="toRestaurantSeventyseven(mosaic.id)" >
                    <p class="f-12 text-whitesmoke mt-1">{{ mosaic.categoria }}</p>
                    <p class="f-10 text-whitesmoke">{{ mosaic.holding }}</p>
                </div>
            </el-badge>
        </template>
    </div>
</template>

<script setup>
import { useRouter } from 'vue-router';

const router = useRouter()
let props = defineProps({
    tableInformationRestaurant: {
        type: Array
    },
    busqueda: {
        type: String
    }
})

function toRestaurantSeventyseven(id){
    router.push({ name: 'restaurantSeventySeven.stores', params: { id: id } })
}

</script>

<style lang="scss" scoped>

</style>