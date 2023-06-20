<template>
    <modal
        ref="modalObservations"
        :modal-width="691"
        modal-title="Observaciones"
        :see-buttons-bottom="false"
    >
        <div class="mx-3 my-3">
            <p class="f-14 text-blue-dark mb-2">Fecha del mensaje: <span class="f-14 text-whitesmoke ms-1">{{ contentState?.fechaMensaje }}</span></p>
            <p v-if="contentState?.motivo !== null" class="f-14 text-blue-dark mb-2">Motivo: <span class="f-14 text-whitesmoke ms-1">{{ contentState?.motivo }}</span></p>
            <div class="d-middle gap-2">
                <p class="f-14 text-blue-dark">Observaciónes:</p>
                <span v-html="informacion" />
            </div>
            <div v-if="seeState(state)" class="br-10 px-3 py-2 mt-3" style="border: 1px solid var(--gray-light);">
                <p class="text-whitesmoke f-12">
                    Hola <span class="f-medium text-blue-dark">Ketaco</span> <br />
                    <p class="pt-3">Agradecemos por tomarte el tiempo para presentar tu solicitud.</p> <br />
                    Hemos recibido y revisado la información del <span class="text-blue-dark" style="text-decoration: underline;">restaurante Ketaco, tienda Megamall</span> y tenemos algunas observaciones para ti. <br />
                    - <span style="text-decoration: underline;"> El logo del restaurante no tiene una resolución óptima</span> y la imagen puede que no sea clara para el cliente. <br />
                    <p class="pt-3">Estamos ansiosos de que tus restaurantes y tiendas hagan parte de nosotros.</p> <br />
                    <p class="f-bold text-blue-dark f-12">¡El equipo <span class="f-12 f-bold text-red">YAP!</span></p>
                </p>
            </div>
        </div>
    </modal>
</template>

<script setup>
import modal from '../../../shared/components/modal.vue';
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import ModalLabelEditRestaurant from './modalLabelEditRestaurant.vue';

const modalObservations = ref()

const props = defineProps({
    state: {
        type: String,
        required: false
    },
    contentState: {
        type: Object,
        required: false,
        default: () => {}
    },
    informacion: {
        type: String,
        required: false
    }
})


function seeState(state){
    switch(state){
        case "Nuevo":
            return false;
            break;
    }
}

function open(){
    modalObservations.value.open()
}

defineExpose({
    open
})

</script>

<style lang="scss" scoped>

</style>