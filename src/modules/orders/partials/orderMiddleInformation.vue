<template>
    <section>
        <div>
            <ordenesEstadoPrincipalArriba :state="state" />
            <ordenesEstadoPrimero v-if="state?.state === 1" />
            <ordenesEstadoSegundo v-else-if="state?.state !== 11" 
            :infoBasicOrder="state" />
        </div>
        <div v-if="state?.state === 1">
            <ordenesEstadoSegundo />
        </div>
        <div>
            <ordenesEstadoTercero />
        </div>
        <div>
            <ordenesEstadoCuarto />
        </div>
        <div>
            <ordenesEstadoQuinto />
        </div>
        <div>
            <ordenesEstadoSexto />
        </div>
        <div>
            <ordenesEstadoSeptimo />
        </div>
        <div>
            <ordenesEstadoOctavo />
        </div>
        <div v-if="state?.state !== 1">
            <ordenesEstadoPrimero />
        </div>
        <div>
            <ordenesEstadoNoveno />
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


let props = defineProps({
    state:{
        type: Object,
        required: false,
        default: () => {}
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