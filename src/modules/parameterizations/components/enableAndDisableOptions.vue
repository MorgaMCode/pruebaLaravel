<template>
    <div class="d-middle gap-2 mb-2 ms-3 wM-400px position-relative f-14px" >
        <!-- input que se muestra al activar el icono-check-verde -->
        <div class="position-absolute w-53" v-if="!iconOpen">
            <el-input @input="eventInput" v-model="editName" placeholder="" />
        </div>
        <!-- parrafo principal -->
        <p class="f-14 me-auto">{{ name }}</p>
        <!-- icon de editar y eliminar -->
        <iconActions
            @remove-icons="iconOpen = false"
            @delete-tag="emit('openModalDelete')"
            v-if="iconOpen"
        />
        <template v-else >
            <el-tooltip :content="seeButton ? 'Guardar': 'Disabled'" placement="bottom" effect="light" >
                <!-- icon-check-verde -->
                <div
                    :class="seeButton ? 'parent-icon-check rounded-pill cr-pointer position-absolute f-23 text-green-clear' : 'bg-gray-light position-absolute f-23 rounded-pill'"
                    style="left: 228px"
                    @click="closeIcon"
                >
                    <i class="icon-check" />
                </div>
            </el-tooltip>
        </template>
        <!-- button switch -->
        <slot name="buttonSwitch"></slot>
        <div class="ms-2">
            <numberBox :use-number="seeAmount" tooltip-content="Restaurantes que usan esta etiqueta" />
        </div>
    </div>
</template>

<script setup>
import numberBox from '../../../shared/components/numberBox.vue';
import iconActions from '../../../shared/components/iconActions.vue';
import { ref } from 'vue';
import axios from 'axios';


const seeButton = ref(true)
const props = defineProps({
    name:{
        type: String,
    },
    seeAmount:{
        type: Number,
    },
    seeId: {
        type: Number
    },
    executeGetDatas: {
        type: Function
    }
})

const editName = ref(props.name)

function eventInput(){
    if(editName.value == ''){
        seeButton.value = false
    }else{
        seeButton.value = true
    }
}

async function closeIcon(){
    if(editName.value == ''){
        return
    }else{
        iconOpen.value = true
        let updateData = await axios.put(`api/parametrizacion/motivos-rechazo/${props.seeId}`, { nombre: editName.value })
        props.executeGetDatas()
    }
}

const iconOpen = ref(true)

const emit = defineEmits(['openModalDelete'])

</script>

<style lang="scss" scoped>

.parent-icon-check{
    &:hover{
        background-color: var(--green-state-lightest);
    }
}

</style>