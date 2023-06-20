<template>
    <el-table
        :data="filtrarBusquedaDeTabla"
        header-cell-class-name="bg-blue-light-table f-16"
        style="width: 100%; height: 100%;"
        size="large"
    >
        <el-table-column width="55" />
        <el-table-column label="Nombre" sortable width="260">
            <template #default="scope">
                <p class="f-16">{{ scope.row.nombre }}</p>
            </template>
        </el-table-column>
        <el-table-column label="Tipo promoción" sortable width="240">
            <template #default="scope">
                <p class="f-16">{{ scope.row.tipoPromocion }}</p>
            </template>
        </el-table-column>
        <el-table-column label="Vigencia" sortable width="250">
            <template #default="scope">
                <p class="f-16">{{ scope.row.vigenciaDesde }} - {{ scope.row.vigenciaHasta }}</p>
            </template>
        </el-table-column>
        <el-table-column label="Productos / órdenes" sortable width="130">
            <template #default="scope">
                <div class="d-flex py-2">
                    <i :class="[ scope.row.type == 'producto' ? 'icon-product' : 'icon-orders-outline' ]" class="f-30" />
                    <p class="f-16">{{ scope.row.typeValue }}</p>
                </div>
            </template>
        </el-table-column>
        <el-table-column label="Ventas" sortable width="170">
            <template #default="scope">
                <p class="f-16">${{ scope.row.ventas }}</p>
            </template>
        </el-table-column>
        <el-table-column label="Restaurantes" sortable width="250">
            <template #default="scope">
                <p class="f-16">{{ scope.row.restaurantes }}</p>
            </template>
        </el-table-column>
        <el-table-column label="Visualizaciones" sortable width="180">
            <template #default="scope">
                <p class="f-16">{{ scope.row.visualizaciones }}</p>
            </template>
        </el-table-column>
        <el-table-column label="Grupo" sortable width="230">
            <template #default="scope">
                <p class="f-16">{{ scope.row.grupo }}</p>
            </template>
        </el-table-column>
        <el-table-column label="Fin" sortable width="140">
            <template #default="scope">
                <p class="f-16">{{ scope.row.fin }}</p>
            </template>
        </el-table-column>
        <el-table-column width="120">
            <template #default="scope">
                <el-dropdown>
                    <template #default>
                        <div class="icon-hover-blue d-middle-center cr-pointer rounded-circle wh-32">
                            <i class="icon-dots-vertical f-25" />
                        </div>
                    </template>
                    <template #dropdown>
                        <el-dropdown-menu class="w-146px py-1">
                            <el-dropdown-item class="px-2">
                                <div class="icon-hover-blue cr-pointer px-3 py-1 br-5 w-100">
                                    <p class="f-16">Duplicar</p>
                                </div>
                            </el-dropdown-item>
                        </el-dropdown-menu>
                    </template>
                </el-dropdown>
            </template>
        </el-table-column>
        <el-table-column label=""/>
        <template #empty>
            <div class="d-middle flex-column j-center" style="height: 73vh;">
                <img src="/img/emptyState/woPromos.png" alt="ImageDatosVacios" class="wh-200">
                <p class="text-grey-light f-15">No hay promociones finalizadas</p>
            </div>
        </template>
    </el-table>
</template>

<script setup>
import { watch, ref } from 'vue';


let props = defineProps({
    informationTablePromotionsHistory:{
        type: Array,
        required: true,
        default: () => []
    },
    valueSearch: {
        type: String,
        required: false,
        default: ''
    }
})

const filtrarBusquedaDeTabla = ref(props.informationTablePromotionsHistory)

watch(
    () => props.valueSearch,
    (newValue) => {
        if(filtrarBusquedaDeTabla.value !== null){
            filtrarBusquedaDeTabla.value = props.informationTablePromotionsHistory.filter((element) => element.nombre.toLowerCase().includes(newValue.toLowerCase()))
        }
    }
)



</script>

<style lang="scss" scoped>

</style>