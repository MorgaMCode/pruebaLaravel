<template>
    <el-table
        :data="boxInformation"
        header-cell-class-name="bg-blue-light-table"
        style="width: 100%;"
        size="large"
        @row-click="toGoStore"
    >
        <el-table-column label="" width="70" />
        <el-table-column label="Tiendas (2)" sortable prop="tienda" width="170" class-name="f-16"/>
        <el-table-column label="Fecha de solicitud" sortable prop="fechaSolicitud" width="210" class-name="f-16"/>
        <el-table-column label="Fecha de estado" sortable prop="fechaEstado" width="210" class-name="f-16"/>
        <el-table-column label="estado" sortable width="150" >
            <template #default="scope">
                <stateBox :state-content="scope.row?.estado" :show-padding="true" class="el-tag" />
            </template>
        </el-table-column>
        <el-table-column width="150">
            <template #default="scope">
                <cardObservations v-if="scope.row.tieneObservacion !== 0" classAdditional="py-1" />
            </template>
        </el-table-column>
        <el-table-column width="200" />
    </el-table>
</template>

<script setup>
import stateBox from '../components/stateBox.vue';
import cardObservations from '../components/cardObservations.vue';
import { useRoute, useRouter } from 'vue-router';

let route = useRoute()
let router = useRouter()

let props = defineProps({
    boxInformation: {
        type: Array,
        required: true,
        default: () => []
    }
})

function toGoStore(i){
    router.push({ name: 'restaurant.seventySeven.stores.historyInformation', params: { idStore: i.id }})
}

</script>

<style lang="scss" scoped>
</style>