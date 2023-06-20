<template>
    <modal ref="refModalReportar" modal-title="Reportar cliente" :modal-width="519" action="Reportar">
        <div class="p-3">
            <div class="border-whitesmoke d-flex gap-2 br-5 p-2">
                <div class="d-middle-center wh-24">
                    <i class="icon-alerta text-whitesmoke f-25" />
                </div>
                <p class="text-whitesmoke f-medium f-14">Este reporte es informativo y el cliente podrá seguir realizando órdenes en tu tienda si así lo desea.</p>
            </div>
            <div class="p-3 d-flex flex-column">
                <template v-for="(radio, i) in informationRadio" :key="i">
                    <el-radio-group v-model="valueRadioButton" >
                        <template #default>
                            <el-radio :label="radio.value"><p class="text-grey-light f-14">{{ radio.text }}</p></el-radio>
                        </template>
                    </el-radio-group>
                </template>
            </div>
            <p class="text-grey-light f-15 pe-3">Los reportes son visible para las tiendas de forma anónima, el cliente no tiene acceso a esta información.  </p>
        </div>
    </modal>
</template>

<script setup>
import modal from '../../../shared/components/modal.vue';
import { ref } from 'vue';

const refModalReportar = ref()
const valueRadioButton = ref(null)


let props = defineProps({
    informationRadio:{
        type: Array,
        required: false,
        default: () => []
    }
})

function open(){
    refModalReportar.value.open()
}

defineExpose({
    open
})

</script>

<style lang="scss" scoped>

</style>