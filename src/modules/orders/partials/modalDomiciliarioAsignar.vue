<template>
    <modal ref="refModalDomiciliario" :modal-width="485" modal-title="Seleccionar domiciliario" action="Seleccionar">
        <div class="py-4" style="padding: 0px 55px;">
            <p class="text-grey-light f-15">Selecciona el domiciliario que recibe la orden y la entregará a su cliente</p>
            <div class="position-relative mt-4 mb-3">
                <el-input v-model="valueBuscarDomiciliario" placeholder="Buscar domiciliario" />
                <i class="icon-buscar position-absolute f-25 end-0" />
            </div>
            <div v-for="disponible in domiciliario" class="d-flex gap-2 mb-3">
                <img :src="disponible.photo" alt="domciliario" class="wh-32" />
                <div>
                    <div class="d-middle gap-3">
                        <p class="f-medium f-16">Daniel Correa</p>
                        <div class=" br-6 px-2 py-1" :class="[ disponible.state === 1 ? 'bg-green-state-light': 'bg-gray-light' ]">
                            <p class="f-medium f-10" :class="[ disponible.state === 1 ? 'text-green-clear': 'text-whitesmoke' ]">
                                {{ disponible.state === 1 ? 'Activo': 'Pendiente' }}
                            </p>
                        </div>
                        <p class="f-light f-14">id: {{ disponible.id }}</p>
                    </div>
                    <p class="f-14">7 pedidos asignados</p>
                </div>
            </div>
            <div class="d-flex gap-1 border-orange bg-orange-dark br-5 py-2 ps-1 pe-3">
                <div class="d-middle-center wh-24">
                    <i class="icon-alerta text-orange f-25" />
                </div>
                <p class="f-bold text-orange pt-1 f-14">No puedes seleccionar este domiciliario hasta que se apruebe su solicitud de activación</p>
            </div>
        </div>
    </modal>
</template>

<script setup>
import modal from '../../../shared/components/modal.vue';
import { ref } from 'vue';

const refModalDomiciliario = ref()
const valueBuscarDomiciliario = ref('')

let props = defineProps({
    domiciliario:{
        type: Array,
        required: false,
        default: () => []
    }
})

function open(){
    refModalDomiciliario.value.open()
}

defineExpose({
    open
})

</script>

<style lang="scss" scoped>

</style>