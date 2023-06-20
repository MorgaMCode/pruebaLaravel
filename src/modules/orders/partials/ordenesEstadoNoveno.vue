<template>
    <div class="p-3">
        <p class="f-medium f-16 mb-3">Historial de estados</p>
        <div v-for="(historial, i) in historialDeEstados" :key="i" class="position-relative">
            <div class="d-middle gap-2 mb-3 position-relative" style="z-index: 2;">
                <div class="d-middle-center rounded-circle wh-32" :class="[ estadosHistorial[historial.state].bg ]" >
                    <i class="f-25" :class="[estadosHistorial[historial.state].icon]" />
                </div>
                <div class="wm-180px">
                    <p class="f-medium f-14">{{ historial.text }}: <span class="f-light">{{ historial.date }}</span> </p>
                    <p class="f-light text-whitesmoke f-14">{{ historial.responsable }}</p>
                </div>
                <div class="d-middle gap-1 ms-4">
                    <div class="d-middle-center wh-18">
                        <i class="icon-clock f-25" />
                    </div>
                    <p class="f-light f-14">{{ historial.time }}</p>
                </div>
            </div>
            <div v-if="historialDeEstados[historialDeEstados.length - 1] !== historial" class="position-absolute h-32px w-2px" style="top: 30px; left: 14px; background-color: #b9bdc9;" />
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const historialDeEstados = ref([
    { state: 1, text: 'Orden creada', date: '5 Jul. 2022', time: '12:00 p.m.', responsable: null },
    { state: 2, text: 'Aceptada', date: '5 Jul. 2022', time: '12:02 p.m.', responsable: 'Por Jaime Gonzales' },
    { state: 3, text: 'Preparando', date: '5 Jul. 2022', time: '12:04 p.m.', responsable: null },
    { state: 4, text: 'En camino', date: '5 Jul. 2022', time: '12:04 p.m.', responsable: 'Por Pedro Castro' },
    { state: 5, text: 'Por entregar', date: '5 Jul. 2022', time: '12:30 p.m.', responsable: 'Por Pedro Castro' },
])

const estadosHistorial = {
    1: { bg: 'bg-orange', icon: 'icon-orders-outline' },
    2: { bg: 'bg-yellow', icon: 'icon-check' },
    3: { bg: 'bg-blueOscuro', icon: 'icon-cooking' },
    4: { bg: 'bg-blue-state-lightest', icon: 'icon-delivery' },
    5: { bg: 'bg-green-light', icon: 'icon-box-delivery' },
}

</script>

<style lang="scss" scoped>

.bg-blueOscuro{
    background-color: #00A3BF;
}

</style>