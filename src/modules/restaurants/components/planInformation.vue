<template>
    <section>
        <div class="mt-4 br-10 px-4 pt-3 pb-4 box-shadowBox" :class="{ 'border-green-clear lineGreen' : numberRadio ==  arrayInformation.id, 'hover-plan cr-pointer': showHover}" style="min-width: 812px;">
            <div class="d-middle-bt">
                <main>
                    <div class="d-middle">
                        <p class="f-16 f-semibold">{{ arrayInformation.nombre }}</p>
                        <el-tooltip :content="arrayInformation.descripcion" placement="right" effect="light" popper-class="wM-300px">
                            <i class="icon-info-outline f-25 ps-2" />
                        </el-tooltip>
                    </div>
                    <p class="f-15 f-light">Aplicar comisión mayor</p>
                </main>
            </div>
            <div class="d-flex mt-4">
                <div class="w-50">
                    <p class="f-16 f-medium mb-1">Comisión por venta</p>
                    <div v-for="(comision, index) in arrayInformation.comisionValoresVenta" :key="index" class="d-middle-end gap-4">
                        <p>${{ comision.desde }}</p>
                        <p class="">-</p>
                        <p class=" w-87px text-lg-end">${{ comision.hasta }}</p>
                        <p class="w-80px text-end">{{ comision.comision }}%</p>
                    </div>
                </div>
                <div class="bg-grey-lightest w-1px op-02 rounded-5 mx-3" style="border: 1px solid #8E989D" />
                <div class="w-50 ps-4">
                    <p class="f-16px f-medium mb-2 ms-3">Comisión por pedido</p>
                    <div v-for="(comision, idnex) in arrayInformation.comisionValoresOrden" class="d-middle-end gap-3">
                        <p>{{ comision.desde }}</p>
                        <p class="ms-2">-</p>
                        <p class="w-55px text-lg-end">{{ comision.hasta }}</p>
                        <p class="w-85px text-end" style="margin-left: 60px !important;">{{ comision.comision }}%</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    arrayInformation: {
        type: Object,
        required: false
    },
    numberRadio: {
        type: Number,
         required: false
    },
    showHover: {
        type: Boolean,
        required: false,
        default: true
    }
})

</script>

<style lang="scss" scoped>
.hover-plan{
    border: 1px solid white;
    &:hover{
        background-color: #29D8840D;
        box-shadow: 0px 0px 0px white;
    }
    &.lineGreen{
        background-color: #29D8840D;
        box-shadow: 0px 0px 0px white;
    }
}

</style>