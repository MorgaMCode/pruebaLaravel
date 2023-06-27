<template>
    <section>
        <div>
            <ordenesEstadoPrincipalArriba :state="state" />
            <ordenesEstadoPrimero   :datas="state.historialCedida" />
            <ordenesEstadoSegundo v-if="state?.state !== 11" :infoBasicOrder="state" />
        </div>
        <div>
            <ordenesEstadoTercero :infoUser="dataInfoUser" />
        </div>
        <div>
            <ordenesEstadoCuarto  />
        </div>
        <div v-if="dataInfoDelivery.idUserDelivery">
            <ordenesEstadoSexto  :infoDelivery="dataInfoDelivery"  :reloadDeliveryThree="reloadDeliveryTwo" />
        </div>
        <div v-else >
            <ordenesEstadoQuinto  :reloadDeliveryThree="reloadDeliveryTwo" />
        </div>
        <div >
            <ordenesEstadoSeptimo :infoDetail="collectDetail" :envioCobro="buttonAction" />
        </div>
        <div>
            <ordenesEstadoOctavo :instructions="instructions" />
        </div>
        <div >
            <ordenesEstadoPrimero />
        </div>
        <div>
            <ordenesEstadoNoveno :dataHistory="getStatusOrderHistory"/>
        </div>
    </section>
</template>

<script setup>
import ordenesEstadoPrincipalArriba from './ordenesEstadoPrincipalArriba.vue';
import ordenesEstadoPrimero from './ordenesEstadoPrimero.vue';
import ordenesEstadoSegundo from './ordenesEstadoSegundo.vue';
import ordenesEstadoTercero from './ordenesEstadoTercero.vue';
import ordenesEstadoCuarto from './ordenesEstadoCuarto.vue';
import ordenesEstadoQuinto from './ordenesEstadoQuinto.vue'
import ordenesEstadoSexto from './ordenesEstadoSexto.vue';
import ordenesEstadoSeptimo from './ordenesEstadoSeptimo.vue';
import ordenesEstadoOctavo from './ordenesEstadoOctavo.vue';
import ordenesEstadoNoveno from './ordenesEstadoNoveno.vue'


const emit = defineEmits(['postDeliveryGrandFather']);

let props = defineProps({
    state:{
        type: Object,
        required: false,
        default: () => {}
    },
    dataInfoUser:{
        type: Object,
        required: false,
        default: () => {}
    },
    dataInfoDelivery:{
        type: Object,
        required: false,
        default: () => {}
    },
    reloadDeliveryTwo:{
        type:Function
    },
    collectDetail:{
        type:Object,
        required: false,
        default: () => {}
    },
    buttonAction:{
        type:Function
    },
    instructions:{
        type:Object
    },
    getStatusOrderHistory:{
        type:Array
    }
})



</script>


<style lang="scss" scoped>
section{
    div{
        border-bottom: 3px solid #e1e1e1;
    }
}


</style>