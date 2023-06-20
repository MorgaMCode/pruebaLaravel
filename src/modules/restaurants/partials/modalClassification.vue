<template>
    <modal
        ref="classification"
        :see-buttons-bottom="false"
        :modal-width="473"
        modal-title="Calificación"
    >
        <div class="px-3 pb-4">
            <p class="f-medium f-14 mb-2 text-blue-dark">Calificación promedio del restaurante</p>
            <p class="f-light text-grey-light f-12">Este dato es el promedio de la calificación de cada tienda y se basa en las últimas 100 votaciones realizadas.</p>
            <div class="d-flex gap-2 my-4">
                <div class="br-10 box-shadowBox px-1 text-center wf-137px">
                    <p class="f-20 f-semibold">{{ menuFixed.nombre }}</p>
                    <div class="d-flex justify-content-center">
                        <p class="f-40 f-semibold text-whitesmoke">{{ menuFixed.calificacion }}</p>
                        <img
                            src="/img/emptyState/calificación.png"
                            alt="star"
                            class="wh-28 align-self-lg-center"
                        />
                    </div>
                    <div class="d-middle">
                        <i class="icon-account f-20 text-whitesmoke" />
                        <p class="f-12 f-light text-whitesmoke">Votos totales: {{ menuFixed.calificacionCantidad }}</p>
                    </div>
                </div>
                <div class="w-100">
                    <progress-star v-for="( clasification, index ) in percentage" :key="index" :calificationClassification="clasification" />
                </div>
            </div>
            <p class="f-14 f-medium text-blue-dark mb-2">Votación por ítem de calificación </p>
            <p class="f-12 f-light text-grey-light">Son ítems que los clientes pueden seleccionar al calificar los pedidos de las tiendas según las estrellas</p>
            <el-table
                :data="tableta"
                style="width: 100%"
                header-cell-class-name="bg-blue-light-table f-14"
            >
                <el-table-column prop="item" label="Items" width="75" />
                <el-table-column prop="voto" label="Votos" width="25" />
            </el-table>
        </div>
    </modal>
</template>

<script setup>
import modal from '../../../shared/components/modal.vue';
import progressStar from '../components/progressStar.vue'
import { ref } from 'vue';

const classification = ref()

const props = defineProps({
    percentage: {
        type: Array,
        required: false
    },
    tableta: {
        type: Array,
        required: false
    },
    menuFixed: {
        type: Object,
        required: false
    }
})

function open(){
    classification.value.open()
}

defineExpose({
    open
})

</script>

<style lang="scss" scoped>

</style>