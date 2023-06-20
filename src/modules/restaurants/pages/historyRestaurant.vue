<template>
    <section class="h-100">
        <div class="h-65px d-middle gap-3 px-4 mb-4" style="box-shadow: 0px 1px 2px var(--shadow);">
            <el-tooltip content="Lista de tiendas" placement="bottom" effect="light">
                <div class="wh-32 rounded-circle icon-hover-blue d-middle-center cr-pointer" @click="toGoBackRouter">
                    <i class="icon-arrow-left f-25" />
                </div>
            </el-tooltip>
            <p class="f-28 f-bold">Historial de estados</p>
        </div>
        <div class="overflow-auto hidden-scroll h-100">
            <p class="f-22 f-bold px-5 pb-4">Restaurante</p>
            <el-table
                :data="informationStates"
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
import stateBox from '../components/stateBox.vue';
import cardObservations from '../components/cardObservations.vue';
import { useRouter, useRoute } from 'vue-router';
import { ref, onMounted } from 'vue';
import axios from 'axios';

const router = useRouter()
const route = useRoute()

onMounted(() => {
    informationStatesData()
})

const informationStates = ref([])

async function informationStatesData(){
    let datasStates = await axios.get(`api/restaurantes/${route.params.id}/estado`)
    informationStates.value = datasStates.data?.data ?? []
}

function toGoBackRouter(){
    router.push({ name: 'restaurant.seventySeven.stores' })
}


</script>

<style lang="scss" scoped>

</style>