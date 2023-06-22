<template>
    <section class="h-100">
        <div class="h-65px d-middle gap-3 px-4 mb-4" style="box-shadow: 0px 1px 2px var(--shadow);">
            <el-tooltip content="Lista de tiendas" placement="bottom" effect="light">
                <div class="wh-32 rounded-circle icon-hover-blue d-middle-center cr-pointer" style="transition: .3s;" @click="router.go(-1)">
                    <i class="icon-arrow-left f-25" />
                </div>
            </el-tooltip>
            <p class="f-28 f-bold">Historial de estados</p>
        </div>
        <div class="h-100 overflow-auto hidden-scroll">
            <p class="f-bold f-22 px-5 pb-4">Tienda</p>
            <el-table
                :data="informationStatesBox"
                header-cell-class-name="bg-blue-light-table f-16"
                style="width: 100%;"
                size="large"
                class="mb-5 pb-5"
            >
                <el-table-column class-name="f-16" label="" width="50" />
                <el-table-column label="Estados" prop="estado" width="170" >
                    <template #default="scope">
                        <stateBox :state-content="scope.row.estado" :show-padding="true" class="el-tag" />
                    </template>
                </el-table-column>
                <el-table-column label="Fecha" prop="fechaState" width="200" />
                <el-table-column label="Responsable" prop="responsable" width="160" />
                <el-table-column label="" width="210">
                    <template #default="scope">
                        <cardObservations v-if="scope.row.tieneObservacion !== 0"  classAdditional="py-1" />
                    </template>
                </el-table-column>
                <template #empty>
                    <div class="d-middle-center flex-column gap-3" style="height: 70vh;">
                        <img src="/img/emptyState/woRequests.png" alt="" class="wh-200" />
                        <p class="f-15">No hay solicitudes de nuevos restaurantes</p>
                    </div>
                </template>
              <el-table-column label="" width="290" />
            </el-table>
        </div>
    </section>
</template>

<script setup>
import cardObservations from '../components/cardObservations.vue';
import stateBox from '../components/stateBox.vue';
import { useRouter, useRoute } from 'vue-router';
import { onMounted, ref } from 'vue';
import axios from 'axios';

let route = useRoute()
let router = useRouter()

const informationStatesBox = ref([])

onMounted(() => {
    viewRuta()
})

async function viewRuta(){
    let historyStore = await axios.get(`api/restaurantes/${route.params.id}/tiendas/${route.params.idStore}/estado`)
    informationStatesBox.value = historyStore.data?.data ?? []
    // console.log('Estoy en esta ruta: ', route);
}

</script>

<style lang="scss" scoped>

</style>