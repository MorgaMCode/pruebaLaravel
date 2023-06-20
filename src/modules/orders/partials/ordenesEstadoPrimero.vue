<template>
    <div class="d-flex flex-column gap-4">
        <div class="d-middle-bt px-3 py-2">
            <div class="d-middle-center wh-32 bg-whitesmoke3 rounded-circle">
                <i class="icon-change f-25" />
            </div>
            <div class="w-100 ms-2">
                <div class="d-middle-bt me-5">
                    <p class="f-medium f-14">Cedida de: <span class="f-light text-whitesmoke">"Sotomayor"</span></p>
                    <div class="d-middle">
                        <i class="icon-clock f-25" />
                        <p class="f-light f-14">12:05 p.m.</p>
                    </div>
                </div>
                <p class="f-light text-whitesmoke f-14">5 Jul. 2022, por Jaime Gonzales</p>
            </div>
            <el-tooltip content="Ver historial" placement="bottom" effect="light">
                <div class="wh-32 d-middle-center icon-hover-blue cr-pointer rounded-circle" @click="openModalHistorial">
                    <i class="icon-historial f-25" />
                </div>
            </el-tooltip>
        </div>
    </div>
    <modalHistorialOrden ref="refModalHistorial" :historial="informationHistorialDeOrden" />
</template>

<script setup>
import modalHistorialOrden from './modalHistorialOrden.vue';
import { ref } from 'vue';
import QRcode from 'qrcode';

const refModalHistorial = ref()

const informationHistorialDeOrden = ref([
    {
        fecha: '5 Jul. 2022',
        hora: '6:10 pm',
        tienda: 'Sotomayor',
        usuario: 'Jaime Gonzales'
    },
    {
        fecha: '5 Jul. 2022',
        hora: '6:08 pm',
        tienda: 'Cañaveral',
        usuario: 'María Ramona Castillo'
    },
    {
        fecha: '5 Jul. 2022',
        hora: '6:05 pm',
        tienda: 'Provenza',
        usuario: 'Carlos Andrés Gutierrez'
    },
    {
        fecha: '5 Jul. 2022',
        hora: '6:00 pm',
        tienda: 'San francisco',
        usuario: 'Javier Andres Moreno'
    }
])

function openModalHistorial(){
    refModalHistorial.value.open()
}

</script>

<style lang="scss" scoped>

</style>