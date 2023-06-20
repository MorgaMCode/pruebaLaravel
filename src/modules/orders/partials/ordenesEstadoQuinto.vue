<template>
    <div class="p-3">
        <div class="d-middle gap-3 cr-pointer" @click="openModalAsignarDomiciliario">
            <div class="d-middle-center wh-32 rounded-circle bg-blue-state-lightest">
                <i class="icon-delivery text-blue f-25" />
            </div>
            <p class="f-medium f-16">Asignar domiciliario</p>
            <i class="icon-chevron-right ms-auto text-orange f-25"/>
        </div>
    </div>
    <modalDomiciliarioAsignar ref="refModalDomiciliarioAsignar" :domiciliario="domiciliariosDisponibles" />
</template>

<script setup>
import modalDomiciliarioAsignar from './modalDomiciliarioAsignar.vue';
import { ref } from 'vue';

const refModalDomiciliarioAsignar = ref()

const domiciliariosDisponibles = ref([
    { photo: '/img/emptyState/woUsers.jpg', name: 'Daniel Correa', state: 1, id: '123465', pedidosAsignados: 7 }
])

function openModalAsignarDomiciliario(){
    refModalDomiciliarioAsignar.value.open()
}

</script>

<style lang="scss" scoped>

</style>