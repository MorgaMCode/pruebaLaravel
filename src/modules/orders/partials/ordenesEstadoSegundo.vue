<template>
    <div class="p-3">
        <div  class="position-relative">
            <div class="d-middle gap-2 mb-2">
                <div class="wh-32 d-middle-center rounded-circle bg-general" >
                    <i class="icon-calendar-2 f-25" />
                </div>
                <p class="f-medium f-12">Fecha Orden : {{ infoBasicOrder?.fechaOrden }} </p>
                <div class="d-middle ms-auto me-5">
                    <i class="icon-clock f-25" />
                    <p class="f-light f-14 w-80px">{{ infoBasicOrder?.horaOrden }}</p>
                </div>
            </div>
            <div class="d-middle gap-2 mb-2">
                <div class="wh-32 d-middle-center rounded-circle bg-green-clear" >
                    <i class="icon-calendar-2 f-25" />
                </div>
                <p class="f-medium f-12">Fecha Entrega : {{ infoBasicOrder?.fechaEntrega }} </p>
                <div class="d-middle ms-auto me-5">
                    <i class="icon-clock f-25" />
                    <p class="f-light f-14 w-80px">{{ infoBasicOrder?.horaOrden }}</p>
                </div>
            </div>
           
            <!-- <div v-if="informationDates[informationDates.length - 1] !== date " class="h-20px w-1px bg-orange bg-black position-absolute" style="left: 15px; top: 35px;" /> -->
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
const props = defineProps({
    infoBasicOrder:{
        type: Object,
        default:() => {}
    }
})
const informationDates = ref([
    { text: 'Fecha orden', date: '5 Jul. 2022', time: '12:05 p.m' },
    { text: 'Fecha entrega', date: '5 Jul. 2022', time: '4:05 p.m' },
])

</script>

<style lang="scss" scoped>

</style>