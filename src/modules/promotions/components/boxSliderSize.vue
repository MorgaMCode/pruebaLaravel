<template>
    <div class="border bg-blue-lightest d-flex flex-column p-1 w-320px br-8 h-100">
        <div class="d-middle-bt mb-4">
            <div class="d-flex">
                <i class="icon-dragable cr-pointer op-01 f-23 handle" />
                <div class="pt-1">
                    <p class="f-semibold f-18">{{ informationSliderSize.slider }}</p>
                    <p class="f-light text-whitesmoke f-12">{{ informationSliderSize.size }}</p>
                </div>
            </div>
            <div class="d-middle gap-1">
                <el-tooltip :content="informationSliderSize.stateSwitch ? 'Inactivar' : 'Activar'" placement="bottom" effect="light">
                    <el-switch
                        v-model="informationSliderSize.stateSwitch"
                        style="--el-switch-on-color: #13ce66;"
                        :active-value="1"
                        :inactive-value="0"
                    />
                </el-tooltip>
                <el-dropdown @visible-change="hoverPoints">
                    <div class="wh-36 d-middle-center rounded-circle cr-pointer item-with-hover" :class="{ 'bg-blue-state-lightest': pointsHover }">
                        <i class="icon-dots-vertical f-26" />
                    </div>
                    <template #dropdown>
                        <el-dropdown-menu class="w-155px h-100">
                            <dropdown-item>
                                <div class="cr-pointer icon-hover-blue mx-2 ps-3 py-1 br-4" @click="emit('sizeEdit')">
                                    <p class="f-15">Editar tamaño</p>
                                </div>
                            </dropdown-item>
                            <dropdown-item>
                                <div class="icon-hover-blue cr-pointer mx-2 ps-3 py-1 br-4" @click="emit('deleteSlider')">
                                    <p class="f-15">Eliminar</p>
                                </div>
                            </dropdown-item>
                        </el-dropdown-menu>
                    </template>
                </el-dropdown>
            </div>
        </div>
        <draggable v-model="informationSliderSize.cardInformationSlider" tag="div" handle=".handle" item-key="id">
            <template #item="{ element, index }">
                <div class="mb-2 px-2">
                    <box-promotions-active
                    :cardInformation="element"
                    :show-icons-card="true"
                    @moveSlider="emit('moveSilderOpenModal')"
                    />
                </div>
            </template>
        </draggable>
    </div>
</template>

<script setup>
import boxPromotionsActive from './boxPromotionsActive.vue';
import { ref } from 'vue';

const pointsHover = ref(false)

function hoverPoints(){
    pointsHover.value = !pointsHover.value
}

let props = defineProps({
    informationSliderSize:{
        type: Object,
        required: true,
        default: () => {}
    },
    cardSliderBig:{
        type: Array,
        required: false,
        default: () => []
    }
})

let emit = defineEmits(['sizeEdit', 'deleteSlider', 'moveSilderOpenModal'])


</script>

<style lang="scss" scoped>

</style>