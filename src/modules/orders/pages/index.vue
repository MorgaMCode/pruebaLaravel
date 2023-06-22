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
        <div class="d-middle-end gap-2 h-68px px-3" style="border-bottom: 2px solid rgb(236 236 236);">
            <div class="d-middle-bt w-100">
                <div class="w-350px">
                    <el-input v-model="search" placeholder="Busqueda" @input="filterOrder(search)" :suffix-icon="Search" />
                </div>
                <div class="d-middle gap-3">
                    <template v-for="(title, index) in datas" :key="index">
                        <el-popover
                            placement="bottom"
                            trigger="click"
                        >
                        <template #reference>
                            <div class="d-middle border rounded-pill ps-3">
                                <p>{{ title.title }}</p>
                                <i class="icon-chevron-down f-25" />
                            </div>
                        </template>
                            <template #default>
                                <template v-for="(option, i) in title.options" :key="i">
                                    <div
                                        class="icon-hover-blue cr-pointer p-2 br-5"
                                        :class="optionSelectedAll[index].includes(i) ? 'bg-blue-state-lightest': ''"
                                        style="transition: 0.3s ease-in-out;"
                                        @click="saveData(index,option.value, i)"
                                    >
                                        <p class="text-black">{{ option.optionOne }}</p>
                                    </div>
                                </template>
                            </template>
                        </el-popover>
                    </template>
                    <button class="btn bg-general text-white w-120px"  @click="saveOptions()">Filter</button>
                    <div class="border br-8" @click="clearOptions">
                        <i class="icon-undu f-25" />
                    </div>
                </div>
            </div>
        </div>
        
        <div v-if="informationOrdersSelect.length   " class="d-flex overflow-hidden w-100">
            <router-view
                :informationStateOrders="informationOrdersSelect"
                :informationProducts="informationProductsOrders"
            />
        </div>
        <div v-else class="d-middle-center flex-column h-100 w-100 ">
            <img src="  /img/emptyState/woQueryResults.png" alt="" width="300" height="300" >
            <p >No se encontraron resultados para tu búsqueda</p>
        </div>
    </section>
</template>

<script setup>
import { toRefs, ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from "axios";
import { onBeforeMount } from 'vue';
import { Search } from '@element-plus/icons-vue'


const search = ref('')
const optionSelectedAll = ref([[],[],[]])
const chatActivo = ref(null)
const estado = ref(null)
const tipoPedido = ref(null)

const [ arrayOne , arrayTwo, arrayThree ] = toRefs(optionSelectedAll.value)

let router = useRouter()
onBeforeMount(() => {
    getOrdersList()
})

const datas = ref([
    {
        title: 'Todas',
        options: [
            { id: 50, optionOne: 'Todas' },
            { id: 51, optionOne: 'Con chat activo', value: 1 },
        ]
    },
    {
        title: 'Estado',
        options: [
            { id: 52,  optionOne: 'Creado', value: 11 },
            { id: 53,  optionOne: 'Aceptado', value: 12 },
            { id: 54,  optionOne: 'Preparado/Alistado', value: 13 },
            { id: 55,  optionOne: 'Enviado', value: 15 },
        ]
    },
    {
        title: 'Tipo de entrega',
        options: [
            { id: 56,  optionOne: 'Domicilio', value: 1 },
            { id: 57,  optionOne: 'Recoger', value: 2 },
            { id: 58,  optionOne: 'Mesa', value: 3 }
        ]

    },
])

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

function saveData(index,option, i){

    if (index == 0) {
        arrayOne.value = []
        arrayOne.value.push(i)
        chatActivo.value = option
        
    }

    if (index == 1) {
        arrayTwo.value = []
        arrayTwo.value.push(i)
        estado.value =  option
        
    }
    if (index == 2) {
        arrayThree.value = []
        arrayThree.value.push(i)
        tipoPedido.value = option 
        
    }
    
    console.log('Estos los datos guardados: ', optionSelectedAll.value);
}

function  filterOrder(search){
    getOrdersList(search)
}
const getOrdersList = async (buscarAlgo)=>{
    try {
        const response = await axios.get(`http://127.0.0.1:8000/api/ordenes/13?buscar=${buscarAlgo ?? ''}`)
        console.log(response.data.data)
        informationOrdersSelect.value = response.data.data
    } catch (error) {
         console.error(error)
    }
}

function clearOptions(){
    arrayOne.value = []
    arrayTwo.value = []
    arrayThree.value =[]
}
async function  saveOptions(){
    if(chatActivo.value || estado.value || tipoPedido.value){
        try {
            const response = await axios.get(`http://127.0.0.1:8000/api/ordenes/13?chatActivo=${chatActivo.value ?? false}&estado=${estado.value}&tipoPedido=${tipoPedido.value}`);
            // const response = await axios.get(`http://127.0.0.1:8000/api/ordenes/13`,{chatActivo:chatActivo.value, estado:estado.value, tipoPedido:tipoPedido.value})
            console.log(response.data.data)
            informationOrdersSelect.value = response.data.data
        } catch (error) {
             console.error(error)
        }
    }
   
    
    console.log(optionSelectedAll.value);
}

</script>

<style lang="scss" scoped>

</style>