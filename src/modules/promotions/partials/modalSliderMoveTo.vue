<template>
    <modal ref="refModalSlider" modal-title="Mover a" :modal-width="387" action="Mover">
        <div class="py-4 px-3">
            <p class="f-medium text-blue-dark ps-3 f-16">Selecciona un slider</p>
            <el-select v-model="value" placeholder="Seleccionar">
                <el-option
                    v-for="option in options"
                    :key="option.value"
                    :label="option.label"
                    :value="option.value"
                />
            </el-select>
        </div>
    </modal>
</template>

<script setup>
import { ref } from 'vue';
import modal from '../../../shared/components/modal.vue';

const refModalSlider = ref()
const value = ref('')

const options = ref([
    { value: 'Tamaño grande', label: 'Tamaño grande' },
    { value: 'Tamaño mediano', label: 'Tamaño mediano' },
    { value: 'Tamaño pequeño', label: 'Tamaño pequeño' },
])
function open(){
    refModalSlider.value.open()
}

defineExpose({
    open
})

</script>

<style lang="scss" scoped>

</style>