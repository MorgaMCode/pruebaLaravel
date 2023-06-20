<template>
    <div class="p-3">
        <div class="d-flex">
            <img src="/img/emptyState/woUsers.jpg" alt="iconPerson" class="wh-32" />
            <div>
                <div class="d-middle gap-3">
                    <p>Daniel Correa</p>
                    <el-tooltip content="Eliminar domiciliario" placement="bottom" effect="light">
                        <div
                            class="item-with-hover d-middle-center cr-pointer rounded-circle wh-32"
                            style="transition: 0.3s all;"
                            @click="openModalEliminarDomiciliario "
                        >
                            <i class="icon-eliminar f-25" />
                        </div>
                    </el-tooltip>
                </div>
                <p>id: 12345</p>
            </div>
            <div class="ms-auto">
                <div v-for="calification in calificationDomiciliario" class="d-middle gap-2 mb-2">
                    <div class="d-middle gap-2 bg-orange-badge rounded-pill p-1 pe-2">
                        <div class="wh-24 d-middle-center">
                            <i class="icon-star text-orange f-25" />
                        </div>
                        <p class="f-medium f-16">{{ calification.calificacion }}</p>
                    </div>
                    <div class="d-middle">
                        <div class="wh-24 d-middle-center">
                            <i class="f-25" :class="calification.type == 1 ? 'icon-account' : 'icon-restaurant'" />
                        </div>
                        <p class="f-14">({{ calification.cantidadPuntos }})</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="ms-4">
            <div class="d-middle text-orange">
                <i class="icon-clock f-25" />
                <p class="f-14">Esperando confirmación</p>
            </div>
            <div class="d-middle text-orange">
                <i class="icon-alerta f-25" />
                <p class="f-14">Rechazado por el domiciliario</p>
            </div>
            <div class="d-middle-bt">
                <div class="d-middle text-green-clear">
                    <i class="icon-check f-25" />
                    <p class="f-14">Confirmado</p>
                </div>
                <el-tooltip content="Ver ubicación" placement="bottom" effect="light">
                    <div class="d-middle-center box-shadowBox rounded-circle cr-pointer item-with-hover wh-32" @click="openModalVerUbicacionDomiciliario">
                        <i class="icon-ubication f-25" />
                    </div>
                </el-tooltip>
            </div>
            <div class="d-middle-bt">
                <div class="d-middle">
                    <i class="icon-pin-direction f-25 text-red" />
                    <p class="f-14">Ya está en el punto de entrega</p>
                </div>
                <el-tooltip content="Ver ubicación" placement="bottom" effect="light">
                    <div class="d-middle-center box-shadowBox rounded-circle cr-pointer item-with-hover wh-32">
                        <i class="icon-ubication f-25" />
                    </div>
                </el-tooltip>
            </div>
            <div class="hoverChatCliente d-middle border position-relative cr-pointer br-18 mt-2 w-230px" @click="openDrawerChatCliente">
                <i class="icon-chat f-25" />
                <p class="f-medium f-14">Chat con el domiciliario</p>
                <div class="d-middle-center bg-red-badge rounded-pill position-absolute wh-20" style="right: -10px;">
                    <p class="text-white f-12">8</p>
                </div>
            </div>
            <div class="d-middle text-orange cr-pointer" @click="openModalAsignarDomiciliario">
                <p class="f-medium f-16">Cambiar domiciliario</p>
                <i class="icon-chevron-right f-25" />
            </div>
        </div>
    </div>
    <modal ref="refModalEliminarDomiciliario" :modal-width="377" modal-title="Eliminar domiciliario" action="Eliminar">
        <div class="px-5 py-4">
            <p class="text-grey-light f-15">¿Deseas eliminar al domiciliario?</p>
        </div>
    </modal>
    <modal ref="refModalUbicacionDomiciliario" :modal-width="1150" modal-title="Mapa ubicacion" :see-buttons-bottom="false">
        <div class="text-center py-3">
            <img src="/img/trash/mapaUbicacion.png" alt="imageMapa" />
        </div>
    </modal>
    <drawerChatCliente ref="refDrawerChatCliente" :informationChatCliente="chatDeLaOrden" chatTitle="Chat de la orden" @sendMessage="addMessageChat" @openFile="sendImageFile" />
    <modalDomiciliarioAsignar ref="refModalDomiciliarioAsignar" :domiciliario="domiciliariosDisponibles" />
</template>

<script setup>
import modal from '../../../shared/components/modal.vue';
import modalDomiciliarioAsignar from './modalDomiciliarioAsignar.vue';
import drawerChatCliente from './drawerChatCliente.vue';
import { ref } from 'vue';

const refModalEliminarDomiciliario = ref()
const refModalUbicacionDomiciliario = ref()
const refModalDomiciliarioAsignar = ref()
const  refDrawerChatCliente = ref()

const domiciliariosDisponibles = ref([
    { photo: '/img/emptyState/woUsers.jpg', name: 'Daniel Correa', state: 1, id: '123465', pedidosAsignados: 7 }
])

const calificationDomiciliario = ref([
    { type: 1, calificacion: '4.8', cantidadPuntos: 100 },
    { type: 2, calificacion: '5.0', cantidadPuntos: 50 },
])

const chatDeLaOrden = ref([
    { type: 2, message: null, url: '/img/emptyState/bannerRestaurante.png', horaEstandar: new Date() },
    { type: 2, message: 'Hello ❤', horaEstandar: new Date() },
    { type: 1, message: 'Hola', horaEstandar: new Date() },
])

function openModalAsignarDomiciliario(){
    refModalDomiciliarioAsignar.value.open()
}

function openDrawerChatCliente(){
    refDrawerChatCliente.value.open()
}

function openModalEliminarDomiciliario(){
    refModalEliminarDomiciliario.value.open()
}

function openModalVerUbicacionDomiciliario(){
    refModalUbicacionDomiciliario.value.open()
}

function sendImageFile(e){
    console.log('Esto ejecuta');
    let reader = new FileReader()
    reader.addEventListener('load', () => {
        chatDeLaOrden.value.unshift({ type: 2, url: reader.result, horaEstandar: new Date() })
    })
    reader.readAsDataURL(e.target.files[0])
}

function addMessageChat(message){
    console.log('Esto si se ejecuta');
    if(message !== ''){
        chatDeLaOrden.value.unshift({ type: 2, message: message, horaEstandar: new Date() })
    }
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