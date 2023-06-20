<template>
    <modal
        ref="openModalLabelEdit"
        :modal-width="579"
        modal-title="Editar etiquetas"
        action="Guardar"
        @buttonAction="emit('saveLabels', copyArray)"
    >
        <div class="px-3 pt-3 pb-5">
            <p class="f-15">Selecciona las etiquetas para el restaurante</p>
            <el-select v-model="valueLabelEdit" placeholder="Seleccionar" class="my-3">
              <el-option
                v-for="(label, index) in arrayRestaurantLabels"
                :key="index"
                :label="label.etiqueta"
                :value="label.id"
                @click="addLabels(index, label.etiqueta, label.id)"
            />
            </el-select>
            <div class="d-middle gap-1 flex-wrap">
                <div v-for="(select, index) in copyArray" class="border-grey d-middle gap-1 br-8 ps-2 pe-1 py-1">
                    <p class="f-14">{{ select.etiqueta }}</p>
                    <el-tooltip content="Quitar" placement="bottom" effect="light">
                        <div class="d-middle rounded-circle blue-item cr-pointer" @click="deleteLabel(select.id)">
                            <i class="icon-close-2 f-18" />
                        </div>
                    </el-tooltip>
                </div>
            </div>
        </div>
    </modal>
</template>

<script setup>
import modal from '../../../shared/components/modal.vue';
import { ref } from 'vue';

const openModalLabelEdit = ref()
const valueLabelEdit = ref('')

let props = defineProps({
    arrayRestaurantLabels: {
        type: Array,
        required: true
    },
    arrayRestaurantLabelsSelected: {
        type: Array,
        required: true
    }
})

const copyArray = ref([])

function addLabels(i, etiqueta){
    let findLabel = props.arrayRestaurantLabels.find((p, index) => index == i)
    if(copyArray.value.some((f) => f.etiqueta == etiqueta)){
        return
    }else{
        copyArray.value.push(findLabel)
    }
}

let emit = defineEmits(['addLabels', 'saveLabels'])

function deleteLabel(id){
    copyArray.value = copyArray.value.filter((e) => e.id !== id)
}

function open(){
    copyArray.value = [...props.arrayRestaurantLabelsSelected]
    openModalLabelEdit.value.open()
}
function close(){
    openModalLabelEdit.value.close()
}

defineExpose({
    open,
    close
})

</script>

<style lang="scss" scoped>

</style>