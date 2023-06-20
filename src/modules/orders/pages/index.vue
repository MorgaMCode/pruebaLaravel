<template>
    <section class="d-flex-column w-100">
        <div class="d-middle-end gap-2 h-68px px-5" style="border-bottom: 2px solid rgb(236 236 236);">
            <div class="d-middle border item-with-hover cr-pointer br-8 h-36px pe-3 ps-2">
                <div class="d-middle-center wh-24">
                    <i class="icon-historial f-25" />
                </div>
                <p class="f-medium f-14">Historial de órdenes</p>
            </div>
            <el-tooltip content="Ver tablero" placement="bottom" effect="light">
                <div class="d-middle-center border item-with-hover cr-pointer wh-36 br-8" @click="router.push({ name: 'orders.board' })">
                    <i class="icon-board f-25" />
                </div>
            </el-tooltip>
        </div>
        <div class="d-flex overflow-hidden w-100">
            
            <router-view 
            :informationStateOrders="informationOrdersSelect"
            :informationProducts="informationProductsOrders" />
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from "axios";
import { onBeforeMount } from 'vue';


let router = useRouter()
onBeforeMount(() => {
    getOrdersList()
})

// const informationOrdersSelect = ref([])
const informationOrdersSelect = ref([])

const informationProductsOrders = ref([
    {
        img: '/img/trash/burguerKiller.png',
        title: 'Hamburguesa The Killers',
        oferta: 'x 2',
        precioOferta: '20.000',
        precioNormal: '25.000',
        productoCaracteristicas: [
            {
                title: 'Personaliza tu Hamburguesa',
                caracteristicas: [
                    { text: 'Queso americano gratinado', numberOferta: '1' }
                ],
            },
            {
                title: 'Elige tus extras',
                caracteristicas: [
                    { text: 'Queso americano gratinado', price: '2.000', numberOferta: '2' },
                    { text: 'Tocineta ahumada', price: '3.000', numberOferta: '1' },
                ],
            }
        ]
    },
    {
        img: '/img/trash/burguerKiller.png',
        title: 'Hamburguesa Clásica Rock',
        oferta: 'x 1',
        precioOferta: '20.000',
        precioNormal: '26.000',
        productoCaracteristicas: []
    },
    {
        img: '/img/trash/kornOasis.png',
        title: 'Korn Oasis',
        oferta: 'x 1',
        precioOferta: 0,
        precioNormal: '28.300',
        productoCaracteristicas: [
        {
                title: 'Elige tus salsas Extra',
                caracteristicas: [
                    { text: 'Queso americano gratinado', numberOferta: '2' },
                    { text: 'Tocineta ahumada', numberOferta: '1' },
                ],
            }
        ]
    },
])

const getOrdersList = async ()=>{
    try {
        const response = await axios.get('http://127.0.0.1:8000/api/ordenes/1')
        informationOrdersSelect.value = response.data.data
        console.log( informationOrdersSelect.value,'bb')
    console.log(  response.data.data )
    } catch (error) {
        console.error(error)
    }
}

</script>

<style lang="scss" scoped>

</style>