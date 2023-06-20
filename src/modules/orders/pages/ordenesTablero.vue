<template>
    <div class="d-flex bg-blue-lightest overflow-auto hidden-scroll gap-4 px-5 py-3 me-5" style="height: calc(100vh - 56px);">
        <porAceptarOrdenesTablero
            ref="refOpenDrawer"
            :informationTablero="solicitudes"
            :informationState="informationStateOrders[0]"
            :informationsProductsFood="informationProducts"
            :openDrawer="openDrawer"
        />
        <div v-for="(application, i) in solicitudesIndividuales" :key="i" class="d-flex-column box-shadow29 w-293px br-8" @click="abrirCajon">
            <div
                class="d-middle ps-3 h-51px"
                :class="colores[i + 1]?.bgColor"
                style="border-radius: 8px 8px 0px 0px;"
            >
                <p class="f-semibold text-black f-18">{{ application.solicitud }} ({{ application.cantidad }})</p>
            </div>
            <div class="h-2px w-100" :class="colores[i + 1]?.colorBorder" />
            <div class="bg-white overflow-auto hidden-scroll h-100 pb-3">
                <ordersToGoRouteTablero
                    v-for="(pedido, i) in application.informationBox"
                    :key="i"
                    :pedidoInformation="pedido"
                    :indice="i"
                />
            </div>
        </div>
    </div>
</template>

<script setup>
import porAceptarOrdenesTablero from '../partials/porAceptarOrdenesTablero.vue';
import ordersToGoRouteTablero from '../components/ordersToGoRouteTablero.vue';
import { ref } from 'vue';

const openDrawer = ref(false)
const refOpenDrawer = ref()

let props = defineProps({
    informationStateOrders:{
        type:Array,
        required: false,
        default: () => []
    },
    informationProducts: {
        type: Array,
        required: false,
        default: () => []
    }
})

function abrirCajon(){
    refOpenDrawer.value.open()
}

const colores = {
    1: { bgColor: 'bg-orange-capsule', colorBorder: 'bg-orange' },
    2: { bgColor: 'bg-blue-light', colorBorder: 'bg-blue' },
    3: { bgColor: 'bg-blue-state-lightest', colorBorder: 'bg-blue-light' },
    4: { bgColor: 'bg-green-light', colorBorder: 'bg-green-clear' },
    5: { bgColor: 'bg-terracota', colorBorder: 'bg-red-badge' },
}

const solicitudes = ref({
    text: 'Por aceptar',
    cantidad: 20,
    tableroCuadroInformacion: [
        {
            dia: 'HOY',
            cantidad: 10,
            ordersCuadro: [
                {
                    id: 1,
                    numero: '987654',
                    cedida: true,
                    mensaje: true,
                    valor: '53.000',
                    cantidad: 1,
                    pedido: '7:45 a.m',
                    entrega: '8:30 a.m',
                    place: {
                            lugar: 'Granjas de Palonegro Norte...',
                            precioDomicilio: '1.000',
                            conDomicilioValor: true
                        },
                },
                {
                    id: 2,
                    numero: '987654',
                    cedida: true,
                    mensaje: false,
                    valor: '53.000',
                    cantidad: 1,
                    pedido: '7:45 a.m',
                    entrega: '8:30 a.m',
                    place: {
                            lugar: 1,
                            conDomicilioValor: false
                        },
                },
                {
                    id: 3,
                    numero: '987654',
                    cedida: true,
                    mensaje: false,
                    valor: '53.000',
                    cantidad: 1,
                    pedido: '7:45 a.m',
                    entrega: '8:30 a.m',
                    place: {
                            lugar: 2,
                            conDomicilioValor: true
                        },
                },
                {
                    id: 4,
                    numero: '987654',
                    cedida: true,
                    mensaje: false,
                    valor: '53.000',
                    cantidad: 1,
                    pedido: '7:45 a.m',
                    entrega: '8:30 a.m',
                    place: {
                            lugar: 2,
                            conDomicilioValor: true
                        },
                },
                {
                    id: 5,
                    numero: '987654',
                    cedida: true,
                    mensaje: false,
                    valor: '53.000',
                    cantidad: 1,
                    pedido: '7:45 a.m',
                    entrega: '8:30 a.m',
                    place: {
                            lugar: 2,
                            conDomicilioValor: true
                        },
                },
            ]
        },
        {
            dia: 'MAÑANA',
            cantidad: 20,
            ordersCuadro: [
                {
                    id: 1,
                    numero: '987654',
                    cedida: true,
                    mensaje: true,
                    valor: '53.000',
                    cantidad: 1,
                    pedido: '7:45 a.m',
                    entrega: '8:30 a.m',
                    place: {
                            lugar: 'Granjas de Palonegro Norte...',
                            precioDomicilio: '1.000',
                            conDomicilioValor: true
                        },
                },
                {
                    id: 2,
                    numero: '987654',
                    cedida: true,
                    mensaje: false,
                    valor: '53.000',
                    cantidad: 1,
                    pedido: '7:45 a.m',
                    entrega: '8:30 a.m',
                    place: {
                            lugar: 1,
                            conDomicilioValor: false
                        },
                },
                {
                    id: 3,
                    numero: '987654',
                    cedida: true,
                    mensaje: true,
                    valor: '53.000',
                    cantidad: 1,
                    pedido: '7:45 a.m',
                    entrega: '8:30 a.m',
                    place: {
                            lugar: 2,
                            conDomicilioValor: true
                        },
                },
                {
                    id: 4,
                    numero: '987654',
                    cedida: true,
                    mensaje: true,
                    valor: '53.000',
                    cantidad: 1,
                    pedido: '7:45 a.m',
                    entrega: '8:30 a.m',
                    place: {
                            lugar: 2,
                            conDomicilioValor: true
                        },
                },
                {
                    id: 5,
                    numero: '987654',
                    cedida: true,
                    mensaje: true,
                    valor: '53.000',
                    cantidad: 1,
                    pedido: '7:45 a.m',
                    entrega: '8:30 a.m',
                    place: {
                            lugar: 2,
                            conDomicilioValor: true
                        },
                },
            ]
        },
        {
            dia: 'JUEVES, 5 DICIEMBRE',
            cantidad: 20,
            ordersCuadro: [
                {
                    id: 1,
                    numero: '987654',
                    cedida: true,
                    mensaje: true,
                    valor: '53.000',
                    cantidad: 1,
                    pedido: '7:45 a.m',
                    entrega: '8:30 a.m',
                    place: {
                            lugar: 'Granjas de Palonegro Norte...',
                            precioDomicilio: '1.000',
                            conDomicilioValor: true
                        },
                },
                {
                    id: 2,
                    numero: '987654',
                    cedida: true,
                    mensaje: false,
                    valor: '53.000',
                    cantidad: 1,
                    pedido: '7:45 a.m',
                    entrega: '8:30 a.m',
                    place: {
                            lugar: 1,
                            conDomicilioValor: false
                        },
                },
                {
                    id: 3,
                    numero: '987654',
                    cedida: true,
                    mensaje: true,
                    valor: '53.000',
                    cantidad: 1,
                    pedido: '7:45 a.m',
                    entrega: '8:30 a.m',
                    place: {
                            lugar: 2,
                            conDomicilioValor: true
                        },
                },
                {
                    id: 4,
                    numero: '987654',
                    cedida: true,
                    mensaje: true,
                    valor: '53.000',
                    cantidad: 1,
                    pedido: '7:45 a.m',
                    entrega: '8:30 a.m',
                    place: {
                            lugar: 2,
                            conDomicilioValor: true
                        },
                },
                {
                    id: 5,
                    numero: '987654',
                    cedida: true,
                    mensaje: true,
                    valor: '53.000',
                    cantidad: 1,
                    pedido: '7:45 a.m',
                    entrega: '8:30 a.m',
                    place: {
                            lugar: 2,
                            conDomicilioValor: true
                        },
                },
            ]
        },
    ]
})

const solicitudesIndividuales = ref([
    {
        id: 1,
        solicitud: 'Aceptado',
        cantidad: 4,
        informationBox: [
            {
                id: 1,
                numero: '987654',
                mensaje: true,
                valor: '53.000',
                cantidad: 1,
                pedido: '7:45 a.m',
                entrega: '8:30 a.m',
                place: {
                        lugar: 'Granjas de Palonegro Norte...',
                        precioDomicilio: null,
                        conDomicilioValor: false,
                        aprobado: false,
                        advertence: true,
                        sinCaracteristicas: true
                    },
            },
            {
                id: 2,
                numero: '987654',
                valor: '53.000',
                cantidad: 1,
                pedido: '7:45 a.m',
                entrega: '8:30 a.m',
                place: { lugar: 1 },
            },
            {
                id: 3,
                numero: '987654',
                valor: '53.000',
                cantidad: 1,
                pedido: '7:45 a.m',
                entrega: '8:30 a.m',
                place: {
                        lugar: 'Rio negro',
                        conDomicilioValor: false,
                        aprobado: false,
                        advertence: true
                    },
            },
            {
                id: 3,
                numero: '987654',
                valor: '53.000',
                cantidad: 1,
                pedido: '7:45 a.m',
                entrega: '8:30 a.m',
                place: {
                        lugar: 'Rio negro',
                        conDomicilioValor: false,
                        aprobado: true,
                        advertence: false
                    },
            },
        ]
    },
    {
        id: 2,
        solicitud: 'Preparando',
        cantidad: 5,
        informationBox: [
            {
                id: 1,
                numero: '987654',
                mensaje: true,
                valor: '53.000',
                cantidad: 1,
                pedido: '7:45 a.m',
                entrega: '8:30 a.m',
                place: {
                        lugar: 'Granjas de Palonegro Norte...',
                        precioDomicilio: null,
                        conDomicilioValor: false,
                        aprobado: false,
                        advertence: true,
                        sinCaracteristicas: true
                    },
            },
            {
                id: 2,
                numero: '987654',
                valor: '53.000',
                cantidad: 1,
                pedido: '7:45 a.m',
                entrega: '8:30 a.m',
                place: { lugar: 1 },
            },
            {
                id: 3,
                numero: '987654',
                valor: '53.000',
                cantidad: 1,
                pedido: '7:45 a.m',
                entrega: '8:30 a.m',
                place: {
                        lugar: 'Rio negro',
                        conDomicilioValor: false,
                        aprobado: false,
                        advertence: true
                    },
            },
            {
                id: 3,
                numero: '987654',
                valor: '53.000',
                cantidad: 1,
                pedido: '7:45 a.m',
                entrega: '8:30 a.m',
                place: {
                        lugar: 'Rio negro',
                        conDomicilioValor: false,
                        aprobado: true,
                        advertence: false
                    },
            },
        ]
    },
    {
        id: 3,
        solicitud: 'En camino',
        cantidad: 3,
        informationBox: [
            {
                id: 1,
                numero: '987654',
                mensaje: true,
                valor: '53.000',
                cantidad: 1,
                pedido: '7:45 a.m',
                entrega: '8:30 a.m',
                place: {
                        lugar: 'Granjas de Palonegro Norte...',
                        precioDomicilio: null,
                        conDomicilioValor: false,
                        aprobado: false,
                        advertence: true,
                        sinCaracteristicas: true
                    },
            },
            {
                id: 2,
                numero: '987654',
                valor: '53.000',
                cantidad: 1,
                pedido: '7:45 a.m',
                entrega: '8:30 a.m',
                place: { lugar: 1 },
            },
            {
                id: 3,
                numero: '987654',
                valor: '53.000',
                cantidad: 1,
                pedido: '7:45 a.m',
                entrega: '8:30 a.m',
                place: {
                        lugar: 'Rio negro',
                        conDomicilioValor: false,
                        aprobado: false,
                        advertence: true
                    },
            },
            {
                id: 3,
                numero: '987654',
                valor: '53.000',
                cantidad: 1,
                pedido: '7:45 a.m',
                entrega: '8:30 a.m',
                place: {
                        lugar: 'Rio negro',
                        conDomicilioValor: false,
                        aprobado: true,
                        advertence: false
                    },
            },
        ]
    },
    {
        id: 4,
        solicitud: 'Por entregar tienda',
        cantidad: 1,
        informationBox: [
            {
                id: 1,
                numero: '987654',
                mensaje: true,
                valor: '53.000',
                cantidad: 1,
                pedido: '7:45 a.m',
                entrega: '8:30 a.m',
                place: {
                        lugar: null
                    },
            },
        ]
    },
    {
        id: 5,
        solicitud: 'Por servir mesa',
        cantidad: 1,
        informationBox: [
            {
                id: 1,
                numero: '987654',
                mensaje: true,
                valor: '53.000',
                cantidad: 1,
                pedido: '7:45 a.m',
                entrega: '8:30 a.m',
                place: {
                        lugar: null
                    },
            },
        ]
    },
])

</script>

<style lang="scss" scoped>

</style>