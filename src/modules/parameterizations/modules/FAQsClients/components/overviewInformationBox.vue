<template>
    <section>
        <draggable v-model="box" tag="div" handle=".handle" item-key="id">
            <template #item="{ element, index }">
                <main class="d-flex mb-2">
                    <i class="icon-dragable f-23 op-02 mt-2 handle" />
                    <div class="px-4 py-3 rounded-2 w-100 box-shadowBox">
                        <div class="d-middle j-between mb-2">
                            <div class="d-middle gap-2">
                                <img :src="element.img" alt="">
                                <p class="f-semibold f-16">{{ element.boxTitle }}</p>
                            </div>
                            <div class="d-middle">
                                <iconActions
                                    tooltip-content-edit="Editar grupo"
                                    tooltip-content-remove="Eliminar grupo"
                                    @removeIcons="emit('seeEditGroup')"
                                    @deleteTag="emit('seeRemoveGroup', element.id)"
                                />
                                <buttonSwitch v-model="element.active"></buttonSwitch>
                            </div>
                        </div>
                        <internalBoxInformation v-model="element.questions" @editQuestion="(idQuestions) => editQuestionInternal(idQuestions)" @seeQuestion="(indexQuestion) => seeInternalQuestions(index, indexQuestion)" />
                    </div>
                </main>
            </template>
        </draggable>
    </section>
</template>

<script setup>
import internalBoxInformation from './internalBoxInformation.vue';
import iconActions from '../../../../../shared/components/iconActions.vue';
import buttonSwitch from '../../../../../shared/components/buttonSwitch.vue';
import { ref, computed } from 'vue';

const props = defineProps({
    modelValue:{
        type: Array
    }
})
const emit = defineEmits([
    'update:modelValue',
    'seeQuestion',
    'seeEditGroup',
    'seeRemoveGroup',
    'removeInternalQuestions',
    'editInternalQuestions'
])

const box = computed({
    get(){
        return props.modelValue
    },
    set(value){
        emit('update:modelValue', value)
    }
})

function seeInternalQuestions(indexGroup, indexQuestion){
    emit('removeInternalQuestions', indexGroup, indexQuestion)
}

function editQuestionInternal(idQuestions){
    emit('editInternalQuestions', idQuestions)
}

</script>

<style lang="scss" scoped>

</style>