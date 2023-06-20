<template>
    <div class="wf-259px border-end bg-blue-lightest hidden-scroll overflow-auto" >
        <template v-for="modul in modules" :key="modul.id">
            <h4 class="f-13 f-bold mt-5 mb-1" style="margin-left: 33px">{{ modul.title }}</h4>
            <routerList :list="modul.menus" nameRoute="route" >
                <template #default="{ item, selected }">
                    <div
                        class="w-240px h-40px rounded-1 mx-auto d-middle item-with-hover cr-pointer"
                        :class="{ 'div-router' : selected }"
                        style="margin-bottom: 2px;"
                        @click="selectedRoute(item.route)"
                    >
                        <!-- Barra azul izquierda -->
                        <div style="border-radius: 0px 2px 2px 0px;" class="div-active w-4px h-26px" />
                        <!-- parrafo dentro del module -->
                        <p class="text-active text-grey f-14 ms-3" > {{ item.name }} </p>
                    </div>
                </template>
            </routerList>
        </template>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import routerList from '../../../shared/components/routerList.vue';

const router = useRouter()
const route = useRoute()

const modules = ref([
    {
        title: 'Restaurantes',
        id: 1,
        menus: [
            {name: 'Categorias de restaurantes', route: 'parameterization.categories' },
            {name: 'Etiquetas de restaurantes', route: 'parameterization.restaurantLabels'},
            {name: 'Planes de comision', route: 'parameterization.comissionPlans'},
            {name: 'Clasificacion', route: 'parameterization.classification'},
            {name: 'Entidades bancarias'},
        ]
    },
    {
        title: 'Tiendas',
        id: 2,
        menus: [
            {name: 'Motivos de inactivacion'},
            {name: 'Geocercas'},
            {name: 'Calificaciones'},
        ]
    },
    {
        title: 'Productos',
        id: 3,
        menus: [
            {name: 'Etiquetas de productos'},
        ]
    },
    {
        title: 'Ordenes',
        id: 4,
        menus: [
            {name: 'Motivos de rechazo'},
            {name: 'Motivos de cancelacion'},
            {name: 'Motivos de reclamo'},
            {name: 'Tiempos de estado'},
        ]
    },
    {
        title: 'Comunicacion',
        id: 5,
        menus: [
            {name: 'Correos administradores'},
            {name: 'Correos clientes'},
            {name: 'Footer'},
            {name: 'FAQs administradores'},
            {name: 'FAQs clientes', route: 'parameterization.faqsClients'},
        ]
    },
    {
        title: 'Horarios',
        id: 6,
        menus: [
            { name: 'Dias y horas de apertura' }
        ]
    },
    {
        title: 'Promociones y cupones',
        id: 7,
        menus: [
            { name: 'Creados por el restaurante' },
            { name: 'Imagenes de promociones' },
            { name: 'Stickers destacados' },
            { name: 'Imagenes cupones' }
        ]
    },
    {
        title: 'Pagos y recargas',
        id: 8,
        menus: [
            { name: 'Wallet yap', active: false }
        ]
    },
    {
        title: 'Clientes',
        id: 8,
        menus: [
            { name: 'Puntos negativos', active: false }
        ]
    }
])

function selectedRoute(route){
    router.push({ name: route })
}

</script>

<style scoped lang="scss" >
.div-router{
    background-color: var(--blue-light) !important;
    .text-active{
        color: var(--blue-state);
    }
    .div-active{
        background-color: var(--blue-state);
    }
}
</style>