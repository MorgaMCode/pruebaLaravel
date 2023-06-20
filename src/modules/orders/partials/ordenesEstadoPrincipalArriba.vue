<template>
    <div :id="idi"  class="d-flex-column gap-3 px-3" :class="borderAbajo">
        <div class="d-middle-bt">
            <p class="f-medium f-18">No. {{ state?.serialNumber }}</p>
            <div class="d-middle gap-2">
                <stateOrders :states="state?.state" />
                <el-popover
                placement="bottom"
                :width="184"
                trigger="hover"
                @before-enter="popoverActivo(true)"
                @after-leave="popoverActivo"
                >
                    <template #reference>
                        <div class="wh-32 rounded-circle d-middle-center cr-pointer" :class="{ 'hoverTresPuntos': tresPuntosHover}">
                            <i class="icon-dots-vertical f-25" />
                        </div>
                    </template>
                    <template #default>
                        <div v-for="(see, i) in select" :key="i" class="icon-hover-blue cr-pointer br-4 ps-3 py-1" @click="openModalPopover(i)" >
                            <p class="f-15">{{ see.text }}</p>
                        </div>
                    </template>
                </el-popover>
            </div>
        </div>
        <div v-if="state?.state === 1" class="d-flex j-center gap-2">
            <button class="btn bg-general text-white f-14" @click="openModalConfirmarPedido"><p class="f-14">Confirmar</p></button>
            <button class="btn border"><p class="f-14" @click="openModalRechazarOrden">Rechazar</p></button>
            <div class="d-middle bg-gray-light br-8 pe-2 ps-1 item-with-hover cr-pointer" @click="openModalCederOrden">
                <i class="icon-change f-25" />
                <p class="f-medium f-14">Ceder</p>
            </div>
        </div>
        <div v-else-if="state?.state === 2" class="border-orange br-14 me-3 py-2 ps-2">
            <p class="text-black f-light f-12">Está orden cambiará automáticamente al estado preparando</p>
        </div>
        <template v-else-if="state?.state === 3">
            <div class="d-flex-column a-center gap-2">
                <div v-for="(button, i) in botonesEstadoPreparando" :key="i" class="bg-general text-center cr-pointer py-2 br-8 w-312px" @click="openModalsServirCliente(i)">
                    <p class="f-medium text-white f-14">{{ button.text }}</p>
                </div>
            </div>
        </template>
        <template v-else-if="state?.state === 4">
            <div class="bg-general text-center mx-auto cr-pointer w-312px py-2 br-8" @click="openModalEntregarAlCliente">
                <p class="text-white f-medium f-14">Entregar al ciente</p>
            </div>
        </template>
    </div>
    <modal ref="refModalConfirmarOrden" modal-title="Confirmar orden" action="Confirmar" :modal-width="377" >
        <div class="px-4 py-3">
            <p class="text-grey-light f-15">¿Deseas confirmar la orden?</p>
        </div>
    </modal>
    <modal ref="refModalRechazarOrden" :modal-width="417" modal-title="Rechazar orden" action="Rechazar">
        <div class="px-4 py-3">
            <div class="ps-3">
                <p class="text-grey-light f-15 mb-3">Dinos el motivo de rechazo</p>
                <p class="f-medium f-16">Motivo</p>
            </div>
            <el-select v-model="valueSelectRechazarOrden" placeholder="Seleccionar" class="w-100">
                <el-option label="Dinero insuficiente" value="Dinero insuficiente" />
            </el-select>
        </div>
    </modal>
    <modal ref="refQrOrdenModal" :modal-width="531" modal-title="Código QR de la orden" :see-buttons-bottom="false" >
        <div class="wh-402 mx-auto">
            <img :src="codigoQr" alt="codigoQr" class="h-100 w-100" />
        </div>
    </modal>
    <modal ref="refModalCancelarOrden" modal-title="Cancelar orden" action="Cancelar">
        <div class="px-5 py-3">
            <p class="text-grey-light f-15 mb-3">Dinos el motivo de cancelación</p>
            <p class="f-medium f-16 ps-3">Motivo</p>
            <el-select v-model="seleccionarMotivoValue" placeholder="Seleccionar">
                <el-option label="Falta de tiempo" value="Falta de tiempo" />
            </el-select>
        </div>
    </modal>
    <modal-ceder-orden ref="refModalCederOrden" :selectInformation="seleccionarTiendaCeder" />
    <modal ref="refModalEnviarAlCliente" modal-title="Enviar al cliente" :modal-width="377" action="Enviar">
        <div class="py-4 px-5">
            <p class="text-grey-light">¿Deseas Enviar al cliente?</p>
        </div>
    </modal>
    <modal ref="refModalEntregarAlClienteEstadoPreparando" modal-title="Por entregar al cliente" action="Confirmar" :modal-width="377">
        <div class="ps-4 pe-4 py-3">
            <p class="text-grey-light f-15">¿Confirmar al cliente que el pedido está listo para la entrega?</p>
        </div>
    </modal>
    <modal ref="refModalServirEnMesa" modal-title="Listo para servir en mesa" :modal-width="377" action="Confirmar">
        <div class="px-4 py-3">
            <p class="text-grey-light f-15">¿Confirmar que el pedido está listo para servir en la mesa?</p>
        </div>
    </modal>
    <modal ref="refModalEntregarAlClienteEstadoEnCamino" modal-title="Entregar al cliente" :modal-width="377" action="Entregar">
        <div class="py-4 px-5">
            <p class="text-grey-light f-15">¿Deseas entregar al cliente?</p>
        </div>
    </modal>
</template>

<script setup>
import modal from '../../../shared/components/modal.vue';
import modalCederOrden from './modalCederOrden.vue';
import stateOrders from '../components/stateOrders.vue';
import { ref } from 'vue';
import QRcode from 'qrcode';

const refModalConfirmarOrden = ref()
const refModalRechazarOrden = ref()
const refQrOrdenModal = ref()
const refModalCancelarOrden = ref()
const refModalCederOrden = ref()
const refModalEnviarAlCliente = ref()
const refModalEntregarAlClienteEstadoPreparando = ref()
const refModalEntregarAlClienteEstadoEnCamino = ref()
const refModalServirEnMesa = ref()
const tresPuntosHover = ref(false)
const seleccionarMotivoValue = ref('')
const valueSelectRechazarOrden = ref('')

let codigoQr = ''

let props = defineProps({
    state:{
        type: Object,
        required: false,
        default: () => {}
    },
    idi:{
        type: String,
        default: '',
        required: false
    },
    borderAbajo:{
        type: String,
        required: false,
        default: 'py-2'
    }
})

const seleccionarTiendaCeder = ref([
    { value: 1, label: 'Sotomayor' },
    { value: 2, label: 'Cañaveral' },
    { value: 3, label: 'Provenza' },
    { value: 4, label: 'San francisco' },
])

const select = ref([
    { id: 1, text: 'Imprimir ticket' },
    { id: 2, text: 'Ver QR de la orden' },
    { id: 3, text: 'Cancelar orden' },
    { id: 4, text: 'Ceder orden' },
])

const botonesEstadoPreparando = ref([
    { text: 'Enviar al cliente' },
    { text: 'Por entregar al cliente' },
    { text: 'Listo para servir en mesa' },
])

function openModalEntregarAlCliente(){
    refModalEntregarAlClienteEstadoEnCamino.value.open()
}

function openModalsServirCliente(i){
    if(i === 0){
        refModalEnviarAlCliente.value.open()
    }else if(i === 1){
        refModalEntregarAlClienteEstadoPreparando.value.open()
    }else if(i === 2){
        refModalServirEnMesa.value.open()
    }
}

function openModalCederOrden(){
    refModalCederOrden.value.open()
}

function popoverActivo(valor){
    if(valor){
        tresPuntosHover.value = true
    }else{
        tresPuntosHover.value = false
    }
}

function openModalConfirmarPedido(){
    refModalConfirmarOrden.value.open()
}

function openModalRechazarOrden(){
    refModalRechazarOrden.value.open()
}

function openModalPopover(index){
    if(index == 1){
        QRcode.toDataURL('xtsfdfah', { version: 2 }, (error, url) => {
            if(error)return
            else{
                codigoQr = url
            }
        })
        refQrOrdenModal.value.open()
    }else if(index == 2){
        refModalCancelarOrden.value.open()
    }else if(index == 3){
        refModalCederOrden.value.open()
    }
}


</script>

<style lang="scss" scoped>

.hoverTresPuntos{
    background-color: var(--blue-state-lightest);
    color: var(--blue-state);
    transition: background-color 0.3s ease-in-out;
}


</style>