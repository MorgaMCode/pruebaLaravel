<template>
    <div class="p-3" >
        <p class="f-medium f-16 mb-3">Historial de estados</p>
        <div v-for="(historial, i) in dataHistory" :key="i" class="position-relative">
            <div class="d-middle gap-2 mb-3 position-relative" style="z-index: 2;">
                <div class="d-middle-center rounded-circle wh-32"  :class="historialDeEstados[historial.estado]?.bg"
                >
                    <i class="f-25" :class="historialDeEstados[historial.estado]?.icon"/>
                </div>
                <div class="wm-180px">
                    <p class="f-medium f-14">{{ historialDeEstados[historial.estado]?.text }}: <span class="f-light">{{ historial?.fecha }}</span> </p>
                    <p class="f-light text-whitesmoke f-14">{{  historial?.por }}</p>
                </div>
                <div class="d-middle gap-1 ms-4">
                    <div class="d-middle-center wh-18">
                        <i class="icon-clock f-25"  />
                    </div>
                    <p class="f-light f-14"> {{ historial?.hora }}</p>
                </div>
            </div>
            <div v-if="i !== dataHistory.length-1" class="position-absolute h-32px w-2px" style="top: 30px; left: 14px; background-color: #b9bdc9;" />
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';


const props = defineProps({
    dataHistory:{
        type:Array
    }
})

const historialDeEstados = ref({
    11: { text: 'Orden creada',bg: 'bg-orange', icon: 'icon-orders-outline'  },
    12:{  text: 'Aceptada',bg: 'bg-yellow', icon: 'icon-check' },
    13:{  text: 'Preparando', bg: 'bg-blueOscuro', icon: 'icon-cooking'  },
    14:{  text: 'En camino', bg: 'bg-blue-state-lightest', icon: 'icon-delivery'},
    15:{  text: 'Entregado', bg: 'bg-gray-light', icon: 'icon-delivered'},
    21:{  text: 'Por entregar', bg: 'bg-green-light', icon: 'icon-box-delivery'},
    22:{  text: 'Reclamo', bg: 'bg-green-light', icon: 'icon-box-delivery'},
    23:{  text: 'Reclamo terminado', bg: 'bg-green-light', icon: 'icon-box-delivery'},
    24:{  text: 'Soporte', bg: 'bg-green-light', icon: 'icon-box-delivery'},
    25:{  text: 'Soporte terminado', bg: 'bg-green-light', icon: 'icon-box-delivery'},
    31:{  text: 'Timeout creado', bg: 'bg-green-light', icon: 'icon-box-delivery'},
    32:{  text: 'Rechazado', bg: 'bg-red-badge', icon: 'icon-close-2'},
    33:{  text: 'Cancelado tienda', bg: 'bg-green-light', icon: 'icon-close'},
    34:{  text: 'Cancelado cliente', bg: 'bg-green-light', icon: 'icon-box-delivery'},
    Cedido:{ text: 'cedido', bg: 'bg-green-light', icon: 'icon-change'},
})




</script>

<style lang="scss" scoped>

.bg-blueOscuro{
    background-color: #00A3BF;
}

</style>