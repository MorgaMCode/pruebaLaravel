<template>
    <modal ref="refModalSlider" :modal-width="479" modal-title="Crear slider">
        <div class="p-3">
            <div class="pe-5 mb-4">
                <p class="f-light f-14">Selecciona un tamaño de slider para la visualización de las imágenes de las promociones</p>
            </div>
            <div class="d-flex j-between">
                <div class="d-flex flex-column gap-2 w-50">
                    <template v-for="(size, i) in sizeSelect" :key="i">
                        <div :class="{ 'borderSelected': size.selected }" class="hoverSelectSize border cr-pointer d-middle gap-3 pe-3 py-2 ps-2 br-8" @click="createSize(i)">
                            <div class="wh-18 d-middle-center ps-3">
                                <i :class="{ 'text-green-clear icon-verify f-23': size.selected }" />
                            </div>
                            <p :class="{ 'text-green-clear': size.selected }" class="f-medium f-14">{{ size.size }}</p>
                        </div>
                    </template>
                </div>
                <img src="/img/emptyState/imagePrevisualizacionSlider.png" alt="imagePrevisualizacion" />
            </div>
        </div>
    </modal>
</template>

<script setup>
import modal from '../../../shared/components/modal.vue';
import { ref } from 'vue';

const refModalSlider = ref()

const sizeSelect = ref([
    { selected: true, size: 'Tamaño grande' },
    { selected: false, size: 'Tamaño mediano' },
    { selected: false, size: 'Tamaño pequeño' },
])

function createSize(index){
    sizeSelect.value = sizeSelect.value.map((element, i) => i === index ? { ...element, selected: element.selected = !element.selected }: element)
}

function open(){
    refModalSlider.value.open()
}

defineExpose({
    open
})

</script>

<style lang="scss" scoped>
.borderSelected{
    border: 1px solid var(--green-clear) !important;
    background-color: #29D8840D;
}
.hoverSelectSize{
    transition: background-color 0.3s ease;
    &:hover{
        background-color: #29D8840D;
    }
}

</style>