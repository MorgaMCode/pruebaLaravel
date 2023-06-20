<template>
    <modal
        ref="selectComissionPlan"
        :modal-width="894"
        modal-title="Planes de comisión"
        :action="contentButton"
        @buttonAction="emit('comissionPlanSelected', radio1)"
    >
        <div class="px-2 py-4">
            <p class="f-15 px-2">Asigna un plan de comisión al restaurante para poder continuar</p>
            <div class="d-flex a-start gap-1">
                <el-radio-group v-model="radio1" class="mt-4" @change="emit('changeRadio', informationArray.id)">
                    <el-radio :label="informationArray.id" size="large" style="height: 200px !important;" >
                        <plan-information
                            ref="addClass"
                            :arrayInformation="informationArray"
                            :numberRadio="radio1"
                        />
                    </el-radio>
                </el-radio-group>
            </div>
        </div>
    </modal>
</template>

<script setup>
import modal from '../../../shared/components/modal.vue';
import planInformation from '../components/planInformation.vue'
import { ref } from 'vue';

const radio1 = ref(null)
const addClass = ref()

const selectComissionPlan = ref()

let props = defineProps({
    informationArray: {
        type: Object,
        required: false
    },
    contentButton: {
        type: String,
        required: false,
        default: 'Aceptar'
    }
})

let emit = defineEmits(['comissionPlanSelected', 'changeRadio'])

function open(){
    selectComissionPlan.value.open()
}

function close(){
    selectComissionPlan.value.close()
}

defineExpose({
    open,
    close,
})

</script>

<style lang="scss" scoped>

</style>