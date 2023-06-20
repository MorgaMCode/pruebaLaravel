<template>
    <draggable v-model="questionsValue" tag="div" handle=".handle" item-key="id">
        <template #item="{ element, index }">
            <div class="d-middle j-between">
                <div class="d-middle">
                    <i class="icon-dragable f-23 op-02 handle" />
                    <p class="f-14">{{ element.question }}</p>
                </div>
                <iconActions
                    tooltip-content-edit="Editar pregunta"
                    tooltip-content-remove="Eliminar pregunta"
                    @deleteTag="emit('seeQuestion', index)"
                    @removeIcons="emit('editQuestion', element.id)"
                />
            </div>
        </template>
    </draggable>
</template>

<script setup>
import iconActions from '../../../../../shared/components/iconActions.vue';
import { ref, computed } from 'vue';

const props = defineProps({
    modelValue:{
        type: Array
    }
})


const emit = defineEmits(['update:modelValue', 'deleteQuestion', 'seeQuestion', 'editQuestion'])

const questionsValue = computed({
    get(){
        return props.modelValue
    },
    set(newValue){
        emit('update:modelValue', newValue)
    }
})
</script>

<style lang="scss" scoped>

</style>