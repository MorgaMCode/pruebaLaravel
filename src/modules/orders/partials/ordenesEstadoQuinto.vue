<template>
    <div  class="p-3" >
        <div class="d-middle gap-3 cr-pointer" @click="openModalAsignarDomiciliario">
            <div class="d-middle-center wh-32 rounded-circle bg-blue-state-lightest">
                <i class="icon-delivery text-blue f-25" />
            </div>
            <p class="f-medium f-16">Asignar domiciliario</p>
            <i class="icon-chevron-right ms-auto text-orange f-25"/>
        </div>
    </div>
    <modalDomiciliarioAsignar ref="refModalDomiciliarioAsignar"
        :reloadDeliveryFour="reloadDeliveryThree"
        :domiciliarios="listDelivery"
    />
</template>

<script setup>
import { ref } from 'vue';
import  axios  from 'axios'

import modalDomiciliarioAsignar from './modalDomiciliarioAsignar.vue';


const refModalDomiciliarioAsignar = ref()
const listDelivery = ref([])

const props = defineProps({
    reloadDeliveryThree:{
        type:Function
    }
})
const domiciliariosDisponibles = ref([
    { photo: '/img/emptyState/woUsers.jpg', name: 'Daniel Correa', state: 1, id: '123465', pedidosAsignados: 7 }
])



   


async function openModalAsignarDomiciliario(){
    refModalDomiciliarioAsignar.value.open()
    try {
        const response = await axios.get(`http://127.0.0.1:8000/api/domiciliarios`)
        listDelivery.value = response.data.data ?? []
        console.log('list delivery',response.data.data);

   } catch (error) {
     console.error(error)
   }
   
}



</script>

<style lang="scss" scoped>

</style>