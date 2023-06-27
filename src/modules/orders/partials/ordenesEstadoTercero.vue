<template>
    <div class="p-3">
        <div class="d-middle gap-2">
            <div class="wh-32 bg-whitesmoke3 d-middle-center rounded-circle align-self-start">
                <i class="icon-account f-25" />
            </div>
            <div class="d-flex flex-column gap-1 w-190px">
                <p class="f-medium f-16">{{ infoUser.nombre }}</p>
                <p v-if="infoUser.pedidosUltimoMes" class="text-whitesmoke f-14">{{ infoUser.pedidosUltimoMes }} Pedidos últ. mes</p>
                <p v-else class="text-whitesmoke f-14">{{ infoUser.pedidoUltimoAnio }} Pedidos últ. año</p>
                <div v-if="infoUser.primerPedido" class="bg-green-clear br-8 wM-114px text-center px-1" style="padding: 2px 0px;">
                    <p class="f-14">Primer pedido</p>
                </div>
                <div v-if="infoUser.chat" class="hoverChatCliente d-middle border position-relative cr-pointer br-18 mt-2" @click="openDrawerChatCliente">
                    <i class="icon-chat f-25" />
                    <p class="f-medium f-14">Chat con el cliente</p>
                    <div class="d-middle-center bg-red-badge rounded-pill position-absolute wM-25px" style="right: -10px; padding: 0 6px;">
                        <p  class="text-white f-12">{{ infoUser.chatMensajes }}</p>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column gap-3 ms-auto align-self-start">
                <div class="d-middle-end">
                    <p>{{ infoUser.puntosNegativos }}</p>
                    <el-tooltip content="Puntos negativos" placement="bottom" effect="light">
                        <i class="icon-alerta text-orange f-25" />
                    </el-tooltip>
                    <el-popover placement="bottom" trigger="hover">
                        <template #reference>
                            <i class="icon-info-outline f-25" />
                        </template>
                        <div class="d-middle">
                            <i class="icon-flag f-25" />
                            <p>Reportes: 4</p>
                        </div>
                        <div class="d-flex flex-column gap-2 w-100">
                            <button class="btn border py-1" @click="openModalVerDetalleCliente"><p class="f-12">Ver detalle</p></button>
                            <button class="btn bg-general text-white py-1" @click="openModalReportarCliente"><p class="f-12">Reportar</p></button>
                        </div>
                    </el-popover>
                </div>
                <div class="bg-orange px-2 br-10" style="padding: 2px 0px;">
                    <p class="text-white f-12">Usuario reportado</p>
                </div>
            </div>
        </div>
        <div v-if="infoUser.tipoPedido === 1" class="d-middle gap-2 mt-3">
            <div class="wh-32 bg-green-clear d-middle-center rounded-circle align-self-start">
                <i class="f-25 icon-home"  />
            </div>
            <div class="w-300px d-flex flex-column gap-2">
                <p class="f-14">{{ infoUser.direccion?? "Sin direccion" }} <br /> {{ infoUser.direccionObservacion }} </p>
                <p  class="f-medium f-14">Barrio: <span class="f-light">{{ infoUser.barrio }}</span> </p>
                <p  class="f-medium f-14">{{ infoUser.observacionEntrega?? "" }}</p>
            </div>
        </div>
        <div v-if="infoUser.tipoPedido === 2" class="d-middle gap-2 mt-3">
            <div class="wh-32 bg-green-clear d-middle-center rounded-circle align-self-start">
                <i class="f-25 icon-restaurant"  />
            </div>
            <div class="w-300px d-flex flex-column gap-2">
                <p class="f-14">Recoger en tienda <br />  </p>
            </div>
        </div>
        <div v-if="infoUser.tipoPedido === 3" class="d-middle gap-2 mt-3">
            <div class="wh-32 bg-green-clear d-middle-center rounded-circle align-self-start">
                <i class="f-25 icon-table"  />
            </div>
            <div class="w-300px d-flex flex-column gap-2">
                <p class="f-14">Servir en :{{ infoUser.mesa?? "" }} <br />  </p>
            </div>
        </div>
    </div>
    <modal ref="refModalVerDetalles" modal-title="Reportes de cliente" :see-buttons-bottom="false">
        <div class="p-4 pe-5">
            <p class="f-medium f-18">Jonathan Hope</p>
            <div class="d-middle my-2">
                <div class="d-middle-center wh-24">
                    <i class="icon-flag f-25" />
                </div>
                <p class="f-14">Reportes: 4</p>
            </div>
            <table class="d-flex flex-column gap-2 w-100 mt-3">
                <tr class="text-black f-medium f-14">
                    <td class="w-83">Criterio</td>
                    <td>Reporte</td>
                </tr>
                <tr class="d-flex text-hrey-light">
                    <td class="w-78">Cancelación frecuente de órdenes</td>
                    <td>2</td>
                </tr>
                <tr class="d-flex text-hrey-light">
                    <td class="w-78">Dirección errónea</td>
                    <td>2</td>
                </tr>
            </table>
        </div>
    </modal>
    <modal-reportar ref="refModalReportar" :informationRadio="valorRadioReportarCliente" />
    <drawerChatCliente ref="refDrawerChatCliente" :informationChatCliente="chatDeLaOrden" chatTitle="Chat de la orden" @sendMessage="addMessageChat" @openFile="sendImageFile" />
</template>

<script setup>
import modal from '../../../shared/components/modal.vue';
import modalReportar from './modalReportar.vue';
import drawerChatCliente from './drawerChatCliente.vue';
import { ref } from 'vue';

const refModalVerDetalles = ref()
const refModalReportar = ref()
const refDrawerChatCliente = ref()

let props = defineProps({
    mostrarChatCliente: {
        type: Boolean,
        required: false,
        default: true
    },
    infoUser:{
        type: Object,
        required: false,
        default: ()=>{}
    }
})

const valorRadioReportarCliente = ref([
    { value: 1, text: 'Cancelación frecuente de órdenes' },
    { value: 2, text: 'Dirección errónea' },
    { value: 3, text: 'Cliente problematico' },
    { value: 4, text: 'Demora en pagos por transferencia' },
    { value: 5, text: 'Información falsa' },
])



const chatDeLaOrden = ref([
    { type: 2, message: null, url: '/img/emptyState/bannerRestaurante.png', horaEstandar: new Date() },
    { type: 2, message: 'Hello ❤', horaEstandar: new Date() },
    { type: 1, message: 'Hola', horaEstandar: new Date() },
])

function sendImageFile(e){
    let reader = new FileReader()
    reader.addEventListener('load', () => {
        chatDeLaOrden.value.unshift({ type: 2, url: reader.result, horaEstandar: new Date() })
    })
    reader.readAsDataURL(e.target.files[0])
}

function addMessageChat(message){
    if(message !== ''){
        chatDeLaOrden.value.unshift({ type: 2, message: message, horaEstandar: new Date() })
    }
}

function openDrawerChatCliente(){
    refDrawerChatCliente.value.open()
}

function openModalReportarCliente(){
    refModalReportar.value.open()
}

function openModalVerDetalleCliente(){
    refModalVerDetalles.value.open()
}

</script>

<style lang="scss" scoped>
.hoverChatCliente{
    transition: 0.3s all;
    &:hover{
        background-color: var(--green-clear);
        color: white;
        border: 1px solid var(--green-clear);
    }
}

</style>