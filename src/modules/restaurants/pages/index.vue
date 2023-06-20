<template>
    <div class="w-100 overflow-auto hidden-scroll position-relative">
        <main class="p-5">
            <h1 class="f-28 f-bold">Restaurantes</h1>
            <div class="mt-4 d-middle flex-wrap gap-3">
                <router-list :list="restaurants" nameRoute="route">
                    <template #default="{ item, selected }">
                        <div
                            :class="{ 'div-router cr-default': selected }"
                            class="hover-div cr-pointer text-center bg-whitesmoke2 br-5 py-2 d-middle-center gap-2 px-4"
                            @click="toGoRoute(item.route, true)"
                        >
                            <p class="f-14">{{ item.title }}</p>
                            <div v-if="item.notifications" class="wh-24 d-middle-center rounded-circle bg-red-badge text-white">
                                <p class="f-14 lh-20">{{ item.notifications }}</p>
                            </div>
                        </div>
                    </template>
                </router-list>
            </div>
            <div class="mt-5">
                <head class="d-middle-bt">
                    <h2 v-if="route.name.indexOf('restaurant.requests') !== -1" class="f-20 f-bold mb-0">Solicitud de restaurantes</h2>
                    <h2 v-else class="f-20 f-bold mb-0">Restaurantes activos</h2>
                    <main class="d-middle gap-2 me-2">
                        <router-list v-if="route.name.indexOf('restaurant.requests') !== -1" :list="tableRestaurant" name-route="route">
                            <template #default="{ item, selected }">
                                <el-tooltip :content="item.tooltipContent" placement="bottom" effect="light">
                                    <div
                                        class="wh-40 rounded-circle icon-hover-blue cr-pointer"
                                        :class="{ 'bg-blue-state-lightest text-blue': selected }"
                                        @click="toGoRoute(item.route)"
                                    >
                                        <i  :class="item.icon" class="f-25" />
                                    </div>
                                </el-tooltip>
                            </template>
                        </router-list>
                        <div class="w-316px d-middle position-relative ms-auto">
                            <el-input v-model="search" placeholder="Buscar" />
                            <i class="icon-buscar position-absolute end-0 f-24 me-1" />
                        </div>
                    </main>
                </head>
            </div>
        </main>
        <router-view :searchWordBox="search" />
    </div>
</template>

<script setup>
import routerList from '../../../shared/components/routerList.vue';
import { useRouter, useRoute } from 'vue-router';
import { ref, onMounted } from 'vue';
import axios from 'axios';


const router = useRouter()
const route = useRoute()
const search = ref('')
const dataActives = ref()
const routeName = ref('')

const restaurants = ref([
    {
        id: 1,
        title: 'Solicitudes',
        notifications: 3,
        route: 'restaurant.requests'
    },
    {
        id: 2,
        title: 'Activos',
        notifications: null,
        route: 'restaurant.actives'
    },
    {
        id: 3,
        title: 'Inactivos',
        notifications: null,
        route: 'restaurant.inactives'
    },
    {
        id: 4,
        title: 'Rechazados',
        notifications: null,
    },
    {
        id: 5,
        title: 'Eliminados',
        notifications: null,
    },
    {
        id: 6,
        title: 'Mapa',
        notifications: null,
    },
])

const tableRestaurant = ref([
    {
        id: 1,
        icon: 'icon-list',
        tooltipContent: 'Lista',
        route: 'restaurant.requests.list'
    },
    {
        id: 2,
        icon: 'icon-mini-dashboard',
        tooltipContent: 'Mosaico',
        route: 'restaurant.requests.mosaic'
    }
])


console.log('Estamos en esta ruta: ', route.name);

function toGoRoute(valueRoute, isTab = false){
    router.push({ name: valueRoute })
    if(isTab) search.value = ''
}

</script>

<style lang="scss" scoped>
.hover-div{
    transition: all .3s;
    &:hover{
        background-color: var(--gray-light) !important;
    }
}
.div-router{
    background-color: var(--blue-state-lightest) !important;
    color: var(--blue-state) !important;
    &:hover{
        background-color: var(--blue-state-lightest) !important;
    }
}

</style>