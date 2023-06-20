<template>
    <section class="w-100 h-100">
        <div class="d-flex w-100 overflow-hidden" style="height: calc(100vh - 124px);">
           <section class="overflow-auto hidden-scroll" style="min-width: 398px;">
            <div v-for="(order, i) in informationStateOrders" :key="i" class="h-100 overflow-auto hidden-scroll wf-398px pb-5" style="border-end: 2px solid #F3F1F1;">
                <div class="w-398px h-44px py-2 d-middle ps-3 mb-2" style="border-bottom: 2px solid #F3F1F1;">
                    <p class="f-medium f-14">{{ order.fecha}} ({{ order.cantidad }})</p>
                </div>
                <template  v-for="orde in order.data">
                    <orders-to-go-route :ordenes="orde" :index="i" @toGoOrders="toGoOrderss" />
                </template>
            </div>
           </section>
            <router-view
                :informationState="infoBasicOrde.find((ele) => ele.id === Number(route.params.id))"
                :informationProducts="informationProducts"
            />
        </div>
    </section>
</template>

<script setup>
import ordersToGoRoute from '../components/ordersToGoRoute.vue';
import { useRouter, useRoute } from 'vue-router';
import { onBeforeMount } from 'vue';
import { ref } from 'vue';
import axios from "axios";


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

function toGoOrderss(idi, index){
    router.push({ name: 'orders.actives', params: { id: idi } })
    console.log(route.params.id)
    indice.value = index
    getOrdersBasic()
}

onBeforeMount(async () => {
    getOrdersBasic()
})

const infoBasicOrde = ref([])
const getOrdersBasic = async ()=>{
    try {
    let url = `http://127.0.0.1:8000/api/ordenes/${13}/orden/${Number(route.params.id)}`
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