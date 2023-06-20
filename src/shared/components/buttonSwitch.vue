<template>
    <el-tooltip :content="`${ value1 ? buttonStateOne : buttonStateTwo }`" :placement="placementTooltip" effect="light">
        <el-switch
            v-model="value1"
            @change="changeSwitch"
            style="--el-switch-on-color: #29D884;"
        />
    </el-tooltip>
</template>

<script setup>
import { ref, computed } from 'vue';


const props = defineProps({
    buttonStateOne:{
        type: String,
        default: 'Inactivar'
    },
    buttonStateTwo:{
        type: String,
        default: 'Activar'
    },
    placementTooltip:{
        type: String,
        default: 'bottom'
    },
    modelValue:{
        type: Boolean
    }
})

const value1 = ref(props.modelValue)

const emit = defineEmits(['update:modelValue'])

function changeSwitch(newValue){
    emit('update:modelValue', newValue)
}

</script>

<style lang="scss" scoped>
</style>