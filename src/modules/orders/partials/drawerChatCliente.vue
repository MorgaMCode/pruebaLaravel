<template>
    <el-drawer v-model="openDrawer" :show-close="false" size="430" >
        <template #header>
            <div class="d-middle-bt ps-4 pe-3 h-66px border-bottom">
                <p class="f-bold f-20">{{ chatTitle }}</p>
                <div class="d-middle-center icon-hover-blue rounded-circle cr-pointer wh-32" style="transition: 0.3s all;" @click="close">
                    <i class="icon-close-2 f-25" />
                </div>
            </div>
        </template>
        <template #default>
            <div class="d-flex flex-column-reverse overflow-auto hidden-scroll pb-4 h-100">
                <div v-for="chat in informationChatCliente" class="px-3 py-1">
                    <div
                        class="wM-241px d-flex gap-1 flex-column p-2"
                        :class="[ chat.type === 1 ? 'radiusType1 bg-white box-shadow29': 'radiusType2 text-white ms-auto' ]"
                    >
                        <div class="wM-225px">
                            <p class="f-light f-14">{{ chat.message }}</p>
                            <img v-if="chat.url" :src="chat.url" :alt="chat.url" class="w-100 br-4" />
                        </div>
                        <p class="text-whitesmoke f-light f-10" :class="[ chat.type === 1 ? 'text-whitesmoke': 'text-white text-end' ]">
                            {{ chat.horaEstandar.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit', hour12: true}) }}
                        </p>
                    </div>
                </div>
            </div>
        </template>
        <template #footer>
            <div class="d-middle gap-1">
                <el-input v-model="messageValue" placeholder="Escribe tu mensaje" @keyup.enter="emit('sendMessage', messageValue), messageValue = ''" />
                <el-tooltip content="Enviar imagen" placement="top" effect="light">
                    <label for="file-upload" class="d-middle-center rounded-circle item-with-hover wh-32" style="transition: .3s all;">
                        <i class="icon-image f-25" />
                    </label>
                </el-tooltip>
                <input id="file-upload" type="file" @change="(e) => emit('openFile', e)" class="wh-30" style="display: none;" />
                <div class="moverIconSend d-middle-center rounded-circle item-with-hover wh-32" @click="emit('sendMessage', messageValue), messageValue = ''">
                    <i class="icon-send f-25" />
                </div>
            </div>
        </template>
    </el-drawer>
</template>

<script setup>
import { ref } from 'vue';

const openDrawer = ref(false)
const messageValue = ref('')
let idInput = document.querySelector('#file-upload')

let props = defineProps({
    informationChatCliente:{
        type: Array,
        required: false,
        default: () => []
    },
    chatTitle:{
        type: String,
        required: true,
        default: ''
    }
})

let emit = defineEmits(['sendMessage', 'openFile'])

function open(){
    openDrawer.value = true
}

function close(){
    openDrawer.value = false
}

defineExpose({
    open,
    close,
    idInput
})

</script>

<style lang="scss" scoped>

.radiusType1{
    border-radius: 10px 10px 10px 0px;
}
.radiusType2{
    border-radius: 10px 10px 0px 10px;
    background-color: var(--blue-mesage);
}
.moverIconSend{
    transition: transform 0.5s ease;
    &:hover{
        transform: rotate(45deg);
    }
}

</style>