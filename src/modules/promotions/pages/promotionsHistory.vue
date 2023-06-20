<template>
    <div class="d-middle-bt px-4 pt-4 pb-5 mb-3 w-95">
        <div class="d-middle gap-2">
            <el-tooltip content="Regresar" placement="bottom" effect="light">
                <div class="icon-hover-blue rounded-circle d-middle-center cr-pointer wh-32" @click="toGoRouteBack">
                    <i class="icon-chevron-left f-25" />
                </div>
            </el-tooltip>
            <h1 class="f-bold f-20 mb-0">Historial de promociones</h1>
        </div>
        <div class="d-middle position-relative">
            <el-input v-model="searchBox" placeholder="Buscar" />
            <i class="position-absolute end-0 icon-buscar f-25" />
        </div>
    </div>
    <div class="h-100 overflow-auto hidden-scroll" style="padding-bottom: 120px;">
        <table-promotions-history :informationTablePromotionsHistory="tableDatasPromotionsHistory" :valueSearch="searchBox"  />
    </div>
</template>

<script setup>
import tablePromotionsHistory from '../partials/tablePromotionsHistory.vue';
import { ref } from 'vue';
import { useRouter } from 'vue-router'

const searchBox = ref('')

let router = useRouter()

const tableDatasPromotionsHistory = ref([
    {
        nombre: 'Todo a 10k',
        tipoPromocion: 'Precio fijo',
        vigenciaDesde: '3 ago. 2022',
        vigenciaHasta: '8 ago. 2022',
        type: 'producto',
        typeValue: 350,
        ventas: '3.500.000',
        restaurantes: 5,
        visualizaciones: 2.566,
        grupo: 'Para cualquier ocasion',
        fin: 'Terminada'
    },
    {
        nombre: 'Para compartir en familia',
        tipoPromocion: 'Descuento en valor',
        vigenciaDesde: '1 ago. 2022',
        vigenciaHasta: '7 ago. 2022',
        type: 'producto',
        typeValue: 454,
        ventas: '5.980.000',
        restaurantes: 6,
        visualizaciones: 2.932,
        grupo: 'Juernes de locura',
        fin: 'Cancelada'
    },
    {
        nombre: 'No importa donde estés',
        tipoPromocion: 'Domicilio gratis',
        vigenciaDesde: '5 ago. 2022',
        vigenciaHasta: '10 ago. 2022',
        type: 'ordenes',
        typeValue: 756,
        ventas: '2.656.000',
        restaurantes: 20,
        visualizaciones: 1.656,
        grupo: 'Precios insuperables',
        fin: 'Terminada'
    }
])

function toGoRouteBack(){
    router.push({ name: 'promotions.groups' })
}

</script>

<style lang="scss" scoped>

</style>