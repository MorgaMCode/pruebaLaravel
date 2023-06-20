<template>
    <div class="px-5 py-5 w-100 h-100 overflow-auto hidden-scroll">
        <infoTopConfig
            subtitle="Planes de comisión"
            description="Establece los diferentes planes de comisión que el manager seleccionará para cada restaurante creado"
        />
        <div class="mt-4">
            <div class="w-140px">
                <router-link :to="{ name: 'parameterization.comissionPlans.createPlan' }" >
                    <buttonAction />
                </router-link>
            </div>
            <template v-if="boxInformation.length">
                <draggable v-model="boxInformation" tag="div" handle=".handle" item-key="id" @change="changeDraggable">
                    <template #item="{ element, index }">
                        <div :key="index" class="d-flex mt-4">
                            <i class="icon-dragable f-25 op-02 handle" />
                            <div class="br-10 px-4 pt-3 pb-4 box-shadowBox" style="min-width: 812px;">
                                <div class="d-middle-bt">
                                    <main>
                                        <div class="d-middle">
                                            <p class="f-16 f-semibold">{{ element.nombre }}</p>
                                            <el-tooltip :content="boxInformation[index].descripcion" placement="right" effect="light" popper-class="wM-300px">
                                                <i class="icon-info-outline f-25 ps-2" />
                                            </el-tooltip>
                                        </div>
                                        <p class="f-15 f-light">Aplicar comisión mayor</p>
                                    </main>
                                    <div class="d-flex align-self-baseline gap-2">
                                        <iconActions @deleteTag="openModalComisionPlan(element.id, index)" @removeIcons="editComissionPlan(element.id)" />
                                        <el-tooltip :content="element.estado ? 'Inactivar' : 'Activar'" placement="bottom" effect="light">
                                            <el-switch
                                                v-model="element.estado"
                                                :active-value="1"
                                                :inactive-value="0"
                                                style="--el-switch-on-color: #29D884;"
                                                @change="changeState(element.id, element.estado)"
                                            />
                                        </el-tooltip>
                                        <numberBox :useNumber="element.contarRestaurantes" tooltipContent="Restaurantes seleccionados en este plan" />
                                    </div>
                                </div>
                                <div class="d-flex mt-4">
                                    <div class="w-50 ">
                                        <p class="f-16 f-medium mb-1">Comisión por venta</p>
                                        <div v-for="comission in element.comisionValoresVenta" :key="comission.id" class="d-middle-end gap-4">
                                            <p>${{ comission.desde }}</p>
                                            <p class="">-</p>
                                            <p class=" w-87px text-lg-end">${{ comission.hasta }}</p>
                                            <p class="w-80px text-end">{{ comission.comision }}%</p>
                                        </div>
                                    </div>
                                    <div class="bg-grey-lightest w-1px op-02 rounded-5 mx-3" style="border: 1px solid #8E989D" />
                                    <div class="w-50 ps-4">
                                        <p class="f-16px f-medium mb-2 ms-3">Comisión por orden</p>
                                        <div v-for="comission in element.comisionValoresOrden" :key="comission.id" class="d-middle-end gap-3">
                                            <p>{{ comission.desde }}</p>
                                            <p class="ms-2">-</p>
                                            <p class="w-55px text-lg-end">{{ comission.hasta }}</p>
                                            <p class="w-85px text-end" style="margin-left: 60px !important;">{{ comission.comision }}%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </draggable>
            </template>
            <p v-else class="f-15 mt-4">No hay planes de comisión creados.</p>
        </div>
    </div>
    <modal
        ref="modalRemoveComissionPlan"
        modalTitle="Eliminar plan de comisiones"
        action="Eliminar"
        :modalWidth="387"
        @buttonAction="deletePlan"
    >
        <template #default>
            <p class="f-14 px-3">Esta acción es permanente. ¿Seguro de que quieres hacerlo?</p>
        </template>
    </modal>
    <modal
        ref="openModalComissionPlanTwo"
        :modalWidth="447"
        modalTitle="Eliminar plan de comisiones"
        :seeButtonsBottom="false"
    >
        <template #default>
            <p class="f-14 f-light px-3">{{ boxInformation[i].contarRestaurantes }} restaurantes están usando el plan de comisión "{{ boxInformation[i].nombre }}" y no es posible eliminarlo.</p>
        </template>
    </modal>
</template>

<script setup>
import infoTopConfig from '../../../../../shared/components/infoTopConfig.vue';
import buttonAction from '../../../../../shared/components/buttonAction.vue';
import iconActions from '../../../../../shared/components/iconActions.vue';
import buttonSwitch from '../../../../../shared/components/buttonSwitch.vue';
import numberBox from '../../../../../shared/components/numberBox.vue';
import modal from '../../../../../shared/components/modal.vue'
import { useRouter, useRoute } from 'vue-router';
import { ref, onMounted } from 'vue';
import axios from 'axios';

const boxInformation = ref([])

let modalRemoveComissionPlan = null
let openModalComissionPlanTwo = null
const router = useRouter()
const route = useRoute()
let idi = null
let i = null
let position = null

onMounted(() => {
    getDatasComissionPlans()
})

async function changeDraggable(){
    let newArrayDraggable = boxInformation.value.map((e, index) => {
        return {
            id: e.id,
            posicion: index + 1
        }
    })
    let newObject = { comisiones:  newArrayDraggable}
    let draggable = await axios.post("api/parametrizacion/planes-de-comision/posicion", newObject)
}

async function changeState(id, state){
    let change = await axios.put(`api/parametrizacion/planes-de-comision/${id}/estado`, { estado: state })
    getDatasComissionPlans()
}

async function openModalComisionPlan(id, index){
    idi = id
    i = index
    modalRemoveComissionPlan.open()
}

async function deletePlan(){
    try {
        await axios.delete(`api/parametrizacion/planes-de-comision/${idi}`)
        getDatasComissionPlans()
    }
    catch (error) {
        openModalComissionPlanTwo.open()
    }
    modalRemoveComissionPlan.close()
}

function editComissionPlan(id){
    router.push({ path: `planesdecomision/${id}` })
}

const buttonActive = ref(true)

async function getDatasComissionPlans(){
    let getData = await axios.get("api/parametrizacion/planes-de-comision")
    boxInformation.value = getData.data?.data ?? []
    position = boxInformation.value.map((p) => p.posicion).filter((e) => e)
}

</script>

<style lang="scss" scoped>

</style>