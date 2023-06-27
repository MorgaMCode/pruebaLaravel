<template>
    <el-dialog
        class="rounded-4"
        style="max-height: calc(100% - 200px);"
        v-model="visible"
        :show-close="false"
        :width="modalWidth"
        align-center
    >
        <template #header>
            <div class="d-middle-bt ps-4 pe-2">
                <h5 class="f-20 f-bold mb-0">{{ modalTitle }}</h5>
                <div class="cr-pointer item-with-hover rounded-5 f-23" v-if="seeIconClose">
                    <i class="icon-close-2" @click="emit('closeModal'), visible = false" />
                </div>
            </div>
        </template>
        <div
            class="border-top w-100 hM-500px overflow-auto hidden-scroll h-100"
            
        >
            <slot></slot>
        </div>
        <template #footer>
            <div class="pt-2 d-flex j-end" style="border-top: 2px solid #eeeeee;" v-if="seeButtonsBottom" >
                <button class="w-110px h-36px rounded-2 border bg-white f-14 me-2" @click="visible = false" >{{ cancel }}</button>
                <button :class="widthButtonAction" class="h-36px rounded-2 bg-general text-white border-0 px-4" @click="emit('buttonAction'),visible = false" >{{ action }}</button>
            </div>
        </template>
    </el-dialog>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    seeButtonsBottom:{
        type: Boolean,
        default: true
    },
    modalWidth:{
        type: Number,
        required: false,
        default: 426
    },
    modalTitle: {
        type: String,
        required: false
    },
    cancel:{
        type: String,
        required: false,
        default: 'Cerrar',
    },
    action:{
        type: String,
        required: false,
        default: 'Crear'
    },
    seeIconClose:{
        type: Boolean,
        required: false,
        default: true
    },
    widthButtonAction: {
        type: String,
        required: false,
    }
})

const emit = defineEmits(['buttonAction', 'closeModal'])

const visible = ref(false)

function open(){
    visible.value = true
}
function close(){
    visible.value = false
}

defineExpose({
    open,
    close,
})

</script>

<style lang="scss" scoped>

</style>