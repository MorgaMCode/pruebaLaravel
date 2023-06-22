<template>
    <div
        class="hoverOrders d-middle border-bottom cr-pointer hM-129px gap-3 py-2 pe-2"
        :class="{ 'orderSelected':  ordenes?.id == route.params.id  }"
        @click="emit('toGoOrders', ordenes?.id, index)"
    >
        <div class='lineBlueLeft w-4px hf-105px bg-blue' style="border-radius: 0px 2px 2px 0px;" />
        <div class="d-flex j-center flex-column gap-1 h-100">
            <p class="f-medium f-14">No.  {{ ordenes?.id }} </p>
            <p class="text-whitesmoke f-12">$ {{ ordenes?.valorFinal }} <span class="text-blue-dark">({{ ordenes?.cantidadProductos }})</span> </p>
            <div class="d-middle text-whitesmoke">
                <i class="icon-clock f-18" />
                <p class="f-12">Pedido: {{ ordenes?.horaCreado }}</p>
            </div>
            <p v-if="ordenes?.entregaBarrio" class="text-whitesmoke f-12">{{ ordenes?.entregaBarrio }}</p>
        </div>
        <div class="d-flex j-center flex-column a-end gap-1 ms-auto h-100">
            <div class="d-middle gap-4">
                <div v-if="ordenes?.tieneChat" class="bg-orange rounded-pill d-middle-center text-white h-25px">
                    <i class="icon-chat f-25" />
                </div>
                <stateOrders :states="ordenes?.estado" />
            </div>
            <div class="d-middle text-blue f-12">
                <i class="icon-delivery f-18" />
                <p>Entrega: {{ ordenes?.entregaHora }}</p>
            </div>
            <div class="d-middle">
                <p class="f-12" :class="[ styleTipoPedido[ordenes.tipoPedido].textColor]">{{  styleTipoPedido[ordenes.tipoPedido].text  }}</p>
                <div class="wh-20 d-middle-center">
                    <i class="text-orange f-20" :class="styleTipoPedido[ordenes.tipoPedido].icon" />
                </div>
            </div>
            
            <template v-if="ordenes?.entregaBarrio">
                <div class="d-middle" v-if="ordenes?.valorDomicilio?? 'sin costo'" >
                    <i class="icon-delivery f-24" />
                    <p class="f-14">${{ ordenes?.valorDomicilio?? 'sin costo'    }}</p>
                </div>
                <div v-else class="d-middle">
                    <img src="/img/emptyState/woUsers.jpg" alt="users" class="wh-20" />
                    <div v-if="ordenes?.reportado || ordenes?.verificado" class="wh-20 d-middle-center">
                        <i v-if="ordenes?.reportado" class="icon-alerta text-orange f-20" />
                        <i v-else class="icon-verify text-green-clear f-20" />
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>

<script setup>
import stateOrders from './stateOrders.vue';
import { useRoute, useRouter } from 'vue-router';

let route = useRoute()
let router = useRouter()


let props = defineProps({
    ordenes:{
        type: Object,
        required: false,
        default: () => {}
    },
    index:{
        type: Number,
        required: false,
        default: () => 0
    },
    alturaLineaAzul:{
        type: String,
        required: false,
        default: 'h-115px'
    },
    idi: {
        type: Number,
        required: false,
    }
})

const styleTipoPedido = {
    1:{  text: 'Domicilio', textColor: 'text-whitesmoke'},
    2:{  text: 'Recoge en tienda ', textColor: 'text-orange', icon: 'icon-restaurant' },
    3:{  text: 'Servir en mesa', textColor: 'text-orange' , icon: 'icon-table',}
}

let emit = defineEmits(['toGoOrders'])

</script>

<style lang="scss" scoped>
.hoverOrders{
    .lineBlueLeft{
        visibility: hidden;
    }
    &:hover{
        background-color: var(--blue-lightest);
    }
    &:hover > .lineBlueLeft{
        visibility: visible;
    }
}

.orderSelected > .lineBlueLeft{
    visibility: visible;
}
.orderSelected{
    background-color: var(--blue-lightest);
}

</style>