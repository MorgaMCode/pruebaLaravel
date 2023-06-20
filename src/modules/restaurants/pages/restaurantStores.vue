<template>
    <section>
        <div style="height: calc(100vh - 130px);">
            <header-store
                :menu-fixed="menuFixedStore"
                @toGoRouteHistory="goHistoryRoute"
                @restaurantActive="restaurantActive"
                @restaurantInactive="restaurantInactive"
                @deleteRestaurant="deleteRestaurant"
                @openModalObservations="openModalObservations"
                @seeModalClassification="seeModalClassification"
                ref="activateStoreFunction"
            />
            <div class="h-100 overflow-auto hidden-scroll" style="padding-bottom: 60px;">
                <div class="px-5 pt-4 d-flex j-between flex-wrap">
                    <div class="w-50 wm-400px">
                        <p class="f-22 f-bold">{{ informationDetails.categoria }}</p>
                        <div class="pt-2">
                            <div v-if="radioValueIndex !== null" class="d-middle gap-1 mt-3 cr-pointer">
                                <img src="/img/emptyState/woOrders.png" alt="imageMoney" class="wh-54" />
                                <div class="d-middle gap-2">
                                    <p class="select-plan f-14 text-whitesmoke4" @click="informationPlanComissionModal">{{ informationComissionSelected.planComision }}</p>
                                    <iconActions
                                        tooltipContentRemove="Historial"
                                        iconNameRemove="historial"
                                        @removeIcons="modalEdit"
                                        @deleteTag="modalHistoryComission"
                                    />
                                </div>
                            </div>
                            <div v-else class="d-middle gap-1 mt-3">
                                <img src="/img/emptyState/woOrders.png" alt="imageMoney" class="wh-54 rounded-circle" />
                                <div class="border px-3 py-2 br-8 cr-pointer" @click="openModalComissionPlan">
                                    <p class="f-14 f-medium">Seleccionar plan de comisión</p>
                                </div>
                            </div>
                            <div v-if="informacionClassification !== null" class="d-middle gap-3 mt-3">
                                <img :src="informacionClassificationModal.clasificacionIcono" alt="image-calsification" class="wh-50" />
                                <el-tooltip
                                    popper-class="wM-300px text-center"
                                    :content="informacionClassificationModal.clasificacion"
                                    placement="bottom"
                                    effect="light"
                                >
                                    <p class="select-plan cr-default f-14 f-whitesmoke4">{{informacionClassificationModal.planComision}}</p>
                                </el-tooltip>
                                <iconActions
                                    iconNameRemove="historial"
                                    tooltipContentRemove="Historial"
                                    @removeIcons="editClassification"
                                    @deleteTag="seeHistoryClassification"
                                />
                            </div>
                            <div v-else class="d-middle gap-1 mt-3">
                                <img src="/img/emptyState/categorias.png" alt="imageDiamount" class="wh-54" />
                                <div class="border px-3 py-2 br-8 cr-pointer" @click="openModalClasificationSelect">
                                    <p class="f-14 f-medium">Seleccionar clasificación</p>
                                </div>
                            </div>
                            <div class="d-middle gap-2 my-4">
                                <img src="/img/emptyState/woProduct.png" alt="imageBurguer" class="wh-50" />
                                <p class="text-whitesmoke4">Comida rápida</p>
                            </div>
                            <p class="f-16 f-medium">Valor mínimo de compra</p>
                            <div class="d-middle gap-2 my-2">
                                <img src="/img/emptyState/woDelivery.png" alt="handPay" class="wh-50 rounded-circle" />
                                <p class="text-whitesmoke4 f-14">${{ informationDetails.compraMinima }}</p>
                            </div>
                            <p class="f-16 f-medium">Órdenes programadas</p>
                            <div class="d-middle gap-1 my-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="wh-21" fill="yellow">
                                    <path d="M19.5,5.5V18.5H17.5V5.5H19.5M12.5,10.5V18.5H10.5V10.5H12.5M21,4H16V20H21V4M14,9H9V20H14V9M7,14H2V20H7V14Z" />
                                </svg>
                                <p class="f-14 text-whitesmoke pt-1">Demanda baja</p>
                                <svg xmlns="http://www.w3.org/2000/svg" class="wh-21" fill="orange">
                                    <path d="M19.5,5.5V18.5H17.5V5.5H19.5M21,4H16V20H21V4M14,9H9V20H14V9M7,14H2V20H7V14Z" />
                                </svg>
                                <p class="f-14 text-whitesmoke pt-1">Demanda media</p>
                                <svg xmlns="http://www.w3.org/2000/svg" class="wh-21" fill="red">
                                    <path d="M21,4H16V20H21V4M14,9H9V20H14V9M7,14H2V20H7V14Z" />
                                </svg>
                                <p class="f-14 text-whitesmoke pt-1">Demanda alta</p>
                            </div>
                            <p class="f-14 text-whitesmoke">No usar ordenes programadas</p>
                            <p class=" mt-1 f-14 text-whitesmoke">Dias de programacion: A partir del dia 3 hasta el dia 8</p>
                        </div>
                        <p class="f-24 f-bold mt-3">Tiendas</p>
                    </div>
                    <div class="w-50 text-end wM-445px">
                        <div class="d-middle-bt me-2">
                            <div class="text-center">
                                <img :src="informationDetails.fotoLogo" :alt="informationDetails.fotoLogo" class="wh-139" />
                                <p class="text-whitesmoke f-12">Logo del restaurante</p>
                            </div>
                            <div class="text-center">
                                <img :src="informationDetails.fotoBanner" alt="imageBurguerBarnner" class="w-273px h-139px" />
                                <p class="text-whitesmoke f-12">Banner</p>
                            </div>
                        </div>
                        <div class="d-middle gap-2 mt-4">
                            <p class="f-16 f-medium">Etiquetas del restaurante</p>
                            <iconActions :show-icon-two="false" @removeIcons="modalLabelEdit" />
                        </div>
                        <div class="d-flex gap-1 mt-3">
                            <div v-for="(selected, index) in restaurantLabelsSelected" :key="index" class="border-grey br-8 px-2 py-1">
                                <p class="f-14">{{ selected.etiqueta }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <boxRestaurantStore :boxInformation="informationBoxRestaurantStore" />
                </div>
            </div>
        </div>
        <buttonsRestaurantAprobbation
            @openSelectionApprove="openSelectionApprove(selectedComissionPlan)"
            @openObservationsModal="openObservationsModal"
            @openRejectedModal="openRejectedModal"
            @openRecoverRestaurantModal="openRecoverRestaurantModal"
        />
        <modalSelectComissionPlan
            ref="openComissionPlan"
            :informationArray="informationPlan"
            @comissionPlanSelected="selectedComissionPlan"
            @changeRadio="change"
            :contentButton="content"
        />
        <modalComissionHistory
            ref="openHistoryComission"
            :history="informationHistory"
        />
        <modal
            ref="openPlanInformation"
            :modalWidth="866"
            modalTitle="Plan de comisión"
            :seeButtonsBottom="false"
        >
            <div class="px-3 pt-2 pb-4">
                <planInformation
                    :arrayInformation="informationPlan"
                    :showHover="false"
                />
            </div>
        </modal>
        <modal
            ref="openModalClasffication"
            modalTitle="Clasificación del restaurante"
            :modalWidth="681"
            action="Aceptar"
            @buttonAction="saveModalClassification"
        >
            <div class="ps-4 pe-5 py-2">
                <p class="f-15 mb-2">Asigna una clasificación al restaurante para poder aceptar la solicitud.</p>
                <el-select v-model="valueSelectClasification" placeholder="Seleccionar">
                    <el-option
                    :label="restaurantClasification.planComision"
                    :value="restaurantClasification.planComision"
                    @click="selccionar(restaurantClasification)"
                />
                </el-select>
                <div v-if="informacionClassificationModal" class="d-middle gap-4 mt-3 me-4">
                    <img :src="informacionClassificationModal.clasificacionIcono" alt="" class="wh-96" />
                    <div>
                        <p class="f-16 f-bold pb-2">{{ informacionClassificationModal.clasificacion }}</p>
                        <p class="f-16">{{ informacionClassificationModal.restaurante }}</p>
                    </div>
                </div>
            </div>
        </modal>
        <modal
            ref="openModalClassificationHistory"
            :modal-width="737"
            modal-title="Historial clasificación"
            :seeButtonsBottom="false"
        >
            <div class="py-4 px-3">
                <el-table
                    :data="informationHistory"
                    style="width: 100%; font-size: 16px;"
                    size="large"
                    header-cell-class-name="bg-blue-light-table"
                >
                    <el-table-column width="50">
                        <template #default="scope">
                            <img :src="restaurantClasification.clasificacionIcono" alt="medal" class="wh-36" />
                        </template>
                    </el-table-column>
                    <el-table-column label="Clasificación" prop="planComision" sortable width="100" />
                    <el-table-column label="Fecha de asignación" sortable prop="fechaAsignacion" width="140" />
                    <el-table-column label="Responsable" sortable prop="responsable" width="140" />
                </el-table>
            </div>
        </modal>
        <modalLabelEditRestaurant
            ref="openModalLabelEdit"
            :arrayRestaurantLabels="restaurantLabels"
            :arrayRestaurantLabelsSelected="restaurantLabelsSelected"
            @saveLabels="updateLabels"
        />
        <modal ref="openObersations" :modal-width="633" modal-title="Observaciones" action="Enviar" >
            <div class="px-2 py-2">
                <p class="f-14 text-whitesmoke mb-2">
                    Escribe los cambios que el administrador debe hace en su restaurante para que este pueda ser
                    aceptado. Este mensaje se enviará directamente al administrador
                </p>
                <el-input v-model="inputObservations" placeholder="Agregar" type="textarea" :rows="4" />
            </div>
        </modal>
        <modal ref="openRejected" modal-title="Rechazar restaurante" :modal-width="633" action="Enviar">
            <div class="px-2 py-2">
                <div class="border-whitesmoke br-5 d-flex pe-5 py-2 mb-2" style="background-color: #97A0B01C;">
                    <i class="text-whitesmoke icon-info-outline f-24" />
                    <p class="f-14 text-whitesmoke f-bold">
                        Al rechazar el restaurante, no podrás gestionar las solicitudes de las tiendas creadas por este 
                    </p>
                </div>
                <p class="text-whitesmoke mb-3 f-14">Envía un correo al administrador, para saber las razones por las que su restaurante fue rechazado.</p>
                <el-input v-model="inputRejected" placeholder="Agregar" type="textarea" :rows="4" />
            </div>
        </modal>
        <modalRecoverRestaurant ref="recoverRestaurant" />
        <modal
            ref="activateRestaurant"
            modal-title="Activar restaurante"
            action="Activar"
            @buttonAction="activateStore"
        >
            <p class="f-14 f-light px-3 py-2">
                Al activar este restaurante los clientes podrán ver las tiendas y realizar pedidos,
                ¿Seguro de que quieres hacerlo?
            </p>
        </modal>
        <modal-inactivar ref="restaurantInactivate" />
        <modalDeleteRestaurants ref="openModalDelete" />
        <modalObservations ref="openObservations" :state="menuFixedStore?.estado" :content-state="modalStateBoxInformation" :informacion="informationObervation" />
        <modalClassification ref="openModalClassifcation" :tableta="tableClassification" :menuFixed="menuFixedStore" :percentage="classificationPercentage" />
    </section>
</template>

<script setup>
import headerStore from '../components/headerStore.vue';
import buttonsRestaurantAprobbation from '../components/buttonsRestaurantAprobbation.vue';
import modalClassification from '../partials/modalClassification.vue';
import modalObservations from '../partials/modalObservations.vue';
import modalDeleteRestaurants from '../partials/modalDeleteRestaurants.vue';
import modalInactivar from '../partials/modalInactivar.vue';
import modalSelectComissionPlan from '../partials/modalSelectComissionPlan.vue';
import modalComissionHistory from '../partials/modalComissionHistory.vue';
import modalLabelEditRestaurant from '../partials/modalLabelEditRestaurant.vue';
import modalRecoverRestaurant from '../partials/modalRecoverRestaurant.vue';
import iconActions from '../../../shared/components/iconActions.vue';
import modal from '../../../shared/components/modal.vue';
import planInformation from '../components/planInformation.vue';
import boxRestaurantStore from '../partials/boxRestaurantStore.vue';
import buttonAction from '../../../shared/components/buttonAction.vue';
import { ref, onMounted, computed } from 'vue';
import { useRoute, useRouter } from "vue-router";
import axios from 'axios';

let route = useRoute()
let router = useRouter()
const activateStoreFunction = ref()
const openModalClassifcation = ref()
const openObservations = ref()
const openModalDelete = ref()
const restaurantInactivate = ref()
const openComissionPlan = ref()
const activateRestaurant = ref()
const radioValueIndex = ref(null)
const idComission = ref(null)
const indexRadio = ref(null)
const openHistoryComission = ref()
const openPlanInformation = ref()
const openModalClasffication = ref()
const openModalClassificationHistory = ref()
const openModalLabelEdit = ref()
const openObersations = ref()
const openRejected = ref()
const recoverRestaurant = ref()
const content = ref()
const valueSelectClasification = ref('')
const informacionClassificationModal = ref(null)
const informacionClassification = ref(null)
const modalStateBoxInformation = ref({})
const informationObervation = ref()
let seeComissionPlan = false
let inputObservations = ''
let inputRejected = ''


onMounted(() => {
    datasDetailsGet()
    getDatasRestaurant()
})

let props = defineProps({
    menuFixedStore:{
        type: Object,
        required: false,
        default: () => {}
    }
})

const informationBoxRestaurantStore = ref([])

async function getDatasRestaurant(){
    let getDatas = await axios.get(`api/restaurantes/${route.params.id}/estado-observacion`)
    modalStateBoxInformation.value = getDatas.data?.data ?? {}
    let informationAmazon = await axios.get(modalStateBoxInformation.value.observaciones)
    informationObervation.value = informationAmazon.data
}

async function datasDetailsGet(){
    let datasDetails = await axios.get(`api/restaurantes/${route.params.id}/detalle`)
    informationDetails.value = datasDetails.data?.data ?? {}
    restaurantLabelsSelected.value = informationDetails.value.etiquetas

    let infomrationStore = await axios.get(`api/restaurantes/${route.params.id}/tiendas`)
    informationBoxRestaurantStore.value = infomrationStore.data?.data ?? []
}

function activateStore(){
    activateStoreFunction.value.activate()
}

function openModalObservations(){
    openObservations.value.open()
}

function seeModalClassification(){
    openModalClassifcation.value.open()
}

function goHistoryRoute(){
    router.push({ name: 'restaurant.seventySeven.stores.history' })
}

const informationDetails = ref({})

const informationPlan = ref([])
const informationComissionSelected = ref({})
const stateObservation = ref({})

const informationHistory = ref([])

const restaurantClasification = ref({})

const classificationHistoryTable = ref([
    {
        id: 1,
        image: '/img/trash/medalSilver.png',
        clasificacion: 'Silver',
        fechaDeAsignacion: '18 Ago. 2022',
        responsable: 'Jairo García'

    },
    {
        id: 2,
        image: '/img/trash/medalGold.png',
        clasificacion: 'Gold',
        fechaDeAsignacion: '18 Ago. 2022',
        responsable: 'Carlos Correa'

    },
    {
        id: 3,
        image: '/img/trash/medalVip.png',
        clasificacion: 'VIP',
        fechaDeAsignacion: '4 Ene. 2022',
        responsable: 'María Teresa Perez'

    }
])

const tableClassification = ref([
    {
        item: 'Faltaron algunos ítems',
        voto: 1,
    },
    {
        item: 'Pésima calidad',
        voto: 1,
    },
    {
        item: 'Mala presentación',
        voto: 3,
    },
    {
        item: 'Buena presentación',
        voto: 10,
    }
])

let classificationPercentage = [
    {
        id: 1,
        position: 5,
        percentage: 10
    },
    {
        id: 2,
        position: 4,
        percentage: 6
    },
    {
        id: 3,
        position: 3,
        percentage: 0
    },
    {
        id: 4,
        position: 2,
        percentage: 1
    },
    {
        id: 5,
        position: 1,
        percentage: 3
    }
]

const restaurantLabels = ref([])

const restaurantLabelsSelected = ref([])

function deleteRestaurant(){
    openModalDelete.value.open()
}

function restaurantInactive(){
    restaurantInactivate.value.open()
}

function restaurantActive(state){
    activateRestaurant.value.open()
}

function openRecoverRestaurantModal(){
    recoverRestaurant.value.open()
}

function openRejectedModal(){
    openRejected.value.open()
}

function openObservationsModal(){
    openObersations.value.open()
}

function openSelectionApprove(funcionName){
    seeComissionPlan = true
    openModalComissionPlan()
}

async function updateLabels(array){
    let findId = array.map((i) => i.id)
    await axios.post(`api/restaurantes/${route.params.id}/etiquetas`, { etiquetas: findId })
    openModalLabelEdit.value.close()
    restaurantLabelsSelected.value = array
}

async function modalLabelEdit(){
    let getLabels = await axios.get('api/select/etiquetas')
    restaurantLabels.value = getLabels.data?.data ?? []
    openModalLabelEdit.value.open()
}

function seeHistoryClassification(){
    openModalClassificationHistory.value.open()
}

function editClassification(){
    openModalClasffication.value.open()
}

function saveModalClassification(){
    if(valueSelectClasification.value !== ''){
        informacionClassification.value = informacionClassificationModal.value
        openModalClasffication.value.close()
    }
}

async function selccionar(objecto){
    let datasClassification = await axios.get(`api/restaurantes/${route.params.id}/comisiones`)
    informationHistory.value = datasClassification.data?.data ?? []
    informacionClassificationModal.value = objecto
}

function informationPlanComissionModal(){
    openPlanInformation.value.open()
}

async function openModalClasificationSelect(){
    let getDatasClasification = await axios.post(`api/restaurantes/${route.params.id}/clasificacion`, { idClasificacion: informationDetails.value.idClasificacion })
    restaurantClasification.value = getDatasClasification.data?.data ?? []
    openModalClasffication.value.open()
}

function modalHistoryComission(){
    openHistoryComission.value.open()
}

function modalEdit(){
    content.value = 'Guardar'
    openComissionPlan.value.open()
}

async function selectedComissionPlan(radio){
    if(radio !== null){
        radioValueIndex.value = radio
        let updateComision = await axios.post(`api/restaurantes/${route.params.id}/comision`, { idComision: idComission.value })
        informationComissionSelected.value = updateComision.data?.data ?? []
        let datasClassification = await axios.get(`api/restaurantes/${route.params.id}/comisiones`)
        informationHistory.value = datasClassification.data?.data ?? []
        openComissionPlan.value.close()
    }
    if(seeComissionPlan){
        openModalClasificationSelect()
    }
}

function change(id){
    idComission.value = id
}

async function openModalComissionPlan(){
    let datasComissionPlan = await axios.get(`api/restaurantes/${route.params.id}/plan-comision`)
    informationPlan.value = datasComissionPlan.data?.data ?? []
    openComissionPlan.value.open()
}

</script>

<style lang="scss" scoped>
.select-plan{
    &:hover{
        text-decoration: underline;
        color: #333333;
    }
}

</style>