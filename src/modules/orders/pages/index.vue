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
import  qs  from 'qs';


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



const informationOrdersSelect = ref([])



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
    
}

function  filterOrder(search){
    getOrdersList(search)
}
const getOrdersList = async (buscarAlgo)=>{
    try {
        const response = await axios.get(`http://127.0.0.1:8000/api/ordenes/${13}?buscar=${buscarAlgo ?? ''}`)
        informationOrdersSelect.value = response.data.data
    } catch (error) {
         console.error(error)
    }
}

function clearOptions(){
    arrayOne.value = []
    arrayTwo.value = []
    arrayThree.value =[]
    tipoPedido.value = null
    estado.value = null
    chatActivo.value = null
    getOrdersList();
}




async function  saveOptions(){
    const params = {};


    if (chatActivo.value) {

        params.chatActivo = chatActivo.value    
    }
    if (estado.value) {

        params.estado = estado.value    
    }
    if (tipoPedido.value) {

        params.tipoPedido = tipoPedido.value    
    }

        try {
            const response = await axios.get(`http://127.0.0.1:8000/api/ordenes/13?${qs.stringify(params)}`);
            console.log('antes',informationOrdersSelect.value,length);
            informationOrdersSelect.value = response.data.data
           // console.log('despues',informationOrdersSelect.value);
        } catch (error) {
             console.error(error)
        }
}

</script>

<style lang="scss" scoped>

</style>