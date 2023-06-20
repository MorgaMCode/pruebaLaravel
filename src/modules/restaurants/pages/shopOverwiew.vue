<template>
    <section class="h-100">
        <div class="pb-5" style="height: calc(100vh - 130px);">
            <headerStore
                :show-arrow="true"
                :menu-fixed="informationStore"
                @toGoRouteBack="routeBack"
                @toGoRouteHistory="goHistoryState(informationStore)"
                @restaurantActive="seeModalActivate"
                @deleteRestaurant="deleteRestaurant"
                @openModalObservations="openModalObservations"
                ref="activateFunction"
            />
            <div class="d-middle flex-wrap gap-4 py-4 px-5">
                <router-list :list="storeTypes" name-route="nameRoute">
                    <template #default="{ item, selected }">
                        <div
                            class="hoverStoreTypes d-middle cr-pointer bg-blue-lightest px-4 py-2 br-5"
                            :class="{ 'routeSelected cr-default' : selected, 'paddingWarning' : item.warning}"
                            @click="toGoRouteInformation(item.nameRoute)"
                        >
                            <p class="f-14 text-grey-light" :class="{ 'text-blue' : selected }">{{ item.title }}</p>
                            <i v-if="item.warning" fill="red" class="icon-alerta text-orange f-23" />
                        </div>
                    </template>
                </router-list>
            </div>
            <router-view :informationStoreContact="informationStore" />
        </div>
        <buttons-restaurant-aprobbation
            v-if="route.name === 'restaurant.seventySeven.stores.history.informacion'"
            @openSelectionApprove=""
            content-advertence="La tienda está esperando tu aprobación para empezar a vender."
        />
    </section>
    <modal ref="activateRestaurant" modal-title="Activar tienda" action="Activar" @button-action="activateStore" >
        <p class="f-light f-14 px-3 py-2">Al activar esta tienda los clientes podrán ver el contenido de la tienda y realizar pedidos, ¿Seguro de que quieres hacerlo?</p>
    </modal>
    <modalDeleteRestaurants ref="openModalDelete" />
    <modalObservations ref="openObservationsModal" :state="informationStore.estado" :content-state="stateStoreObservation" :informacion="informrationObservationStateStore" />
</template>

<script setup>
import modal from '../../../shared/components/modal.vue';
import modalObservations from '../partials/modalObservations.vue';
import modalDeleteRestaurants from '../partials/modalDeleteRestaurants.vue';
import buttonsRestaurantAprobbation from '../components/buttonsRestaurantAprobbation.vue';
import routerList from '../../../shared/components/routerList.vue';
import headerStore from '../components/headerStore.vue';
import { useRoute, useRouter } from 'vue-router';
import { ref, onMounted } from 'vue';
import axios from 'axios';

let route = useRoute()
let router = useRouter()

const openModalDelete = ref()
const activateRestaurant = ref()
const activateFunction = ref()
const openObservationsModal = ref()
const informationStore = ref({})
const stateStoreObservation = ref({})
const informrationObservationStateStore = ref()

onMounted(() => {
    stateStore()
})

let storeTypes = [
    {
        title: 'Información',
        nameRoute: 'restaurant.seventySeven.stores.history.informacion',
        warning: false
    },
    {
        title: 'Geocercas',
        warning: true
    },
    {
        title: 'Tipos de entrega',
        nameRoute: 'restaurant.seventySeven.stores.history.delivery.types',
        warning: true,
    },
    {
        title: 'Mesas',
        warning: true,
        nameRoute: 'restaurant.seventySeven.stores.history.tables'
    },
    {
        title: 'Perfil',
        warning: true,
        nameRoute: 'restaurant.seventySeven.stores.history.profile'
    }
]

async function stateStore(){
    let information = await axios.get(`api/restaurantes/${route.params.id}/tiendas/${route.params.idStore}`)
    informationStore.value = information.data?.data ?? {}
    if(informationStore.value.tieneObservacion !== 0){
        let storeState = await axios.get(`api/restaurantes/${route.params.id}/tiendas/${route.params.idStore}/estado-observacion`)
        stateStoreObservation.value = storeState.data?.data ?? []
        let informationStoreState = await axios.get(stateStoreObservation.value.observaciones)
        informrationObservationStateStore.value = informationStoreState.data
    }
}

function openModalObservations(){
    openObservationsModal.value.open()
}

function deleteRestaurant(){
    openModalDelete.value.open()
}

function activateStore(){
    activateFunction.value.activate()
}

function seeModalActivate(){
    activateRestaurant.value.open()
}

function seeCalification(){
    openModalClassification.value.open()
}

function goHistoryState(i){
    router.push({ name: 'restaurant.seventySeven.stores.stateHistory', params: { idStore:  i.id} })
}

function routeBack(){
    router.push({ name: 'restaurant.seventySeven.stores' })
}

function toGoRouteInformation(route){
    router.push({ name: route })
}

</script>

<style lang="scss" scoped>
.hoverStoreTypes{
    transition: .3s all;
    &:hover{
        background-color: var(--gray-light) !important;
    }
    &.routeSelected{
        background-color: var(--blue-state-lightest) !important;
        color: var(--blue-state) !important;
    }
    &.paddingWarning{
        padding: 3.5px 1.5rem 3.5px 1.5rem !important;
    }
}

</style>