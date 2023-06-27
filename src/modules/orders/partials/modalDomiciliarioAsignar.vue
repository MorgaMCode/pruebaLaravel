<template>
    <modal ref="refModalDomiciliario" :modal-width="485" modal-title="Seleccionar domiciliario" 
    action="Seleccionar"
    @buttonAction="reloadAndClose()" >
        <div class="py-3 hM-470px" style="padding: 0px 55px;">
            <p class="text-grey-light f-15">Selecciona el domiciliario que recibe la orden y la entregará a su cliente</p>
            <div class="position-relative mt-4 mb-3">
                <el-input v-model="valueBuscarDomiciliario" placeholder="Buscar domiciliario" />
                <i class="icon-buscar position-absolute f-25 end-0" />
            </div>
            <div class="overflow-auto custom-scroll hM-240px mb-4">
                <div
                    v-for="(disponible,i) in domiciliarios" :key="i"
                    class="d-flex gap-2 mb-3 item-with-hover"
                    style="transition: 0.3s "
                    @click="selectUser(i)"
                    :class="{ 'bg-blue-light': userSeleted.includes(i) }"
                >
                    <img :src="disponible.fotoMini" alt="domciliario" class="wh-32" />
                    <div class="w-100">
                        <div class="d-middle gap-3">
                            <p class="f-medium f-16">{{ disponible.nombre }}</p>
                            <div v-if="false" class=" br-6 px-2 py-1" :class="[ disponible.state === 1 ? 'bg-green-state-light': 'bg-gray-light' ]">
                                <p class="f-medium f-10" :class="[ disponible.state === 1 ? 'text-green-clear': 'text-whitesmoke' ]">
                                    {{ disponible.state === 1 ? 'Activo': 'Pendiente' }}
                                </p>
                            </div>
                            <p class="f-light f-14 ms-auto me-3">id: {{ disponible.id }}</p>
                        </div>
                        <p v-if="false" class="f-14">7 pedidos asignados</p>
                    </div>
                </div>
            </div>
            <div v-if="false" class="d-flex gap-1 border-orange bg-orange-dark br-5 py-2 ps-1 pe-3">
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
const userSeleted = ref([])


const  props = defineProps({
    domiciliarios:{
        type: Array,
        required: false,
        default: () => []
    },
    reloadDeliveryFour:{
        type:Function
    }
})

function reloadAndClose(){
    if (userSeleted.value.length) {
        props.reloadDeliveryFour(props.domiciliarios[userSeleted.value[0]]?.id)
        refModalDomiciliario.value.close()
    }
}

function open(){
    refModalDomiciliario.value.open()
}

function close(){
    refModalDomiciliario.value.close()
}

function selectUser(i){

     if ( userSeleted.value.includes(i)) {
        userSeleted.value = []
    }else{
        userSeleted.value = []
        userSeleted.value.push(i)
    }
}




defineExpose({
    open,
    close
})

</script>

<style lang="scss" scoped>

</style>