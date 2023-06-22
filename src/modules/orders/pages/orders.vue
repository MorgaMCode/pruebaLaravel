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
                :informationProducts="informationProducts"
            />
        </div>
    </section>
</template>

<script setup>
import { ref, onBeforeMount } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import axios from "axios";
import ordersToGoRoute from '../components/ordersToGoRoute.vue';


let props = defineProps({
    informationStateOrders:{
        type: Array,
        required: false,
        default: () => []
    },
    informationProducts:{
        type: Array,
        required: false,
        default: () => []
    }
})


let router = useRouter()
let route = useRoute()
const numberRoute = ref(null)
const indice = ref(0)

function toGoOrderss(id, index){
    getOrdersBasic(id)
    router.push({ name: 'orders.actives', params: { id: idi } })
    indice.value = index
}

onBeforeMount(async () => {
    getOrdersBasic(Number(route.params.id))
})

const infoBasicOrde = ref([])
const getOrdersBasic = async (id)=>{
    try {
    let url = `http://127.0.0.1:8000/api/ordenes/${13}/orden/${id}`
          const response = await axios.get(url)
          infoBasicOrde.value = response.data.data
        console.log(  response.data.data,'123' )
    } catch (error) {
        console.error(error)
    }
}




</script>

<style lang="scss" scoped>




</style>