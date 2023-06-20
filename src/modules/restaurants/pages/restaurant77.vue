<template>
    <div class="d-flex w-100">
        <div class="wf-244px pt-2" style="box-shadow: 0px 1px 2px var(--shadow); margin-right: 1px;">
            <div class="d-middle gap-1 px-1">
                <div class="item-with-hover rounded-circle d-middle-center cr-pointer wh-32" @click="goRouterBack">
                    <i class="icon-chevron-left f-24" />
                </div>
                <p class="f-12">Lista de restaurantes</p>
            </div>
            <div class="d-flex gap-2 ps-4 mt-2 mb-4">
                <img :src="menuFijo.fotoLogoMini" alt="ImageAlRock" class="wh-51">
                <div>
                    <p class="f-22 f-bold">{{ menuFijo.nombre }}</p>
                    <p class="f-14 text-whitesmoke">{{ menuFijo.holding }}</p>
                </div>
            </div>
            <router-list :list="restaurantNames" nameRoute="route">
                <template #default="{ item, index, selected }">
                    <card-restaurant
                        :data="item"
                        :indice="index"
                        :seleccionado="selected"
                        :countStores="menuFijo.contarTiendas"
                        @click="toRouteStores(item.route)"
                    />
                </template>
            </router-list>
        </div>
        <div class="w-100">
            <div class="h-100">
                <router-view :menuFixedStore="menuFijo" />
            </div>
        </div>
    </div>
</template>

<script setup>
import cardRestaurant from '../components/cardRestaurant.vue';
import routerList from '../../../shared/components/routerList.vue';
import { useRouter, useRoute } from 'vue-router';
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';

const router = useRouter()
const route = useRoute()

onMounted(() => {
    getDatasRestaurant()
})

const menuFijo = ref({})

const restaurantNames = ref([
    {
        id: 1,
        nombre: 'Tiendas',
        notificaciones: 1,
        route: 'restaurant.seventySeven.stores'
    },
    {
        id: 2,
        nombre: 'Métodos de pago',
        notificaciones: null
    }
])

async function getDatasRestaurant(){
    let datasRestaurantFixedMenu = await axios.get(`api/restaurantes/${route.params.id}/menu-fijo`)
    menuFijo.value = datasRestaurantFixedMenu.data?.data ?? []
}

function toRouteStores(ruta){
    router.push({ name: ruta })
}

function goRouterBack(){
    router.push({ name: 'restaurant.requests.list' })
}

</script>

<style lang="scss" scoped>
.letters{
    color: red !important;
}



</style>