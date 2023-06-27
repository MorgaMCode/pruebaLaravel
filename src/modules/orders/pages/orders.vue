<template>
    <section class="w-100 h-100">
        <div class="d-flex w-100 overflow-hidden" style="height: calc(100vh - 124px);">
            <section class="overflow-auto hidden-scroll" style="min-width: 398px;">
                <div v-for="(order, i) in informationStateOrders" :key="i" class=" overflow-auto hidden-scroll wf-398px pb-5" style="border-end: 2px solid #F3F1F1;">
                    <div class="w-398px h-44px py-2 d-middle ps-3 mb-2" style="border-bottom: 2px solid #F3F1F1;">
                        <p class="f-medium f-14">{{ order.fecha}} ({{ order.cantidad }})</p>
                    </div>
                    <template  v-for="orde in order.data" :key="orde">
                        <orders-to-go-route :ordenes="orde" :index="i" @toGoOrders="toGoOrderss" />
                    </template>
                </div>
            </section>
            <router-view
                :informationState="infoBasicOrde"
                :infoOrderUser="infoOrderUser"
                :infoDeliveryR="infoOrderDelivery"
                :reloadDeliveryOne="reloadDelivery"
                :collectDetail="collectDetail"
                :buttonActionConfirmTranfer="postConfirmTranfer"
                :instructionsR="getInstructionsData"
                :getHistoryDataOrder="getStatusOrderHistory"
                :informationProducts="informationProductsP"
            />
        </div>
    </section>
</template>

<script setup>
import { ref,onBeforeMount } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import axios from "axios";
import ordersToGoRoute from '../components/ordersToGoRoute.vue';



let props = defineProps({
    informationStateOrders:{
        type: Array,
        required: false,
        default: () => []
    }
})


onBeforeMount(()=>{
    getOrdersBasic(Number(route.params.id)) //datos generales de orden 
    getOrderUserInfo(Number(route.params.id)) //datos de el usuario
    getInfoDelivery(Number(route.params.id)) //datos de el delivery
    getInfoDetailCollect(Number(route.params.id))
    getInfoDelivery(Number(route.params.id)),
    getInfoDetailCollect(Number(route.params.id))
    getInstructions()
    
    
})

let router = useRouter()
let route = useRoute()
const numberRoute = ref(null)
const indice = ref(0)
const infoBasicOrde = ref([])
const infoOrderUser = ref({})
const infoOrderDelivery = ref({})
const collectDetail = ref({})
const getInstructionsData = ref({})
const getStatusOrderHistory = ref([])
const informationProductsP = ref([]) 

function toGoOrderss(id, index){
    getOrdersBasic(id) //datos generales de orden 
    getOrderUserInfo(id) //datos de el usuario
    getInfoDelivery(id) //datos de el delivery
    getInfoDetailCollect(id)
    getInstructions()
    
    
   
    
    router.push({ name: 'orders.actives', params: { id: id } })
    indice.value = index
}

async function postConfirmTranfer(a){
    try {
        const id = Number(route.params.id)
        const confirmar = a
        const response = await axios.post(`http://127.0.0.1:8000/api/ordenes/${13}/orden/${id}/detalle-cobro`,{ confirmar })
        collectDetail.value = response.data.data
    } catch (error) {
        console.error(error)
    }
}


async function getOrdersBasic(id){
    try {
        const response = await axios.get(`http://127.0.0.1:8000/api/ordenes/${13}/orden/${id}`)
        infoBasicOrde.value = response.data.data ?? []
    } catch (error) {
        console.error(error)
    }
}

async function getOrderUserInfo(id){
    try {
    let url = `http://127.0.0.1:8000/api/ordenes/${13}/orden/${id}/usuario`
        const response = await axios.get(url)
        infoOrderUser.value = response.data.data ?? []
    } catch (error) {
        console.error(error)
    }
}

 async function getInfoDelivery(id){
    try {
        const response = await axios.get(`http://127.0.0.1:8000/api/ordenes/${13}/orden/${id}/domiciliario`);
        infoOrderDelivery.value = response.data.data ?? {}
    } catch (error) {
        console.error(error);
    }
 }

 async function getInfoDetailCollect(id){
    try {
        const response = await axios.get(`http://127.0.0.1:8000/api/ordenes/:{13}/orden/${id}/detalle-cobro`);
        collectDetail.value = response.data.data ?? {}
    } catch (error) {
        console.error(error);
    }
 }
 async function reloadDelivery(i){
    try {

    const idOrden = Number(route.params.id);
    const idUserDelivery = i
        const response = await axios.post(`http://127.0.0.1:8000/api/ordenes/${13}/orden/${idOrden}/domiciliario`, { idUserDelivery })
        infoOrderDelivery.value = response.data.data ?? {}
    } catch (error) {
        console.error(error)
    }

 }
 async function getInstructions(){
    try {
        const id = Number(route.params.id)
        const response = await axios.get(`http://127.0.0.1:8000/api/ordenes/${13}/orden/${id}/instrucciones`)
        getInstructionsData.value = response.data.data ?? {}
        getStateOrderHistory()
    } catch (error) {
        console.error(error)
    }
}

 async function  getStateOrderHistory(){
    try {
        const id = Number(route.params.id)
        const response = await axios.get(`http://127.0.0.1:8000/api/ordenes/${13}/orden/${id}/historial-estado`)
        getStatusOrderHistory.value = response.data.data
        getInfoProducts()
    } catch (erro) {
        console.error(erro)
    }
 }

 async function getInfoProducts(){
    try {
        const id = Number(route.params.id)
        const response = await axios.get(`http://127.0.0.1:8000/api/ordenes/${13}/orden/${id}/productos`)
        console.log('products',response);
        informationProductsP.value = response.data.data
    
    } catch (error) {
        console.error(error);
    }
 }




</script>

<style lang="scss" scoped>




</style>