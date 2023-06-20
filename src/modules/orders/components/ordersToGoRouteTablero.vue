<template>
    <div
        class="hoverOrders d-middle border-bottom cr-pointer w-291px h-106px gap-3 py-2 pe-3"
        @click="emit('toGoOrders')"
    >
        <div class='lineBlueLeft w-4px h-100 bg-blue' style="border-radius: 0px 2px 2px 0px;" />
        <div class="d-flex flex-column gap-2 w-100">
            <div class="d-middle-bt">
                <div class="d-middle gap-2">
                    <p class="f-medium f-14">No. {{ pedidoInformation.numero }}</p>
                    <el-tooltip v-if="pedidoInformation.cedida" content="Cedida" placement="bottom" effect="light">
                        <div class="d-middle-center wh-20">
                            <i class="icon-change f-20" />
                        </div>
                    </el-tooltip>
                </div>
                <div v-if="pedidoInformation.mensaje" class="bg-orange rounded-pill d-middle-center text-white h-25px">
                    <i class="icon-chat f-25" />
                </div>
                <p class="text-whitesmoke f-12">$ {{ pedidoInformation.valor }}<span class="text-blue-dark ps-1">({{ pedidoInformation.cantidad }})</span> </p>
            </div>
            <div class="d-middle-bt">
                <div class="d-middle text-whitesmoke">
                    <div class="d-middle-center wh-20">
                        <i class="icon-clock f-20" />
                    </div>
                    <p class="f-12">Pedido: {{ pedidoInformation.pedido }}</p>
                </div>
                <div class="d-middle text-blue">
                    <div class="d-middle-center wh-20">
                        <i class="icon-clock f-20" />
                    </div>
                    <p class="f-12">Entrega: {{ pedidoInformation.entrega }}</p>
                </div>
            </div>
            <div v-if="typeof pedidoInformation.place?.lugar === 'string'" class="d-middle-bt">
                <p class="text-whitesmoke f-12">{{ pedidoInformation.place.lugar }}</p>
                <div v-if="pedidoInformation.place.conDomicilioValor" class="d-middle">
                    <div class="d-middle-center wh-20">
                        <i class="icon-delivery f-20" />
                    </div>
                    <p class="f-12">${{ pedidoInformation.place.precioDomicilio }}</p>
                </div>
                <div v-else class="d-middle">
                    <img src="/img/emptyState/woUsers.jpg" alt="fotoMensajero" class="wh-20" />
                    <div v-if="pedidoInformation.place.sinCaracteristicas !== true" class="d-middle-center wh-20">
                        <i class="text-green-clear f-20" :class="{ 'icon-verify': pedidoInformation.place.aprobado}" />
                        <i class="text-orange f-20" :class="{ 'icon-alerta': pedidoInformation.place.advertence}" />
                    </div>
                </div>
            </div>
            <div v-if="typeof pedidoInformation.place?.lugar === 'number'" class="d-middle">
                <div class="d-middle-center wh-20">
                    <i class="f-20" :class="pedidoInformation.place.lugar === 1 ? 'icon-table': 'icon-restaurant'" />
                </div>
                <p class="f-12">{{ pedidoInformation.place.lugar === 1 ? 'Servir en mesa': 'Recoge en tienda' }}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useRoute, useRouter } from 'vue-router';

let route = useRoute()
let router = useRouter()

let props = defineProps({
    pedidoInformation:{
        type: Object,
        required: false,
        default: () => {}
    },
    indice:{
        type: Number,
        required: false,
        default: () => 0
    },
})

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