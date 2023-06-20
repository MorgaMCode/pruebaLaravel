<template>
    <div class="d-flex j-center gap-1">
        <div class="border bg-white br-8 p-2 handle cr-pointer">
            <img src="/img/trash/imagePromoBurguer.png" alt="imagePromo">
            <p class="f-medium f-16">{{ cardInformation.promo }}</p>
            <p class="f-medium f-14">Tipo: <span class="f-light">{{ cardInformation.type }}</span></p>
            <div class="d-middle">
                <i class="icon-calendar-2 f-20 op-06" />
                <p class="text-whitesmoke f-light f-14">{{ cardInformation.fechaDesde }} - {{ cardInformation.fechaHasta }}</p>
            </div>
        </div>
        <div class="d-middle flex-column">
            <el-tooltip content="Mover a" placement="bottom" effect="light">
                <div class="d-middle-center icon-hover-blue rounded-circle cr-pointer wh-32" @click="emit('moveSlider')">
                    <i class="icon-move f-25" />
                </div>
            </el-tooltip>
            <div v-if="showIconsCard">
                <el-tooltip content="Quitar" placement="bottom" effect="light">
                    <div class="icon-hover-blue d-middle-center cr-pointer rounded-circle wh-32">
                        <i class="icon-eliminar f-25" />
                    </div>
                </el-tooltip>
                <el-tooltip :content="showEye ? 'Inactivar': 'Activar'" placement="bottom" effect="light">
                    <div class="blue-item d-middle-center cr-pointer rounded-circle wh-32" @click="showEye = !showEye">
                        <i v-if="showEye" class="icon-eye f-25" />
                        <i v-else class="icon-hidden f-25" />
                    </div>
                </el-tooltip>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const showEye = ref(true)

let props = defineProps({
    cardInformation:{
        type: Object,
        required: true,
        default: () => {}
    },
    showIconsCard:{
        type: Boolean,
        required: false,
        default: false
    }
})

let emit = defineEmits(['moveSlider'])

</script>

<style lang="scss" scoped>

</style>