<template>
    <section class="px-5 h-100 overflow-auto hidden-scroll">
        <div class="d-middle flex-wrap">
                <div class="w-50" style="min-width: 425px;">
                    <h1 class="f-22 f-bold">Información general de la tienda</h1>
                    <p class="f-20 f-medium ms-2">Contacto</p>
                    <div class="ms-3">
                        <div class="d-middle gap-1 ps-1 mt-2">
                            <img :src="informationStoreContact?.paisImagen" alt="bandera" />
                            <p class="text-whitesmoke f-16">{{ informationStoreContact.contacto?.pais }} - {{ informationStoreContact.contacto?.ciudad }}</p>
                        </div>
                        <div class="d-middle my-1">
                            <i class="icon-restaurant f-24"  />
                            <p class="f-16 text-whitesmoke">{{ informationStoreContact.contacto?.direccion }}</p>
                        </div>
                        <div class="d-middle my-1">
                            <i class="icon-phone-outline f-24"  />
                            <p class="f-16 text-whitesmoke">{{ informationStoreContact.contacto?.telefono }}</p>
                        </div>
                        <p class="f-medium f-16">Forma de pago</p>
                        <div class="d-middle">
                            <div v-for="(data, i) in Object.entries(informationStoreContact?.metodosPago ?? {})" :key="i" class="d-middle text-whitesmoke ms-2">
                                <template v-if="data[1]">
                                    <i :class="wayToPay[data[0]]?.icon" class="f-24" />
                                    <p class="f-14">{{ wayToPay[data[0]]?.text }}</p>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-50 align-self-end">
                    <div class="w-414px ms-auto">
                        <p class="f-medium f-20">Mapa de ubicación</p>
                        <div class="border br-8 h-176px ms-auto mt-2" />
                    </div>
                </div>
        </div>
        <div class="w-55">
            <div class="d-middle gap-3 mt-5 mb-3">
                <p class="f-bold f-22">Horario de atención</p>
                <cardObservations icono="icon-historial" observations="Historial de actividad" @openObservations="activiteHitory" />
            </div>
            <tableWeeksDays :informationTable="informationStoreContact.horarioAtencion" />
        </div>
    </section>
</template>

<script setup>
import cardObservations from '../components/cardObservations.vue';
import tableWeeksDays from '../partials/tableWeeksDays.vue'
import { ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';

let route = useRoute()
let router = useRouter()

const props = defineProps({
    informationStoreContact: {
        type: Object,
        required: false,
        default: () => {}
    }
})

const wayToPay = ref({
    pagoDatafono: { icon: 'icon-bill', text: 'Efectivo' },
    pagoEfectivo: { icon: 'icon-dataphone', text: 'Datafono' },
    pagoLinea: { icon: 'icon-dataphone', text: 'Pago en línea' },
    pagoTransferencia: { icon: 'icon-transfer', text: 'Transferencia' },
})

function activiteHitory(){
    router.push({ name: 'restaurant.seventySeven.stores.activityHistory', params: { idStore: route.params.idStore } })
}


</script>

<style lang="scss" scoped>

</style>